<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\TelegramService;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    protected TelegramService $telegram;

    public function __construct(TelegramService $telegram)
    {
        $this->telegram = $telegram;
    }

    public function index(Request $request)
    {
        $query = Order::with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $query->where('order_number', 'like', '%' . $request->search . '%');
        }

        $orders = $query->latest()->paginate(15)->withQueryString();
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.product']);
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        return $this->updateStatus($request, $order);
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status'         => 'required|in:pending,processing,shipped,delivered,cancelled',
            'payment_status' => 'nullable|in:pending,paid,failed,refunded',
        ]);

        $oldStatus = $order->status;

        $order->update([
            'status'         => $request->status,
            'payment_status' => $request->payment_status ?? $order->payment_status,
        ]);

        // ✅ Send Telegram alert when status changes
        if ($oldStatus !== $request->status) {
            $this->telegram->sendStatusUpdateNotification($order, $oldStatus);
        }

        return back()->with('success', 'Order status updated!');
    }
}