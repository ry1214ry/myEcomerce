@extends('layouts.frontend')
@section('title', 'Order '.$order->order_number)

@section('content')
<div class="breadcrumb-section">
    <div class="container">
        <nav><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">My Orders</a></li>
            <li class="breadcrumb-item active">{{ $order->order_number }}</li>
        </ol></nav>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">
        <div class="col-lg-3">
            @include('partials.account-sidebar')
        </div>
        <div class="col-lg-9">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h4 class="mb-0">Order {{ $order->order_number }}</h4>
                {!! $order->status_badge !!}
            </div>

            {{-- Items --}}
            <div class="bg-white border rounded-xl mb-4" style="border-color:var(--border)!important;overflow:hidden;">
                @foreach($order->items as $item)
                <div class="d-flex align-items-center gap-3 p-4 border-bottom" style="border-color:var(--border)!important;">
                    <div class="rounded-xl overflow-hidden flex-shrink-0" style="width:64px;height:64px;background:var(--bg-light);">
                        @if($item->product_image)
                        <img src="{{ asset('storage/'.$item->product_image) }}" class="w-100 h-100" style="object-fit:cover;">
                        @else
                        <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-secondary"><i class="bi bi-box text-white"></i></div>
                        @endif
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-600">{{ $item->product_name }}</div>
                        <div class="text-muted" style="font-size:.85rem;">Qty: {{ $item->quantity }} × ${{ number_format($item->price, 2) }}</div>
                    </div>
                    <div class="fw-700">${{ number_format($item->total, 2) }}</div>
                </div>
                @endforeach
                <div class="p-4">
                    <div class="d-flex justify-content-between mb-1 small"><span>Subtotal</span><span>${{ number_format($order->subtotal, 2) }}</span></div>
                    <div class="d-flex justify-content-between mb-1 small"><span>Shipping</span><span>${{ number_format($order->shipping_cost, 2) }}</span></div>
                    <div class="d-flex justify-content-between mb-2 small"><span>Tax</span><span>${{ number_format($order->tax, 2) }}</span></div>
                    <div class="d-flex justify-content-between fw-700"><span>Total</span><span>${{ number_format($order->total, 2) }}</span></div>
                </div>
            </div>

            {{-- Shipping Info --}}
            <div class="bg-white border rounded-xl p-4" style="border-color:var(--border)!important;">
                <h6 class="mb-3">Shipping Address</h6>
                <p class="mb-1 fw-600">{{ $order->shipping_name }}</p>
                <p class="text-muted mb-1">{{ $order->shipping_email }} · {{ $order->shipping_phone }}</p>
                <p class="text-muted mb-0">{{ $order->shipping_address }}, {{ $order->shipping_city }}, {{ $order->shipping_country }}</p>
            </div>
        </div>
    </div>
</div>
@endsection