@extends('layouts.frontend')
@section('title', 'Shopping Cart')

@section('content')
<div class="breadcrumb-section">
    <div class="container">
        <nav><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Cart</li>
        </ol></nav>
    </div>
</div>

<div class="container py-5">
    <h2 class="mb-4">Shopping Cart
        <span class="text-muted fs-5 fw-normal">({{ $cartItems->sum('quantity') }} items)</span>
    </h2>

    @if($cartItems->isEmpty())
    <div class="text-center py-5">
        <i class="bi bi-bag-x fs-1 text-muted d-block mb-3"></i>
        <h4>Your cart is empty</h4>
        <p class="text-muted">Add some products to get started!</p>
        <a href="{{ route('shop') }}" class="btn btn-accent">Continue Shopping</a>
    </div>
    @else
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="bg-white rounded-xl p-0 border" style="border-color:var(--border)!important;overflow:hidden;">
                {{-- Header --}}
                <div class="d-none d-md-grid px-4 py-3 border-bottom" style="grid-template-columns:2fr 1fr 1fr 1fr;border-color:var(--border)!important;background:var(--bg-light);">
                    <span class="text-muted small fw-600 text-uppercase" style="font-size:.75rem;letter-spacing:.08em;">Product</span>
                    <span class="text-muted small fw-600 text-uppercase text-center" style="font-size:.75rem;letter-spacing:.08em;">Price</span>
                    <span class="text-muted small fw-600 text-uppercase text-center" style="font-size:.75rem;letter-spacing:.08em;">Quantity</span>
                    <span class="text-muted small fw-600 text-uppercase text-end" style="font-size:.75rem;letter-spacing:.08em;">Total</span>
                </div>

                @foreach($cartItems as $item)
                <div class="px-4 py-4 border-bottom d-flex d-md-grid align-items-center gap-3"
                     style="grid-template-columns:2fr 1fr 1fr 1fr;border-color:var(--border)!important;">

                    {{-- Product Info --}}
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-xl overflow-hidden flex-shrink-0" style="width:72px;height:72px;background:var(--bg-light);">
                            <img src="{{ $item->product->main_image_url }}" alt="{{ $item->product->name }}"
                                 class="w-100 h-100" style="object-fit:cover;">
                        </div>
                        <div>
                            <a href="{{ route('product.show', $item->product->slug) }}" class="fw-600" style="font-size:.9rem;color:var(--primary);">
                                {{ Str::limit($item->product->name, 35) }}
                            </a>
                            <div class="text-muted" style="font-size:.78rem;">{{ $item->product->category->name }}</div>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-link p-0 text-danger" style="font-size:.78rem;">
                                    <i class="bi bi-trash me-1"></i>Remove
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Price --}}
                    <div class="text-center fw-600" style="font-size:.95rem;">
                        ${{ number_format($item->price, 2) }}
                    </div>

                    {{-- Quantity --}}
                    <div class="d-flex align-items-center justify-content-center">
                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex align-items-center">
                            @csrf @method('PATCH')
                            <div class="d-flex align-items-center border rounded-pill overflow-hidden" style="border-color:var(--border)!important;">
                                <button type="button" class="btn border-0 px-2 py-1" onclick="this.nextElementSibling.value=Math.max(1,parseInt(this.nextElementSibling.value)-1);this.closest('form').submit()">−</button>
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                                       class="form-control border-0 text-center p-0 fw-600"
                                       style="width:36px;font-size:.875rem;" onchange="this.closest('form').submit()">
                                <button type="button" class="btn border-0 px-2 py-1" onclick="this.previousElementSibling.value=parseInt(this.previousElementSibling.value)+1;this.closest('form').submit()">+</button>
                            </div>
                        </form>
                    </div>

                    {{-- Total --}}
                    <div class="text-end fw-700" style="color:var(--primary);">
                        ${{ number_format($item->price * $item->quantity, 2) }}
                    </div>
                </div>
                @endforeach

                {{-- Actions --}}
                <div class="px-4 py-3 d-flex justify-content-between align-items-center" style="background:var(--bg-light);">
                    <a href="{{ route('shop') }}" class="btn btn-outline-secondary rounded-pill btn-sm">
                        <i class="bi bi-arrow-left me-1"></i>Continue Shopping
                    </a>
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger rounded-pill btn-sm">
                            <i class="bi bi-trash me-1"></i>Clear Cart
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Summary --}}
        <div class="col-lg-4">
            <div class="bg-white rounded-xl border p-4" style="border-color:var(--border)!important;box-shadow:var(--shadow-md);">
                <h5 class="mb-4" style="font-size:1.4rem;">Order Summary</h5>
                <div class="d-flex justify-content-between mb-2" style="font-size:.9rem;">
                    <span>Subtotal</span><span>${{ number_format($subtotal, 2) }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2" style="font-size:.9rem;">
                    <span>Shipping</span>
                    <span>{{ $subtotal >= 100 ? '<span class="text-success">Free</span>' : '$10.00' }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2" style="font-size:.9rem;">
                    <span>Tax (8%)</span><span>${{ number_format($subtotal * 0.08, 2) }}</span>
                </div>
                <hr style="border-color:var(--border);">
                <div class="d-flex justify-content-between fw-700 mb-4" style="font-size:1.1rem;">
                    <span>Total</span>
                    <span style="color:var(--primary);">${{ number_format($subtotal + ($subtotal >= 100 ? 0 : 10) + $subtotal * 0.08, 2) }}</span>
                </div>
                @auth
                <a href="{{ route('checkout.index') }}" class="btn btn-accent w-100 py-3">
                    Proceed to Checkout <i class="bi bi-arrow-right ms-1"></i>
                </a>
                @else
                <a href="{{ route('login') }}" class="btn btn-accent w-100 py-3">
                    Sign In to Checkout <i class="bi bi-arrow-right ms-1"></i>
                </a>
                @endauth
                <div class="mt-3 text-center text-muted" style="font-size:.8rem;">
                    <i class="bi bi-shield-lock me-1"></i>Secure checkout with SSL encryption
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection