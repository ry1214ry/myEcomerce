<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account — LuxeShop</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary:      #1a1a2e;
            --primary-dark: #0f0f23;
            --accent:       #c9a96e;
            --accent-hover: #b8934a;
            --accent-light: #e8d5b0;
            --bg-light:     #f8f6f1;
            --border:       #e2e8f0;
            --text-muted:   #64748b;
            --shadow-lg:    0 24px 80px rgba(26,26,46,.18);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg-light);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── PAGE BACKGROUND ── */
        .auth-page {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            position: relative;
            overflow: hidden;
        }
        .auth-page::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse at 20% 50%, rgba(201,169,110,.08) 0%, transparent 60%),
                radial-gradient(ellipse at 80% 20%, rgba(26,26,46,.06) 0%, transparent 50%);
            pointer-events: none;
        }

        /* ── MAIN CARD ── */
        .auth-card {
            display: flex;
            width: 100%;
            max-width: 1040px;
            min-height: 640px;
            background: #fff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            position: relative;
            z-index: 1;
        }

        /* ── LEFT PANEL ── */
        .auth-left {
            width: 380px;
            flex-shrink: 0;
            background: linear-gradient(160deg, #1a1a2e 0%, #0f0f23 50%, #1a1a2e 100%);
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }
        .auth-left::before {
            content: '';
            position: absolute;
            top: -80px;
            right: -80px;
            width: 240px;
            height: 240px;
            border-radius: 50%;
            background: rgba(201,169,110,.06);
            pointer-events: none;
        }
        .auth-left::after {
            content: '';
            position: absolute;
            bottom: -60px;
            left: -60px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(201,169,110,.04);
            pointer-events: none;
        }
        .auth-brand {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2rem;
            font-weight: 700;
            color: #fff;
            text-decoration: none;
            display: inline-block;
        }
        .auth-brand span { color: var(--accent); }

        .auth-left-content { position: relative; z-index: 1; }

        .auth-left h2 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.4rem;
            font-weight: 700;
            color: #fff;
            line-height: 1.15;
            margin-bottom: 1rem;
        }
        .auth-left p {
            color: rgba(255,255,255,.65);
            font-size: .9rem;
            line-height: 1.75;
        }

        .auth-perks { margin-top: 2rem; }
        .auth-perk {
            display: flex;
            align-items: flex-start;
            gap: .85rem;
            margin-bottom: 1.2rem;
        }
        .auth-perk-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: rgba(201,169,110,.15);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 1px;
        }
        .auth-perk-icon i { color: var(--accent); font-size: .95rem; }
        .auth-perk-text strong {
            display: block;
            color: #fff;
            font-size: .875rem;
            font-weight: 600;
            margin-bottom: .15rem;
        }
        .auth-perk-text span {
            color: rgba(255,255,255,.5);
            font-size: .8rem;
        }

        .auth-left-footer {
            position: relative;
            z-index: 1;
            border-top: 1px solid rgba(255,255,255,.08);
            padding-top: 1.5rem;
        }
        .auth-left-footer p {
            color: rgba(255,255,255,.4);
            font-size: .78rem;
            margin: 0;
        }
        .auth-left-footer a { color: var(--accent); }

        /* ── RIGHT PANEL ── */
        .auth-right {
            flex: 1;
            padding: 2.5rem 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow-y: auto;
        }

        .auth-back {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            color: var(--text-muted);
            font-size: .825rem;
            text-decoration: none;
            margin-bottom: 1.75rem;
            transition: color .2s;
        }
        .auth-back:hover { color: var(--accent); }

        .auth-heading {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: .35rem;
        }
        .auth-subheading {
            color: var(--text-muted);
            font-size: .875rem;
            margin-bottom: 1.75rem;
        }
        .auth-subheading a {
            color: var(--accent);
            font-weight: 500;
            text-decoration: none;
        }
        .auth-subheading a:hover { color: var(--accent-hover); }

        /* ── STEP PROGRESS ── */
        .step-progress {
            display: flex;
            align-items: center;
            gap: 0;
            margin-bottom: 2rem;
        }
        .step-item {
            display: flex;
            align-items: center;
            gap: .5rem;
            flex: 1;
        }
        .step-circle {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .75rem;
            font-weight: 700;
            border: 2px solid var(--border);
            color: var(--text-muted);
            background: #fff;
            flex-shrink: 0;
            transition: all .3s;
        }
        .step-circle.active {
            border-color: var(--accent);
            background: var(--accent);
            color: #fff;
        }
        .step-circle.done {
            border-color: #22c55e;
            background: #22c55e;
            color: #fff;
        }
        .step-label {
            font-size: .75rem;
            font-weight: 500;
            color: var(--text-muted);
            white-space: nowrap;
        }
        .step-label.active { color: var(--accent); }
        .step-line {
            flex: 1;
            height: 2px;
            background: var(--border);
            margin: 0 .5rem;
            transition: background .3s;
        }
        .step-line.done { background: #22c55e; }

        /* ── FORM SECTIONS ── */
        .form-section {
            display: none;
        }
        .form-section.active { display: block; }

        .section-title {
            font-size: .75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .12em;
            color: var(--accent);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        .section-title::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        /* ── FORM CONTROLS ── */
        .form-label {
            font-size: .825rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: .4rem;
        }
        .form-label .required { color: var(--accent); margin-left: 2px; }

        .input-wrap {
            position: relative;
        }
        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: .9rem;
            pointer-events: none;
            z-index: 2;
        }
        .form-control {
            border: 1.5px solid var(--border);
            border-radius: 50px;
            padding: .65rem 1.2rem .65rem 2.6rem;
            font-size: .875rem;
            color: var(--primary);
            background: #fff;
            transition: all .25s;
            width: 100%;
        }
        .form-control:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(201,169,110,.12);
            background: #fff;
        }
        .form-control.is-invalid {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239,68,68,.1);
        }
        .form-control.is-valid {
            border-color: #22c55e;
        }
        .form-control::placeholder { color: #b0bec5; }

        /* password toggle */
        .toggle-pwd {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            font-size: .9rem;
            padding: 0;
            z-index: 2;
            transition: color .2s;
        }
        .toggle-pwd:hover { color: var(--accent); }

        .invalid-feedback {
            color: #ef4444;
            font-size: .78rem;
            margin-top: .3rem;
            padding-left: .5rem;
            display: flex;
            align-items: center;
            gap: .25rem;
        }

        /* ── PASSWORD STRENGTH ── */
        .strength-bar {
            display: flex;
            gap: 4px;
            margin-top: .5rem;
        }
        .strength-segment {
            flex: 1;
            height: 4px;
            border-radius: 4px;
            background: var(--border);
            transition: background .3s;
        }
        .strength-segment.weak   { background: #ef4444; }
        .strength-segment.fair   { background: #f97316; }
        .strength-segment.good   { background: #eab308; }
        .strength-segment.strong { background: #22c55e; }
        .strength-label {
            font-size: .75rem;
            margin-top: .3rem;
            font-weight: 500;
        }

        /* ── TERMS CHECKBOX ── */
        .terms-check {
            display: flex;
            align-items: flex-start;
            gap: .65rem;
            padding: 1rem;
            background: var(--bg-light);
            border-radius: 12px;
            border: 1.5px solid var(--border);
            cursor: pointer;
            transition: border-color .2s;
        }
        .terms-check:hover { border-color: var(--accent); }
        .terms-check input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--accent);
            flex-shrink: 0;
            margin-top: 2px;
            cursor: pointer;
        }
        .terms-check label {
            font-size: .825rem;
            color: var(--text-muted);
            cursor: pointer;
            line-height: 1.5;
        }
        .terms-check label a { color: var(--accent); font-weight: 500; text-decoration: none; }

        /* ── SUBMIT BUTTON ── */
        .btn-register {
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: .85rem 2rem;
            font-weight: 600;
            font-size: .925rem;
            letter-spacing: .04em;
            transition: all .3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            cursor: pointer;
            width: 100%;
        }
        .btn-register:hover {
            background: var(--accent-hover);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(201,169,110,.35);
        }
        .btn-register:active { transform: translateY(0); }
        .btn-register:disabled { opacity: .65; cursor: not-allowed; transform: none; }

        .btn-next {
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: .75rem 2rem;
            font-weight: 600;
            font-size: .875rem;
            transition: all .3s;
            display: flex;
            align-items: center;
            gap: .5rem;
            cursor: pointer;
        }
        .btn-next:hover { background: var(--primary-dark); transform: translateY(-1px); }

        .btn-back-step {
            background: transparent;
            color: var(--text-muted);
            border: 1.5px solid var(--border);
            border-radius: 50px;
            padding: .75rem 1.5rem;
            font-weight: 500;
            font-size: .875rem;
            transition: all .2s;
            cursor: pointer;
        }
        .btn-back-step:hover { border-color: var(--accent); color: var(--accent); }

        /* ── DIVIDER ── */
        .auth-divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 1.25rem 0;
            color: var(--text-muted);
            font-size: .8rem;
        }
        .auth-divider::before,
        .auth-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        /* ── SOCIAL BUTTONS ── */
        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .6rem;
            padding: .7rem 1.5rem;
            border: 1.5px solid var(--border);
            border-radius: 50px;
            font-size: .85rem;
            font-weight: 500;
            color: var(--primary);
            background: #fff;
            cursor: pointer;
            transition: all .2s;
            text-decoration: none;
            flex: 1;
        }
        .social-btn:hover {
            border-color: var(--accent);
            background: #fdf9f0;
            color: var(--primary);
            transform: translateY(-1px);
        }
        .social-btn img { width: 18px; height: 18px; }

        /* ── SUCCESS STATE ── */
        .success-section {
            display: none;
            text-align: center;
            padding: 2rem 0;
        }
        .success-section.active { display: block; }
        .success-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(34,197,94,.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 991px) {
            .auth-left { display: none; }
            .auth-card { max-width: 540px; border-radius: 20px; }
            .auth-right { padding: 2rem; }
        }
        @media (max-width: 576px) {
            .auth-right { padding: 1.5rem; }
            .auth-heading { font-size: 1.7rem; }
        }
    </style>
</head>
<body>

<div class="auth-page">
    <div class="auth-card">

        {{-- ── LEFT PANEL ─────────────────────────────────── --}}
        <div class="auth-left">
            <div>
                <a href="{{ route('home') }}" class="auth-brand">Luxe<span>Shop</span></a>
            </div>

            <div class="auth-left-content">
                <h2>Join our<br>community<br>today.</h2>
                <p>Create your free account and start enjoying an exclusive premium shopping experience.</p>

                <div class="auth-perks">
                    <div class="auth-perk">
                        <div class="auth-perk-icon"><i class="bi bi-truck"></i></div>
                        <div class="auth-perk-text">
                            <strong>Free Shipping</strong>
                            <span>On all orders over $100</span>
                        </div>
                    </div>
                    <div class="auth-perk">
                        <div class="auth-perk-icon"><i class="bi bi-tag"></i></div>
                        <div class="auth-perk-text">
                            <strong>Member Discounts</strong>
                            <span>Exclusive deals for members</span>
                        </div>
                    </div>
                    <div class="auth-perk">
                        <div class="auth-perk-icon"><i class="bi bi-arrow-counterclockwise"></i></div>
                        <div class="auth-perk-text">
                            <strong>Easy Returns</strong>
                            <span>30-day hassle-free returns</span>
                        </div>
                    </div>
                    <div class="auth-perk">
                        <div class="auth-perk-icon"><i class="bi bi-shield-check"></i></div>
                        <div class="auth-perk-text">
                            <strong>Secure Checkout</strong>
                            <span>256-bit SSL encryption</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="auth-left-footer">
                <p>&copy; {{ date('Y') }} LuxeShop. All rights reserved.</p>
            </div>
        </div>

        {{-- ── RIGHT PANEL ──────────────────────────────────── --}}
        <div class="auth-right">

            <a href="{{ route('home') }}" class="auth-back">
                <i class="bi bi-arrow-left"></i> Back to Store
            </a>

            <h1 class="auth-heading">Create Account</h1>
            <p class="auth-subheading">
                Already have an account? <a href="{{ route('login') }}">Sign in here</a>
            </p>

            {{-- ── ERROR ALERT ── --}}
            @if($errors->any())
            <div class="alert alert-danger d-flex align-items-start gap-2 rounded-3 border-0 mb-3"
                 style="background:#fef2f2;border-left:4px solid #ef4444!important;font-size:.875rem;">
                <i class="bi bi-exclamation-circle-fill text-danger mt-1"></i>
                <div>
                    <strong>Please fix the following errors:</strong>
                    <ul class="mb-0 mt-1 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            {{-- ── STEP PROGRESS ── --}}
            <div class="step-progress" id="stepProgress">
                <div class="step-item">
                    <div class="step-circle active" id="circle1">1</div>
                    <span class="step-label active" id="label1">Account</span>
                </div>
                <div class="step-line" id="line1"></div>
                <div class="step-item">
                    <div class="step-circle" id="circle2">2</div>
                    <span class="step-label" id="label2">Personal</span>
                </div>
                <div class="step-line" id="line2"></div>
                <div class="step-item">
                    <div class="step-circle" id="circle3">3</div>
                    <span class="step-label" id="label3">Confirm</span>
                </div>
            </div>

            {{-- ── MAIN FORM ── --}}
            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf

                {{-- ═══ STEP 1 — Account Info ═══ --}}
                <div class="form-section active" id="step1">
                    <div class="section-title">Account Information</div>

                    <div class="mb-3">
                        <label class="form-label">
                            Full Name <span class="required">*</span>
                        </label>
                        <div class="input-wrap">
                            <i class="bi bi-person input-icon"></i>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}"
                                placeholder="John Smith"
                                autocomplete="name"
                                required>
                        </div>
                        @error('name')
                            <div class="invalid-feedback"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Email Address <span class="required">*</span>
                        </label>
                        <div class="input-wrap">
                            <i class="bi bi-envelope input-icon"></i>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"
                                placeholder="john@example.com"
                                autocomplete="email"
                                required>
                        </div>
                        @error('email')
                            <div class="invalid-feedback"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Password <span class="required">*</span>
                        </label>
                        <div class="input-wrap">
                            <i class="bi bi-lock input-icon"></i>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Min. 8 characters"
                                autocomplete="new-password"
                                oninput="checkStrength(this.value)"
                                required>
                            <button type="button" class="toggle-pwd" onclick="togglePwd('password', this)">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        {{-- Strength Bar --}}
                        <div class="strength-bar mt-2" id="strengthBar">
                            <div class="strength-segment" id="s1"></div>
                            <div class="strength-segment" id="s2"></div>
                            <div class="strength-segment" id="s3"></div>
                            <div class="strength-segment" id="s4"></div>
                        </div>
                        <div class="strength-label text-muted" id="strengthLabel" style="font-size:.75rem;margin-top:.3rem;"></div>
                        @error('password')
                            <div class="invalid-feedback"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">
                            Confirm Password <span class="required">*</span>
                        </label>
                        <div class="input-wrap">
                            <i class="bi bi-lock-fill input-icon"></i>
                            <input
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                class="form-control"
                                placeholder="Repeat your password"
                                autocomplete="new-password"
                                oninput="checkMatch()"
                                required>
                            <button type="button" class="toggle-pwd" onclick="togglePwd('password_confirmation', this)">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        <div class="invalid-feedback" id="matchMsg" style="display:none;">
                            <i class="bi bi-exclamation-circle"></i> Passwords do not match
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn-next" onclick="goToStep(2)">
                            Next <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>

                    <div class="auth-divider">or sign up with</div>
                    <div class="d-flex gap-2">
                        <a href="#" class="social-btn">
                            <img src="https://www.google.com/favicon.ico" alt="Google"> Google
                        </a>
                        <a href="#" class="social-btn">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="#1877F2"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            Facebook
                        </a>
                    </div>
                </div>

                {{-- ═══ STEP 2 — Personal Info ═══ --}}
                <div class="form-section" id="step2">
                    <div class="section-title">Personal Details <small class="text-muted fw-normal" style="font-size:.7rem;text-transform:none;letter-spacing:0;">(Optional — can be updated later)</small></div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Phone Number</label>
                            <div class="input-wrap">
                                <i class="bi bi-telephone input-icon"></i>
                                <input type="tel" name="phone" class="form-control"
                                       value="{{ old('phone') }}" placeholder="+1 234 567 8900">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Country</label>
                            <div class="input-wrap">
                                <i class="bi bi-globe input-icon"></i>
                                <input type="text" name="country" class="form-control"
                                       value="{{ old('country') }}" placeholder="United States">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Street Address</label>
                        <div class="input-wrap">
                            <i class="bi bi-geo-alt input-icon"></i>
                            <input type="text" name="address" class="form-control"
                                   value="{{ old('address') }}" placeholder="123 Main Street">
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-5">
                            <label class="form-label">City</label>
                            <div class="input-wrap">
                                <i class="bi bi-building input-icon"></i>
                                <input type="text" name="city" class="form-control"
                                       value="{{ old('city') }}" placeholder="New York">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">State</label>
                            <div class="input-wrap">
                                <i class="bi bi-map input-icon"></i>
                                <input type="text" name="state" class="form-control"
                                       value="{{ old('state') }}" placeholder="NY">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">ZIP Code</label>
                            <div class="input-wrap">
                                <i class="bi bi-mailbox input-icon"></i>
                                <input type="text" name="zip_code" class="form-control"
                                       value="{{ old('zip_code') }}" placeholder="10001">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2 justify-content-between">
                        <button type="button" class="btn-back-step" onclick="goToStep(1)">
                            <i class="bi bi-arrow-left"></i> Back
                        </button>
                        <button type="button" class="btn-next" onclick="goToStep(3)">
                            Next <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>

                {{-- ═══ STEP 3 — Confirm & Submit ═══ --}}
                <div class="form-section" id="step3">
                    <div class="section-title">Review & Confirm</div>

                    {{-- Summary Card --}}
                    <div class="p-3 rounded-3 mb-4" style="background:var(--bg-light);border:1.5px solid var(--border);">
                        <div class="row g-2" style="font-size:.85rem;">
                            <div class="col-12 d-flex justify-content-between py-1 border-bottom" style="border-color:#e2e8f0!important;">
                                <span class="text-muted">Full Name</span>
                                <span class="fw-600" id="summaryName">—</span>
                            </div>
                            <div class="col-12 d-flex justify-content-between py-1 border-bottom" style="border-color:#e2e8f0!important;">
                                <span class="text-muted">Email</span>
                                <span class="fw-600" id="summaryEmail">—</span>
                            </div>
                            <div class="col-12 d-flex justify-content-between py-1 border-bottom" style="border-color:#e2e8f0!important;">
                                <span class="text-muted">Phone</span>
                                <span class="fw-600" id="summaryPhone">—</span>
                            </div>
                            <div class="col-12 d-flex justify-content-between py-1">
                                <span class="text-muted">Location</span>
                                <span class="fw-600" id="summaryLocation">—</span>
                            </div>
                        </div>
                    </div>

                    {{-- Terms --}}
                    <div class="mb-3">
                        <label class="terms-check" for="terms">
                            <input type="checkbox" id="terms" required>
                            <span>
                                I agree to the
                                <a href="#" target="_blank">Terms of Service</a>
                                and
                                <a href="#" target="_blank">Privacy Policy</a>
                                of LuxeShop.
                            </span>
                        </label>
                    </div>

                    {{-- Newsletter --}}
                    <div class="mb-4">
                        <label class="terms-check" for="newsletter" style="border-color:transparent;background:transparent;padding:.5rem 0;">
                            <input type="checkbox" id="newsletter" name="newsletter" value="1" checked>
                            <span style="color:var(--text-muted);">
                                <i class="bi bi-envelope me-1 text-accent"></i>
                                Subscribe to our newsletter for exclusive deals and updates.
                            </span>
                        </label>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="button" class="btn-back-step" onclick="goToStep(2)">
                            <i class="bi bi-arrow-left"></i> Back
                        </button>
                        <button type="submit" class="btn-register flex-grow-1" id="submitBtn">
                            <i class="bi bi-person-check"></i>
                            Create My Account
                        </button>
                    </div>

                    <p class="text-center mt-3 mb-0" style="font-size:.78rem;color:var(--text-muted);">
                        <i class="bi bi-shield-lock me-1"></i>
                        Your data is protected with 256-bit SSL encryption
                    </p>
                </div>

            </form>
            {{-- end form --}}

        </div>
        {{-- end auth-right --}}

    </div>
    {{-- end auth-card --}}
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // ── STEP NAVIGATION ────────────────────────────────────────────
    let currentStep = 1;

    function goToStep(step) {
        // Validate step 1 before advancing
        if (step > 1 && currentStep === 1) {
            if (!validateStep1()) return;
        }

        // Hide current, show target
        document.getElementById('step' + currentStep).classList.remove('active');
        document.getElementById('step' + step).classList.add('active');

        // Update progress UI
        updateProgress(step);

        // If going to step 3, populate summary
        if (step === 3) populateSummary();

        currentStep = step;

        // Scroll to top of form
        document.querySelector('.auth-right').scrollTop = 0;
    }

    function updateProgress(step) {
        for (let i = 1; i <= 3; i++) {
            const circle = document.getElementById('circle' + i);
            const label  = document.getElementById('label' + i);

            circle.classList.remove('active', 'done');
            label.classList.remove('active');

            if (i < step) {
                circle.classList.add('done');
                circle.innerHTML = '<i class="bi bi-check2" style="font-size:.75rem;"></i>';
            } else if (i === step) {
                circle.classList.add('active');
                circle.textContent = i;
                label.classList.add('active');
            } else {
                circle.textContent = i;
            }
        }

        // Lines
        for (let i = 1; i <= 2; i++) {
            const line = document.getElementById('line' + i);
            line.classList.toggle('done', i < step);
        }
    }

    // ── STEP 1 VALIDATION ──────────────────────────────────────────
    function validateStep1() {
        let valid = true;

        const name  = document.getElementById('name');
        const email = document.getElementById('email');
        const pwd   = document.getElementById('password');
        const conf  = document.getElementById('password_confirmation');

        // Name
        if (!name.value.trim()) {
            name.classList.add('is-invalid');
            valid = false;
        } else {
            name.classList.remove('is-invalid');
            name.classList.add('is-valid');
        }

        // Email
        const emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRe.test(email.value.trim())) {
            email.classList.add('is-invalid');
            valid = false;
        } else {
            email.classList.remove('is-invalid');
            email.classList.add('is-valid');
        }

        // Password length
        if (pwd.value.length < 8) {
            pwd.classList.add('is-invalid');
            valid = false;
        } else {
            pwd.classList.remove('is-invalid');
            pwd.classList.add('is-valid');
        }

        // Confirm match
        const matchMsg = document.getElementById('matchMsg');
        if (conf.value !== pwd.value || conf.value === '') {
            conf.classList.add('is-invalid');
            matchMsg.style.display = 'flex';
            valid = false;
        } else {
            conf.classList.remove('is-invalid');
            conf.classList.add('is-valid');
            matchMsg.style.display = 'none';
        }

        return valid;
    }

    // ── PASSWORD STRENGTH ──────────────────────────────────────────
    function checkStrength(value) {
        const segments  = ['s1','s2','s3','s4'];
        const label     = document.getElementById('strengthLabel');
        const classes   = ['weak','fair','good','strong'];
        const labels    = ['Too short','Fair — add symbols','Good — almost there!','Strong password ✓'];

        let score = 0;
        if (value.length >= 8)                          score++;
        if (/[A-Z]/.test(value) && /[a-z]/.test(value)) score++;
        if (/[0-9]/.test(value))                         score++;
        if (/[^A-Za-z0-9]/.test(value))                 score++;

        segments.forEach((id, i) => {
            const el = document.getElementById(id);
            el.className = 'strength-segment';
            if (i < score) el.classList.add(classes[score - 1]);
        });

        const colors = ['#ef4444','#f97316','#eab308','#22c55e'];
        label.textContent   = value.length ? labels[score - 1] || labels[0] : '';
        label.style.color   = value.length ? colors[score - 1] || colors[0]  : '';
    }

    // ── PASSWORD MATCH ─────────────────────────────────────────────
    function checkMatch() {
        const pwd  = document.getElementById('password').value;
        const conf = document.getElementById('password_confirmation');
        const msg  = document.getElementById('matchMsg');

        if (conf.value && conf.value !== pwd) {
            conf.classList.add('is-invalid');
            msg.style.display = 'flex';
        } else {
            conf.classList.remove('is-invalid');
            msg.style.display = 'none';
            if (conf.value && conf.value === pwd) conf.classList.add('is-valid');
        }
    }

    // ── TOGGLE PASSWORD VISIBILITY ─────────────────────────────────
    function togglePwd(fieldId, btn) {
        const field = document.getElementById(fieldId);
        const icon  = btn.querySelector('i');

        if (field.type === 'password') {
            field.type      = 'text';
            icon.className  = 'bi bi-eye-slash';
        } else {
            field.type      = 'password';
            icon.className  = 'bi bi-eye';
        }
    }

    // ── POPULATE SUMMARY ───────────────────────────────────────────
    function populateSummary() {
        const name     = document.getElementById('name').value;
        const email    = document.getElementById('email').value;
        const phone    = document.querySelector('[name="phone"]').value;
        const city     = document.querySelector('[name="city"]').value;
        const country  = document.querySelector('[name="country"]').value;

        document.getElementById('summaryName').textContent     = name     || '—';
        document.getElementById('summaryEmail').textContent    = email    || '—';
        document.getElementById('summaryPhone').textContent    = phone    || 'Not provided';

        const location = [city, country].filter(Boolean).join(', ');
        document.getElementById('summaryLocation').textContent = location || 'Not provided';
    }

    // ── SUBMIT BUTTON LOADING STATE ────────────────────────────────
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        const terms = document.getElementById('terms');
        if (!terms.checked) {
            e.preventDefault();
            terms.closest('.terms-check').style.borderColor = '#ef4444';
            terms.closest('.terms-check').style.background  = '#fef2f2';
            return;
        }

        const btn = document.getElementById('submitBtn');
        btn.disabled   = true;
        btn.innerHTML  = '<span class="spinner-border spinner-border-sm me-2"></span>Creating account...';
    });

    // ── AUTO-ADVANCE IF ERRORS ON STEP1 FIELDS ────────────────────
    // (Blade re-renders with errors → stay on step 1 which is default)
    @if($errors->has('name') || $errors->has('email') || $errors->has('password'))
        // Already on step 1 by default
    @endif
</script>

</body>
</html>