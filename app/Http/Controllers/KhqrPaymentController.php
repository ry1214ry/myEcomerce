<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\TelegramService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use KHQR\BakongKHQR;
use KHQR\Helpers\KHQRData;
use KHQR\Models\IndividualInfo;

class KhqrPaymentController extends Controller
{
    public function show(Order $order)
    {
        if (!auth()->check() || $order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized.');
        }

        if ($order->payment_status === 'paid') {
            return redirect()
                ->route('orders.success', $order)
                ->with('success', 'Your order is already paid!');
        }

        $qr = null;
        $md5 = null;
        $error = null;

        try {
            $currencyCode = KHQRData::CURRENCY_KHR;
            $amount = $this->formatKhmerRielAmount($order->total);

            $bakongAccountId = $this->formatBakongAccountId(
                config('services.bakong.account_id')
            );

            $merchantName = $this->formatMerchantName(
                config('services.bakong.merchant_name', 'VANNAK DIM')
            );

            $merchantCity = $this->formatMerchantCity(
                config('services.bakong.merchant_city', 'PHNOM PENH')
            );

            if ($bakongAccountId === '') {
                throw new \Exception('Bakong account ID is missing.');
            }

            $merchant = new IndividualInfo(
                bakongAccountID: $bakongAccountId,
                merchantName: $merchantName,
                merchantCity: $merchantCity,
                currency: $currencyCode,
                amount: $amount
            );

            $qrResponse = BakongKHQR::generateIndividual($merchant);

            [$qr, $md5] = $this->extractQrAndMd5($qrResponse);

            if (!$qr) {
                throw new \Exception('KHQR generation failed: QR string not found.');
            }

            if ($md5) {
                $order->update([
                    'transaction_md5' => $md5,
                ]);
            }

            Log::info('KHQR Generate Response', [
                'order_id' => $order->id,
                'currency' => 'KHR',
                'amount' => $amount,
                'bakong_account_id' => $bakongAccountId,
                'merchant_name' => $merchantName,
                'merchant_city' => $merchantCity,
                'response' => $this->normalizeForLog($qrResponse),
            ]);
        } catch (\Throwable $e) {
            Log::error('KHQR Generate Error', [
                'order_id' => $order->id,
                'message' => $e->getMessage(),
            ]);

            $error = $e->getMessage();
            $qr = null;
            $md5 = null;
        }

        return view('frontend.qr-payment', compact('order', 'qr', 'md5', 'error'));
    }

    public function verify(Request $request)
    {
        $request->validate([
            'md5' => ['required', 'string'],
        ]);

        try {
            $token = trim((string) config('services.bakong.token', env('BAKONG_TOKEN', '')));

            if ($token === '') {
                return response()->json([
                    'responseCode' => -1,
                    'responseMessage' => 'Bakong token is missing.',
                    'failed' => true,
                ], 500);
            }

            $bakongKhqr = new BakongKHQR($token);
            $result = $bakongKhqr->checkTransactionByMD5($request->md5);

            Log::info('KHQR Verify Result', [
                'md5' => $request->md5,
                'result' => $this->normalizeForLog($result),
            ]);

            $responseCode = $this->extractResponseCode($result);

            if ($responseCode === 0) {
                $order = Order::where('transaction_md5', $request->md5)->first();

                if ($order && $order->payment_status !== 'paid') {
                    $order->update([
                        'payment_status' => 'paid',
                        'status' => 'processing',
                    ]);

                    try {
                        $order->loadMissing('items');

                        if (class_exists(TelegramService::class)) {
                            (new TelegramService())->sendOrderNotification($order);
                        }
                    } catch (\Throwable $e) {
                        Log::error('Telegram notification error', [
                            'order_id' => $order->id,
                            'message' => $e->getMessage(),
                        ]);
                    }
                }
            }

            return response()->json($result);
        } catch (\Throwable $e) {
            Log::error('KHQR Verify Error', [
                'md5' => $request->md5,
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'responseCode' => -1,
                'responseMessage' => $e->getMessage(),
                'failed' => true,
            ], 500);
        }
    }

    public function paymentResult()
    {
        return view('frontend.payment-result');
    }

    private function formatKhmerRielAmount($amount): int
    {
        $amount = (float) $amount;

        if ($amount <= 0) {
            throw new \InvalidArgumentException('Invalid KHR amount.');
        }

        return (int) round($amount);
    }

    private function formatBakongAccountId(?string $accountId): string
    {
        $accountId = trim((string) $accountId);

        if ($accountId === '') {
            return '';
        }

        return strtolower($accountId);
    }

    private function formatMerchantName(string $name): string
    {
        $name = trim($name);

        if ($name === '') {
            $name = 'VANNAK DIM';
        }

        return mb_substr($name, 0, 25);
    }

    private function formatMerchantCity(string $city): string
    {
        $city = strtoupper(trim($city));

        if ($city === '') {
            $city = 'PHNOM PENH';
        }

        return mb_substr($city, 0, 15);
    }

    private function extractQrAndMd5($qrResponse): array
    {
        $qr = null;
        $md5 = null;

        if (is_array($qrResponse)) {
            $data = $qrResponse['data'] ?? [];
            $qr = $data['qr'] ?? null;
            $md5 = $data['md5'] ?? null;
        } elseif (is_object($qrResponse)) {
            $data = $qrResponse->data ?? null;

            if (is_array($data)) {
                $qr = $data['qr'] ?? null;
                $md5 = $data['md5'] ?? null;
            } elseif (is_object($data)) {
                $qr = $data->qr ?? null;
                $md5 = $data->md5 ?? null;
            }
        }

        return [$qr, $md5];
    }

    private function extractResponseCode($result): int
    {
        if (is_array($result)) {
            return (int) ($result['responseCode'] ?? -1);
        }

        if (is_object($result)) {
            return (int) ($result->responseCode ?? -1);
        }

        return -1;
    }

    private function normalizeForLog($data): array
    {
        if (is_array($data)) {
            return $data;
        }

        return json_decode(json_encode($data), true) ?? [];
    }
}