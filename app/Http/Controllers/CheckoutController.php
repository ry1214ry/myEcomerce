<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\TelegramService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use KhqrGateway\BakongKHQR;
use KhqrGateway\Models\IndividualInfo;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        $subtotal = $cartItems->sum(fn($i) => $i->price * $i->quantity);
        $shipping = $subtotal >= 100 ? 0 : 10;
        $tax      = round($subtotal * 0.08, 2);
        $total    = $subtotal + $shipping + $tax;

        return view('frontend.checkout',
            compact('cartItems', 'subtotal', 'shipping', 'tax', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_name'    => 'required|string|max:255',
            'shipping_email'   => 'required|email',
            'shipping_phone'   => 'required|string|max:20',
            'shipping_address' => 'required|string',
            'shipping_city'    => 'required|string|max:100',
            'shipping_state'   => 'nullable|string|max:100',
            'shipping_zip'     => 'required|string|max:20',
            'shipping_country' => 'required|string|max:100',
            'payment_method'   => 'required|in:cod,card,khqr',
        ]);

        $cartItems = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        $subtotal = $cartItems->sum(fn($i) => $i->price * $i->quantity);
        $shipping = $subtotal >= 100 ? 0 : 10;
        $tax      = round($subtotal * 0.08, 2);
        $total    = $subtotal + $shipping + $tax;

        // ── Create Order ──────────────────────────────────────────
        $order = Order::create([
            'order_number'     => 'ORD-' . strtoupper(Str::random(8)),
            'user_id'          => auth()->id(),
            'subtotal'         => $subtotal,
            'shipping_cost'    => $shipping,
            'tax'              => $tax,
            'total'            => $total,
            'payment_method'   => $request->payment_method,
            'payment_status'   => 'pending',
            'status'           => 'pending',
            'shipping_name'    => $request->shipping_name,
            'shipping_email'   => $request->shipping_email,
            'shipping_phone'   => $request->shipping_phone,
            'shipping_address' => $request->shipping_address,
            'shipping_city'    => $request->shipping_city,
            'shipping_state'   => $request->shipping_state,
            'shipping_zip'     => $request->shipping_zip,
            'shipping_country' => $request->shipping_country,
            'notes'            => $request->notes,
        ]);

        // ── Order Items ───────────────────────────────────────────
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id'      => $order->id,
                'product_id'    => $item->product_id,
                'product_name'  => $item->product->name,
                'product_image' => $item->product->main_image,
                'quantity'      => $item->quantity,
                'price'         => $item->price,
                'total'         => $item->price * $item->quantity,
            ]);
            $item->product->decrement('stock_quantity', $item->quantity);
        }

        // ── Clear Cart ────────────────────────────────────────────
        Cart::where('user_id', auth()->id())->delete();

        // ── Send Telegram Notification ────────────────────────────
        try {
            $order->load('items');
            (new TelegramService())->sendOrderNotification($order);
        } catch (\Exception $e) {
            \Log::error('Telegram failed: ' . $e->getMessage());
        }

        // ── KHQR → redirect to QR payment page ───────────────────
        if ($request->payment_method === 'khqr') {
            return redirect()->route('payment.khqr', $order);
        }

        return redirect()
            ->route('orders.success', $order)
            ->with('success', 'Order placed successfully!');
    }
}