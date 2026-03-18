@extends('layouts.frontend')
@section('title', 'My Profile')

@section('content')
<div class="breadcrumb-section">
    <div class="container">
        <nav><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">My Account</li>
        </ol></nav>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">
        <div class="col-lg-3">
            @include('partials.account-sidebar')
        </div>
        <div class="col-lg-9">
            {{-- Profile Card --}}
            <div class="bg-white border rounded-xl p-4 mb-4" style="border-color:var(--border)!important;box-shadow:var(--shadow-sm);">
                <div class="d-flex align-items-center gap-4 mb-4">
                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold flex-shrink-0"
                         style="width:80px;height:80px;background:var(--accent);font-size:1.8rem;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <h4 class="mb-0">{{ $user->name }}</h4>
                        <div class="text-muted">{{ $user->email }}</div>
                        <div class="text-muted" style="font-size:.85rem;">Member since {{ $user->created_at->format('M Y') }}</div>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-accent btn-sm rounded-pill ms-auto">
                        <i class="bi bi-pencil me-1"></i>Edit Profile
                    </a>
                </div>
                <div class="row g-3">
                    @foreach([
                        ['bi-telephone','Phone',$user->phone ?? '—'],
                        ['bi-geo-alt','Address',$user->address ?? '—'],
                        ['bi-building','City',$user->city ?? '—'],
                        ['bi-globe','Country',$user->country ?? '—'],
                    ] as $f)
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-2" style="font-size:.9rem;">
                            <i class="bi {{ $f[0] }} text-accent"></i>
                            <div>
                                <div class="text-muted" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.05em;">{{ $f[1] }}</div>
                                <div class="fw-500">{{ $f[2] }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Recent Orders --}}
            <h5 class="mb-3">Recent Orders</h5>
            @forelse($orders as $order)
            <div class="bg-white border rounded-xl p-3 mb-2 d-flex align-items-center justify-content-between" style="border-color:var(--border)!important;">
                <div>
                    <span class="fw-600 text-accent">{{ $order->order_number }}</span>
                    <span class="text-muted ms-2" style="font-size:.85rem;">{{ $order->created_at->format('M j, Y') }}</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="fw-600">${{ number_format($order->total, 2) }}</span>
                    {!! $order->status_badge !!}
                    <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-accent rounded-pill" style="font-size:.75rem;">View</a>
                </div>
            </div>
            @empty
            <p class="text-muted">No orders yet. <a href="{{ route('shop') }}" class="text-accent">Start shopping!</a></p>
            @endforelse
            @if($orders->count() >= 5)
            <a href="{{ route('orders.index') }}" class="btn btn-outline-accent rounded-pill btn-sm mt-2">View All Orders</a>
            @endif
        </div>
    </div>
</div>
@endsection