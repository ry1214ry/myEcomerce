@extends('layouts.frontend')
@section('title', 'My Orders')

@section('content')
<div class="breadcrumb-section">
    <div class="container">
        <nav><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('profile.show') }}">My Account</a></li>
            <li class="breadcrumb-item active">Orders</li>
        </ol></nav>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-3 mb-4">
            @include('partials.account-sidebar')
        </div>
        <div class="col-lg-9">
            <h4 class="mb-4">My Orders</h4>
            @forelse($orders as $order)
            <div class="bg-white border rounded-xl p-4 mb-3" style="border-color:var(--border)!important;box-shadow:var(--shadow-sm);">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
                    <div>
                        <h6 class="mb-0 fw-700" style="color:var(--accent);">{{ $order->order_number }}</h6>
                        <small class="text-muted">{{ $order->created_at->format('M j, Y \a\t g:i A') }}</small>
                    </div>
                    <div class="d-flex gap-2 align-items-center">
                        {!! $order->status_badge !!}
                        <span class="badge bg-light text-dark border">{{ ucfirst($order->payment_status) }}</span>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2 mb-3">
                    @foreach($order->items->take(3) as $item)
                    <div class="rounded-xl overflow-hidden" style="width:52px;height:52px;background:var(--bg-light);flex-shrink:0;">
                        @if($item->product_image)
                        <img src="{{ \App\Support\PublicMedia::url($item->product_image, 'https://images.unsplash.com/photo-1560393464-5c69a73c5770?w=600&h=600&fit=crop') }}" class="w-100 h-100" style="object-fit:cover;">
                        @else
                        <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-secondary">
                            <i class="bi bi-box text-white"></i>
                        </div>
                        @endif
                    </div>
                    @endforeach
                    @if($order->items->count() > 3)
                    <div class="rounded-xl d-flex align-items-center justify-content-center bg-light" style="width:52px;height:52px;font-size:.8rem;font-weight:600;color:var(--text-muted);">
                        +{{ $order->items->count() - 3 }}
                    </div>
                    @endif
                    <div class="ms-auto text-end">
                        <div class="fw-700" style="font-size:1.05rem;">${{ number_format($order->total, 2) }}</div>
                        <div class="text-muted" style="font-size:.8rem;">{{ $order->items->sum('quantity') }} item(s)</div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('orders.show', $order) }}" class="btn btn-outline-accent btn-sm rounded-pill">
                        View Details <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
            @empty
            <div class="text-center py-5">
                <i class="bi bi-bag-x fs-1 text-muted d-block mb-3"></i>
                <h5>No orders yet</h5>
                <p class="text-muted">You haven't placed any orders yet.</p>
                <a href="{{ route('shop') }}" class="btn btn-accent">Start Shopping</a>
            </div>
            @endforelse
            <div class="d-flex justify-content-center mt-4">{{ $orders->links() }}</div>
        </div>
    </div>
</div>
@endsection
