@extends('layouts.admin')
@section('title', 'Order '.$order->order_number)
@section('page-title', 'Order Details')

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        {{-- Items --}}
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <h6 class="mb-0 fw-700">Order Items — {{ $order->order_number }}</h6>
            </div>
            <div class="table-responsive">
                <table class="table admin-table mb-0">
                    <thead><tr><th>Product</th><th>Price</th><th>Qty</th><th>Total</th></tr></thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    @if($item->product_image)
                                    <div class="rounded overflow-hidden" style="width:40px;height:40px;flex-shrink:0;">
                                        <img src="{{ \App\Support\PublicMedia::url($item->product_image, 'https://images.unsplash.com/photo-1560393464-5c69a73c5770?w=600&h=600&fit=crop') }}" class="w-100 h-100" style="object-fit:cover;">
                                    </div>
                                    @endif
                                    <span class="fw-500" style="font-size:.875rem;">{{ $item->product_name }}</span>
                                </div>
                            </td>
                            <td>${{ number_format($item->price, 2) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td class="fw-700">${{ number_format($item->total, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr><td colspan="3" class="text-end fw-500">Subtotal</td><td>${{ number_format($order->subtotal, 2) }}</td></tr>
                        <tr><td colspan="3" class="text-end fw-500">Shipping</td><td>${{ number_format($order->shipping_cost, 2) }}</td></tr>
                        <tr><td colspan="3" class="text-end fw-500">Tax</td><td>${{ number_format($order->tax, 2) }}</td></tr>
                        <tr><td colspan="3" class="text-end fw-700 fs-6">Total</td><td class="fw-700 fs-6">${{ number_format($order->total, 2) }}</td></tr>
                    </tfoot>
                </table>
            </div>
        </div>

        {{-- Shipping --}}
        <div class="admin-card">
            <div class="admin-card-header"><h6 class="mb-0 fw-700">Shipping Address</h6></div>
            <div class="admin-card-body">
                <p class="mb-1 fw-600">{{ $order->shipping_name }}</p>
                <p class="mb-1 text-muted">{{ $order->shipping_email }} · {{ $order->shipping_phone }}</p>
                <p class="mb-0 text-muted">{{ $order->shipping_address }}, {{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_zip }}, {{ $order->shipping_country }}</p>
                @if($order->notes)<p class="mt-2 mb-0"><strong>Notes:</strong> {{ $order->notes }}</p>@endif
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        {{-- Update Status --}}
        <div class="admin-card mb-4">
            <div class="admin-card-header"><h6 class="mb-0 fw-700">Update Status</h6></div>
            <div class="admin-card-body">
                <form action="{{ route('admin.orders.status', $order) }}" method="POST">
                    @csrf @method('PATCH')
                    <div class="mb-3">
                        <label class="form-label fw-500">Order Status</label>
                        <select name="status" class="form-select rounded-pill">
                            @foreach(['pending','processing','shipped','delivered','cancelled'] as $s)
                            <option value="{{ $s }}" {{ $order->status == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-500">Payment Status</label>
                        <select name="payment_status" class="form-select rounded-pill">
                            @foreach(['pending','paid','failed','refunded'] as $ps)
                            <option value="{{ $ps }}" {{ $order->payment_status == $ps ? 'selected' : '' }}>{{ ucfirst($ps) }}</option>
                            @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-accent w-100">Update</button>
            </form>
        </div>
    </div>

    {{-- Summary --}}
    <div class="admin-card">
        <div class="admin-card-header"><h6 class="mb-0 fw-700">Order Summary</h6></div>
        <div class="admin-card-body">
            <div class="d-flex justify-content-between mb-2 small"><span>Order #</span><span class="text-accent fw-600">{{ $order->order_number }}</span></div>
            <div class="d-flex justify-content-between mb-2 small"><span>Customer</span><span>{{ $order->user->name }}</span></div>
            <div class="d-flex justify-content-between mb-2 small"><span>Date</span><span>{{ $order->created_at->format('M j, Y') }}</span></div>
            <div class="d-flex justify-content-between mb-2 small"><span>Payment</span><span class="text-capitalize">{{ $order->payment_method }}</span></div>
            <hr>
            <div class="d-flex justify-content-between fw-700"><span>Total</span><span>${{ number_format($order->total, 2) }}</span></div>
        </div>
    </div>
</div>
