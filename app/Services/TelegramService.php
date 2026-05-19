<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramService
{
    protected string $token;
    protected string $chatId;

    public function __construct()
    {
        $this->token  = config('services.telegram.token', '');
        $this->chatId = config('services.telegram.chat_id', '');
    }

    /**
     * Send message to Telegram
     */
    public function sendMessage(string $message): bool
    {
        if (empty($this->token) || empty($this->chatId)) {
            Log::warning('Telegram: token or chat_id not set in .env');
            return false;
        }

        try {
            $url = "https://api.telegram.org/bot{$this->token}/sendMessage";

            // ✅ withoutVerifying() fixes SSL error on localhost Windows
            $response = Http::withoutVerifying()
                ->timeout(15)
                ->post($url, [
                    'chat_id'                  => $this->chatId,
                    'text'                     => $message,
                    'parse_mode'               => 'HTML',
                    'disable_web_page_preview' => true,
                ]);

            $data = $response->json();

            if (!($data['ok'] ?? false)) {
                Log::error('Telegram send failed: ' . json_encode($data));
                return false;
            }

            Log::info('Telegram: message sent OK');
            return true;

        } catch (\Exception $e) {
            Log::error('Telegram exception: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * New order notification
     */
    public function sendOrderNotification(\App\Models\Order $order): bool
    {
        if (!$order->relationLoaded('items')) {
            $order->load('items');
        }

        $items = $order->items->map(function ($item) {
            return "  • {$item->product_name} × {$item->quantity} = \$" .
                   number_format($item->total, 2);
        })->implode("\n");

        $paymentEmoji = match($order->payment_method) {
            'cod'    => '💵',
            'card'   => '💳',
            'paypal' => '🅿️',
            default  => '💰',
        };

        $message =
"🛒 <b>NEW ORDER RECEIVED!</b>
━━━━━━━━━━━━━━━━━━━━━━

📦 <b>Order #:</b> {$order->order_number}
📅 <b>Date:</b> {$order->created_at->format('d M Y, H:i')}

👤 <b>CUSTOMER INFO</b>
━━━━━━━━━━━━━━━━━━━━━━
👤 <b>Name:</b>  {$order->shipping_name}
📧 <b>Email:</b> {$order->shipping_email}
📱 <b>Phone:</b> {$order->shipping_phone}

📍 <b>SHIPPING ADDRESS</b>
━━━━━━━━━━━━━━━━━━━━━━
🏠 {$order->shipping_address}
🏙️ {$order->shipping_city}, {$order->shipping_state} {$order->shipping_zip}
🌍 {$order->shipping_country}

🛍️ <b>ITEMS ORDERED</b>
━━━━━━━━━━━━━━━━━━━━━━
{$items}

💰 <b>PAYMENT SUMMARY</b>
━━━━━━━━━━━━━━━━━━━━━━
Subtotal:  \$" . number_format($order->subtotal, 2) . "
Shipping:  \$" . number_format($order->shipping_cost, 2) . "
Tax:       \$" . number_format($order->tax, 2) . "
<b>💎 TOTAL: \$" . number_format($order->total, 2) . "</b>

{$paymentEmoji} <b>Payment:</b> " . strtoupper($order->payment_method) . "
🔄 <b>Status:</b> " . ucfirst($order->status) . "
━━━━━━━━━━━━━━━━━━━━━━
✅ <i>LuxeShop Notification</i>";

        return $this->sendMessage($message);
    }

    /**
     * Order status update notification
     */
    public function sendStatusUpdateNotification(\App\Models\Order $order, string $oldStatus): bool
    {
        $emoji = match($order->status) {
            'processing' => '⚙️',
            'shipped'    => '🚚',
            'delivered'  => '✅',
            'cancelled'  => '❌',
            default      => '🔔',
        };

        $message =
"{$emoji} <b>ORDER STATUS UPDATED</b>
━━━━━━━━━━━━━━━━━━━━━━

📦 <b>Order:</b>    #{$order->order_number}
👤 <b>Customer:</b> {$order->shipping_name}
📧 <b>Email:</b>    {$order->shipping_email}

🔄 <b>Status Changed:</b>
   " . ucfirst($oldStatus) . " → <b>" . ucfirst($order->status) . "</b>

💎 <b>Total:</b>   \$" . number_format($order->total, 2) . "
📅 <b>Updated:</b> " . now()->format('d M Y, H:i') . "
━━━━━━━━━━━━━━━━━━━━━━
<i>LuxeShop Admin System</i>";

        return $this->sendMessage($message);
    }
}