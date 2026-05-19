@extends('layouts.frontend')
@section('title', 'Bakong KHQR Payment')

@push('styles')
<style>
    :root {
        --bakong-red: #E11F26;
        --bakong-dark: #b3161b;
        --bakong-gray: #6c757d;
        --bg-light: #f4f7fa;
    }

    /* Page Setup */
    .qr-page {
        min-height: 100vh;
        background-color: var(--bg-light);
        display: flex; align-items: center; justify-content: center;
        padding: 2rem 1rem;
    }

    /* Bakong Style Card */
    .qr-card {
        background: #ffffff;
        border-radius: 20px;
        width: 100%; max-width: 400px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        overflow: hidden;
        position: relative;
        text-align: center;
    }

    /* Red Header */
    .qr-header {
        background: var(--bakong-red);
        padding: 1.5rem;
        color: white;
    }
    .khqr-logo {
        height: 35px;
        margin-bottom: 0.5rem;
    }
    .merchant-name {
        font-weight: 700;
        font-size: 1.1rem;
        margin: 0;
        text-transform: uppercase;
    }

    /* Info Section */
    .qr-body { padding: 1.5rem; }

    .amount-display {
        margin-bottom: 1.5rem;
    }
    .amount-label {
        font-size: 0.8rem;
        color: var(--bakong-gray);
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .amount-val {
        font-size: 2rem;
        font-weight: 800;
        color: #333;
    }

    /* QR Frame - Authentic Bakong Look */
    .qr-frame-container {
        position: relative;
        background: white;
        padding: 15px;
        border: 2px solid #eee;
        border-radius: 15px;
        display: inline-block;
        margin-bottom: 1rem;
    }
    
    /* The red corners for KHQR */
    .qr-frame-container::before, .qr-frame-container::after,
    .qr-corner-bl, .qr-corner-br {
        content: ""; position: absolute; width: 25px; height: 25px;
        border: 4px solid var(--bakong-red);
    }
    .qr-frame-container::before { top: -2px; left: -2px; border-right: 0; border-bottom: 0; border-top-left-radius: 15px; }
    .qr-frame-container::after { top: -2px; right: -2px; border-left: 0; border-bottom: 0; border-top-right-radius: 15px; }
    .qr-corner-bl { bottom: -2px; left: -2px; border-right: 0; border-top: 0; border-bottom-left-radius: 15px; }
    .qr-corner-br { bottom: -2px; right: -2px; border-left: 0; border-top: 0; border-bottom-right-radius: 15px; }

    .qr-frame-container svg {
        width: 220px !important; height: 220px !important;
        display: block;
    }

    /* Status & Timer */
    .qr-status {
        font-size: 0.9rem;
        font-weight: 600;
        margin-top: 1rem;
        padding: 8px 15px;
        border-radius: 50px;
        display: inline-flex; align-items: center; gap: 8px;
    }
    .status-waiting { background: #fff4f4; color: var(--bakong-red); }
    .status-dot {
        width: 8px; height: 8px; background: var(--bakong-red);
        border-radius: 50%; animation: pulse 1.5s infinite;
    }

    .timer-text {
        font-size: 0.8rem;
        color: #999;
        margin-top: 10px;
    }

    /* Footer Details */
    .qr-footer {
        background: #fdfdfd;
        border-top: 1px dashed #eee;
        padding: 1.25rem;
        text-align: left;
    }
    .detail-row {
        display: flex; justify-content: space-between;
        margin-bottom: 5px; font-size: 0.85rem;
    }
    .detail-label { color: #888; }
    .detail-val { font-weight: 600; color: #444; }

    @keyframes pulse {
        0% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.4); opacity: 0.5; }
        100% { transform: scale(1); opacity: 1; }
    }

    .btn-cancel {
        display: block; width: 100%; padding: 10px;
        text-align: center; color: #888;
        text-decoration: none; font-size: 0.85rem;
        margin-top: 10px;
    }
</style>
@endpush

@section('content')
<div class="qr-page">
    <div class="qr-card">
        {{-- Bakong Header --}}
        <div class="qr-header">
            <div class="merchant-name">LUXE SHOP</div>
            <div style="font-size: 0.7rem; opacity: 0.9;">SCAN TO PAY WITH KHQR</div>
        </div>

        <div class="qr-body">
            {{-- Amount --}}
            <div class="amount-display">
                <div class="amount-label">Total Amount</div>
                <div class="amount-val">${{ number_format($order->total, 2) }}</div>
            </div>

            {{-- QR Code with Red Corners --}}
            <div class="qr-frame-container" id="qrFrame">
                <div class="qr-corner-bl"></div>
                <div class="qr-corner-br"></div>
                @if($qr)
                    {!! QrCode::size(220)->margin(1)->generate($qr) !!}
                @endif
            </div>

            {{-- Status --}}
            <div id="payStatus" class="qr-status status-waiting">
                <span class="status-dot"></span>
                Waiting for payment...
            </div>

            <div class="timer-text">
                Expires in <span id="countdown">120</span>s
            </div>
        </div>

        {{-- Order Details --}}
        <div class="qr-footer">
            <div class="detail-row">
                <span class="detail-label">Order ID:</span>
                <span class="detail-val">{{ $order->order_number }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Ref Hash:</span>
                <span class="detail-val" style="font-family: monospace; font-size: 0.7rem;">{{ substr($md5, 0, 16) }}...</span>
            </div>
            
            <a href="{{ route('home') }}" class="btn-cancel">
                <i class="bi bi-x-circle"></i> Cancel Payment
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// (Keep your existing polling logic, just update the setStatus function if needed)
document.addEventListener('DOMContentLoaded', function () {
    let timeLeft = 120;
    const countdownEl = document.getElementById('countdown');

    const timer = setInterval(() => {
        timeLeft--;
        if(countdownEl) countdownEl.textContent = timeLeft;
        
        // Polling logic remains same as your original code
        if (timeLeft <= 0) {
            clearInterval(timer);
            window.location.href = "{{ route('orders.index') }}";
        }
    }, 1000);
});
</script>
@endpush