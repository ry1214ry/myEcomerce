@extends('layouts.frontend')
@section('title', 'Checkout')

@section('content')
<div class="breadcrumb-section">
    <div class="container">
        <nav><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('cart.index') }}">Cart</a></li>
            <li class="breadcrumb-item active">Checkout</li>
        </ol></nav>
    </div>
</div>

<div class="container py-5">
    <h2 class="mb-4">Checkout</h2>
    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <div class="row g-4">

            {{-- Shipping Info --}}
            <div class="col-lg-8">
                <div class="bg-white rounded-xl border p-4 mb-4" style="border-color:var(--border)!important;">
                    <h5 class="mb-4" style="font-size:1.3rem;">
                        <i class="bi bi-geo-alt me-2 text-accent"></i>Shipping Information
                    </h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-500">Full Name *</label>
                            <input type="text" name="shipping_name" class="form-control rounded-pill @error('shipping_name') is-invalid @enderror"
                                   value="{{ old('shipping_name', auth()->user()->name) }}" required>
                            @error('shipping_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-500">Email *</label>
                            <input type="email" name="shipping_email" class="form-control rounded-pill @error('shipping_email') is-invalid @enderror"
                                   value="{{ old('shipping_email', auth()->user()->email) }}" required>
                            @error('shipping_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-500">Phone *</label>
                            <input type="text" name="shipping_phone" class="form-control rounded-pill @error('shipping_phone') is-invalid @enderror"
                                   value="{{ old('shipping_phone', auth()->user()->phone) }}" required>
                            @error('shipping_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-500">Country *</label>
                            <input type="text" name="shipping_country" class="form-control rounded-pill @error('shipping_country') is-invalid @enderror"
                                   value="{{ old('shipping_country', auth()->user()->country ?? 'USA') }}" required>
                            @error('shipping_country')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-500">Street Address *</label>
                            <input type="text" name="shipping_address" class="form-control rounded-pill @error('shipping_address') is-invalid @enderror"
                                   value="{{ old('shipping_address', auth()->user()->address) }}" required>
                            @error('shipping_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-500">City *</label>
                            <input type="text" name="shipping_city" class="form-control rounded-pill @error('shipping_city') is-invalid @enderror"
                                   value="{{ old('shipping_city', auth()->user()->city) }}" required>
                            @error('shipping_city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-500">State</label>
                            <input type="text" name="shipping_state" class="form-control rounded-pill"
                                   value="{{ old('shipping_state', auth()->user()->state) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-500">ZIP Code *</label>
                            <input type="text" name="shipping_zip" class="form-control rounded-pill @error('shipping_zip') is-invalid @enderror"
                                   value="{{ old('shipping_zip', auth()->user()->zip_code) }}" required>
                            @error('shipping_zip')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-500">Order Notes (Optional)</label>
                            <textarea name="notes" class="form-control rounded-3" rows="3" placeholder="Any special instructions..."></textarea>
                        </div>
                    </div>
                </div>

                {{-- Payment --}}
                <div class="bg-white rounded-xl border p-4" style="border-color:var(--border)!important;">
                    <h5 class="mb-4" style="font-size:1.3rem;">
                        <i class="bi bi-credit-card me-2 text-accent"></i>Payment Method
                    </h5>
                    <div class="row g-3">
                        @foreach([
                            ['cod','bi-cash-coin','Cash on Delivery','Pay when your order arrives'],
                            ['card','bi-credit-card','Credit / Debit Card','Visa, Mastercard, Amex'],
                            ['paypal','bi-paypal','PayPal','Fast, secure online payment'],
                        ] as $pm)
                        <div class="col-md-4">
                            <label class="d-block cursor-pointer">
                                <input type="radio" name="payment_method" value="{{ $pm[0] }}"
                                       {{ old('payment_method', 'cod') == $pm[0] ? 'checked' : '' }}
                                       class="d-none payment-radio" id="pm-{{ $pm[0] }}">
                                <div class="border rounded-xl p-3 text-center h-100 payment-option"
                                     style="border-color:var(--border)!important;cursor:pointer;transition:all .2s;"
                                     onclick="selectPayment('{{ $pm[0] }}')">
                                    <i class="bi {{ $pm[1] }} fs-2 text-accent d-block mb-2"></i>
                                    <div class="fw-600" style="font-size:.875rem;">{{ $pm[2] }}</div>
                                    <div class="text-muted" style="font-size:.75rem;">{{ $pm[3] }}</div>
                                </div>
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Order Summary --}}
            <div class="col-lg-4">
                <div class="bg-white rounded-xl border p-4 sticky-top" style="border-color:var(--border)!important;top:80px;box-shadow:var(--shadow-md);">
                    <h5 class="mb-4" style="font-size:1.3rem;">Order Summary</h5>

                    @foreach($cartItems as $item)
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="rounded-xl overflow-hidden flex-shrink-0" style="width:52px;height:52px;background:var(--bg-light);">
                            <img src="{{ $item->product->main_image_url }}" class="w-100 h-100" style="object-fit:cover;">
                        </div>
                        <div class="flex-grow-1">
                            <div style="font-size:.85rem;font-weight:500;">{{ Str::limit($item->product->name, 28) }}</div>
                            <div class="text-muted" style="font-size:.75rem;">Qty: {{ $item->quantity }}</div>
                        </div>
                        <div class="fw-600" style="font-size:.875rem;">${{ number_format($item->price * $item->quantity, 2) }}</div>
                    </div>
                    @endforeach

                    <hr style="border-color:var(--border);">
                    <div class="d-flex justify-content-between mb-2 small"><span>Subtotal</span><span>${{ number_format($subtotal, 2) }}</span></div>
                    <div class="d-flex justify-content-between mb-2 small"><span>Shipping</span><span>{{ $shipping == 0 ? '<span class="text-success">Free</span>' : '$'.number_format($shipping,2) }}</span></div>
                    <div class="d-flex justify-content-between mb-2 small"><span>Tax (8%)</span><span>${{ number_format($tax, 2) }}</span></div>
                    <hr style="border-color:var(--border);">
                    <div class="d-flex justify-content-between fw-700 mb-4" style="font-size:1.1rem;">
                        <span>Total</span>
                        <span style="color:var(--primary);">${{ number_format($total, 2) }}</span>
                    </div>

                    <button type="submit" class="btn btn-accent w-100 py-3">
                        <i class="bi bi-lock me-2"></i>Place Order — ${{ number_format($total, 2) }}
                    </button>
                    <div class="mt-2 text-center text-muted" style="font-size:.78rem;">
                        <i class="bi bi-shield-check me-1"></i>256-bit SSL encrypted & secure
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
function selectPayment(id) {
    document.querySelectorAll('.payment-option').forEach(el => {
        el.style.borderColor = 'var(--border)';
        el.style.background = '#fff';
    });
    const selected = document.querySelector(`#pm-${id}`);
    selected.checked = true;
    selected.nextElementSibling.style.borderColor = 'var(--accent)';
    selected.nextElementSibling.style.background = '#fdf9f0';
}
selectPayment('cod');
</script>
@endpush
@endsection