@extends('layouts.frontend')
@section('title', 'Order Confirmed')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7 text-center">
            <div class="bg-white rounded-xl border p-5 shadow-luxury">
                <div class="mb-4">
                    <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3"
                         style="width:90px;height:90px;background:rgba(34,197,94,.1);">
                        <i class="bi bi-check-lg text-success" style="font-size:2.5rem;"></i>
                    </div>
                    <h2 style="color:var(--primary);">Order Confirmed!</h2>
                    <p class="text-muted">Thank you for your purchase. Your order has been placed successfully.</p>
                </div>

                <div class="p-4 rounded-xl mb-4" style="background:var(--bg-light);">
                    <div class="row g-3 text-start">
                        <div class="col-6">
                            <div class="text-muted small">Order Number</div>
                            <div class="fw-700" style="color:var(--accent);">{{ $order->order_number }}</div>
                        </div>
                        <div class="col-6">
                            <div class="text-muted small">Order Date</div>
                            <div class="fw-600">{{ $order->created_at->format('M j, Y') }}</div>
                        </div>
                        <div class="col-6">
                            <div class="text-muted small">Total Amount</div>
                            <div class="fw-700" style="font-size:1.1rem;">${{ number_format($order->total, 2) }}</div>
                        </div>
                        <div class="col-6">
                            <div class="text-muted small">Payment Method</div>
                            <div class="fw-600 text-capitalize">{{ $order->payment_method }}</div>
                        </div>
                        <div class="col-12">
                            <div class="text-muted small">Shipping To</div>
                            <div class="fw-600">{{ $order->shipping_name }}, {{ $order->shipping_city }}, {{ $order->shipping_country }}</div>
                        </div>
                    </div>
                </div>

                {{-- Items --}}
                <div class="text-start mb-4">
                    <h6 class="mb-3">Items Ordered</h6>
                    @foreach($order->items as $item)
                    <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom" style="border-color:var(--border)!important;">
                        <div style="font-size:.875rem;">
                            <div class="fw-500">{{ $item->product_name }}</div>
                            <div class="text-muted" style="font-size:.8rem;">Qty: {{ $item->quantity }}</div>
                        </div>
                        <div class="fw-600">${{ number_format($item->total, 2) }}</div>
                    </div>
                    @endforeach
                </div>

                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="{{ route('orders.show', $order) }}" class="btn btn-accent">
                        <i class="bi bi-receipt me-1"></i>View Order Details
                    </a>
                    <a href="{{ route('shop') }}" class="btn btn-outline-secondary rounded-pill">
                        <i class="bi bi-bag me-1"></i>Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection