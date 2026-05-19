<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In — LuxeShop</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --gold:       #c9a96e;
            --gold-light: #e8d5b0;
            --gold-dark:  #a07840;
            --dark:       #0d0d1a;
            --dark-2:     #1a1a2e;
            --dark-3:     #252545;
            --white:      #ffffff;
            --off-white:  #f8f6f1;
            --text-muted: #8a8a9a;
            --border:     #e2ddd6;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html, body {
            height: 100%;
            font-family: 'DM Sans', sans-serif;
            background: var(--off-white);
            overflow-x: hidden;
        }
        h1,h2,h3,h4,h5 { font-family: 'Cormorant Garamond', serif; }

        /* ══════════════════════════════════════════════════════
           LAYOUT
        ══════════════════════════════════════════════════════ */
        .auth-wrapper {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        /* ══════════════════════════════════════════════════════
           LEFT PANEL
        ══════════════════════════════════════════════════════ */
        .auth-left {
            background: var(--dark);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 3rem;
        }
        .auth-left::before {
            content: '';
            position: absolute;
            width: 600px; height: 600px;
            background: radial-gradient(circle,
                rgba(201,169,110,.18) 0%, transparent 70%);
            border-radius: 50%;
            top: -150px; left: -150px;
            animation: float1 8s ease-in-out infinite;
        }
        .auth-left::after {
            content: '';
            position: absolute;
            width: 400px; height: 400px;
            background: radial-gradient(circle,
                rgba(201,169,110,.12) 0%, transparent 70%);
            border-radius: 50%;
            bottom: -100px; right: -100px;
            animation: float2 10s ease-in-out infinite;
        }
        @keyframes float1 {
            0%,100% { transform: translate(0,0) scale(1); }
            50%      { transform: translate(30px,30px) scale(1.05); }
        }
        @keyframes float2 {
            0%,100% { transform: translate(0,0) scale(1); }
            50%      { transform: translate(-20px,-20px) scale(1.08); }
        }
        .grid-lines {
            position: absolute; inset: 0;
            background-image:
                linear-gradient(rgba(201,169,110,.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(201,169,110,.04) 1px, transparent 1px);
            background-size: 60px 60px;
        }
        .diagonal-bar {
            position: absolute;
            width: 200%; height: 2px;
            background: linear-gradient(90deg,
                transparent, rgba(201,169,110,.4), transparent);
            top: 35%; left: -50%;
            transform: rotate(-12deg);
        }
        .auth-left-content { position: relative; z-index: 2; }

        .auth-brand {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2rem; font-weight: 700;
            color: var(--white); text-decoration: none;
            display: inline-block;
        }
        .auth-brand span { color: var(--gold); }

        .auth-headline { margin-top: 4rem; }
        .auth-headline .eyebrow {
            font-size: .72rem; font-weight: 600;
            text-transform: uppercase; letter-spacing: .2em;
            color: var(--gold); display: block; margin-bottom: .75rem;
        }
        .auth-headline h1 {
            font-size: clamp(2.2rem, 3.5vw, 3rem);
            font-weight: 700; color: var(--white);
            line-height: 1.12; margin-bottom: 1.25rem;
        }
        .auth-headline p {
            color: rgba(255,255,255,.55);
            font-size: .95rem; line-height: 1.75; max-width: 360px;
        }

        .auth-features { margin-top: 3rem; list-style: none; }
        .auth-features li {
            display: flex; align-items: center; gap: .85rem;
            color: rgba(255,255,255,.65);
            font-size: .875rem; margin-bottom: 1rem;
        }
        .feat-icon {
            width: 34px; height: 34px; border-radius: 10px;
            background: rgba(201,169,110,.15);
            border: 1px solid rgba(201,169,110,.25);
            display: flex; align-items: center; justify-content: center;
            color: var(--gold); font-size: .9rem; flex-shrink: 0;
        }

        .auth-testimonial {
            position: relative; z-index: 2;
            background: rgba(255,255,255,.04);
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 16px; padding: 1.5rem;
            backdrop-filter: blur(10px);
        }
        .auth-testimonial p {
            color: rgba(255,255,255,.75);
            font-size: .875rem; line-height: 1.6;
            font-style: italic; margin-bottom: .75rem;
        }
        .reviewer { display: flex; align-items: center; gap: .75rem; }
        .reviewer-avatar {
            width: 36px; height: 36px; border-radius: 50%;
            background: var(--gold);
            display: flex; align-items: center; justify-content: center;
            color: var(--dark); font-size: .8rem; font-weight: 700;
            flex-shrink: 0;
        }
        .r-name  { color: var(--white); font-size: .85rem; font-weight: 600; }
        .r-title { color: rgba(255,255,255,.45); font-size: .75rem; }
        .star-row { color: var(--gold); font-size: .8rem; margin-bottom: .25rem; }

        /* ══════════════════════════════════════════════════════
           RIGHT PANEL
        ══════════════════════════════════════════════════════ */
        .auth-right {
            background: var(--white);
            display: flex; align-items: center;
            justify-content: center;
            padding: 3rem 2rem; position: relative;
            overflow-y: auto;
        }
        .auth-right::before {
            content: ''; position: absolute;
            top: 0; left: 0; right: 0; height: 4px;
            background: linear-gradient(90deg,
                var(--gold-dark), var(--gold),
                var(--gold-light), var(--gold));
        }
        .auth-form-wrap {
            width: 100%; max-width: 420px;
            animation: slideUp .6s ease both;
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Back link */
        .back-link {
            display: inline-flex; align-items: center; gap: .4rem;
            font-size: .8rem; color: var(--text-muted);
            text-decoration: none; margin-bottom: 2rem; transition: color .2s;
        }
        .back-link:hover { color: var(--gold); }

        /* Customer badge */
        .customer-badge {
            display: inline-flex; align-items: center; gap: .4rem;
            padding: .28rem .9rem;
            background: rgba(201,169,110,.1);
            border: 1px solid rgba(201,169,110,.2);
            border-radius: 50px;
            color: var(--gold-dark);
            font-size: .7rem; font-weight: 700;
            letter-spacing: .12em; text-transform: uppercase;
            margin-bottom: 1.25rem;
        }

        /* Form heading */
        .form-heading h2 {
            font-size: 2.2rem; font-weight: 700;
            color: var(--dark-2); line-height: 1.1; margin-bottom: .4rem;
        }
        .form-heading p { color: var(--text-muted); font-size: .9rem; margin-bottom: 1.75rem; }
        .form-heading p a {
            color: var(--gold-dark); font-weight: 600; text-decoration: none;
        }
        .form-heading p a:hover { color: var(--gold); }

        /* ══════════════════════════════════════════════════════
           ALERT BOXES
        ══════════════════════════════════════════════════════ */
        .auth-alert {
            display: flex; align-items: flex-start; gap: .6rem;
            padding: .85rem 1rem; border-radius: 10px;
            font-size: .84rem; margin-bottom: 1.25rem;
            border-left: 4px solid transparent;
            animation: shakeX .4s ease;
        }
        @keyframes shakeX {
            0%,100% { transform: translateX(0); }
            20%,60%  { transform: translateX(-5px); }
            40%,80%  { transform: translateX(5px); }
        }
        .auth-alert i { flex-shrink: 0; margin-top: .1rem; }
        .auth-alert.error {
            background: #fff5f5;
            border: 1px solid #fecaca; border-left-color: #ef4444; color: #c53030;
        }
        .auth-alert.success {
            background: #f0fff4;
            border: 1px solid #9ae6b4; border-left-color: #22c55e; color: #166534;
        }
        .auth-alert.info {
            background: #fffbeb;
            border: 1px solid #fde68a; border-left-color: #f59e0b; color: #92400e;
        }

        /* ══════════════════════════════════════════════════════
           FLOATING LABEL INPUTS
        ══════════════════════════════════════════════════════ */
        .input-float { position: relative; margin-bottom: 1rem; }
        .input-float label {
            position: absolute; top: 50%; left: 1.1rem;
            transform: translateY(-50%);
            font-size: .875rem; color: var(--text-muted);
            pointer-events: none; transition: all .2s ease;
            background: var(--white); padding: 0 .3rem; z-index: 1;
        }
        .input-float.has-icon label { left: 3rem; }
        .input-float input:focus ~ label,
        .input-float input:not(:placeholder-shown) ~ label {
            top: 0; font-size: .68rem;
            color: var(--gold-dark); font-weight: 700;
            letter-spacing: .06em; text-transform: uppercase;
        }
        /* Icon */
        .fi {
            position: absolute; left: 1rem; top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted); font-size: .95rem;
            z-index: 2; pointer-events: none; transition: color .2s;
        }
        .input-float input:focus ~ .fi { color: var(--gold-dark); }
        /* Input */
        .input-float input {
            width: 100%; height: 52px;
            border: 1.5px solid var(--border); border-radius: 12px;
            font-size: .9rem; font-family: 'DM Sans', sans-serif;
            color: var(--dark-2); background: var(--white);
            transition: all .25s ease; outline: none; padding: 0 1.1rem;
        }
        .input-float.has-icon   input { padding-left: 3rem; }
        .input-float.has-toggle input { padding-right: 3.2rem; }
        .input-float input::placeholder { color: transparent; }
        .input-float input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 4px rgba(201,169,110,.12);
        }
        .input-float input.is-invalid {
            border-color: #ef4444;
            box-shadow: 0 0 0 4px rgba(239,68,68,.08);
        }
        /* Field error */
        .field-error {
            font-size: .76rem; color: #ef4444;
            margin-top: .3rem; padding-left: .25rem;
            display: flex; align-items: center; gap: .25rem;
        }
        /* Password toggle */
        .pw-toggle {
            position: absolute; right: 1rem; top: 50%;
            transform: translateY(-50%);
            background: none; border: none;
            color: var(--text-muted); font-size: .95rem;
            cursor: pointer; padding: 0; z-index: 3; transition: color .2s;
        }
        .pw-toggle:hover { color: var(--gold-dark); }

        /* ══════════════════════════════════════════════════════
           FORM EXTRAS
        ══════════════════════════════════════════════════════ */
        .form-extras {
            display: flex; align-items: center;
            justify-content: space-between;
            margin: .25rem 0 1.5rem;
        }
        .remember-label {
            display: flex; align-items: center; gap: .5rem;
            font-size: .84rem; color: var(--text-muted); cursor: pointer;
        }
        .remember-label input[type="checkbox"] {
            width: 15px; height: 15px;
            accent-color: var(--gold-dark); cursor: pointer;
        }
        .forgot-link {
            font-size: .82rem; font-weight: 500;
            color: var(--gold-dark); text-decoration: none; transition: color .2s;
        }
        .forgot-link:hover { color: var(--gold); }

        /* ══════════════════════════════════════════════════════
           SUBMIT BUTTON
        ══════════════════════════════════════════════════════ */
        .btn-signin {
            width: 100%; height: 52px;
            background: var(--dark-2);
            color: var(--white); border: none; border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: .9rem; font-weight: 600;
            letter-spacing: .06em; text-transform: uppercase;
            cursor: pointer; position: relative; overflow: hidden;
            transition: all .3s ease;
            display: flex; align-items: center;
            justify-content: center; gap: .5rem;
        }
        .btn-signin::before {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(135deg, var(--gold-dark), var(--gold));
            opacity: 0; transition: opacity .3s ease;
        }
        .btn-signin:hover::before { opacity: 1; }
        .btn-signin:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(26,26,46,.22);
        }
        .btn-signin:active  { transform: translateY(0); }
        .btn-signin:disabled {
            opacity: .65; cursor: not-allowed; transform: none;
        }
        .btn-signin .btn-label,
        .btn-signin .btn-spin { position: relative; z-index: 1; }
        .btn-signin .btn-spin {
            display: none; align-items: center; gap: .5rem;
        }
        .btn-signin.loading .btn-label { display: none; }
        .btn-signin.loading .btn-spin  { display: flex; }
        /* Spinner */
        .spin-ring {
            width: 18px; height: 18px;
            border: 2px solid rgba(255,255,255,.3);
            border-top-color: #fff; border-radius: 50%;
            animation: spin .7s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* ══════════════════════════════════════════════════════
           FOOTER
        ══════════════════════════════════════════════════════ */
        .auth-footer-note {
            text-align: center; margin-top: 1.5rem;
            font-size: .77rem; color: var(--text-muted);
            line-height: 1.6;
        }
        .auth-footer-note a {
            color: var(--gold-dark); text-decoration: none;
        }
        .auth-footer-note a:hover { text-decoration: underline; }

        /* ══════════════════════════════════════════════════════
           RESPONSIVE
        ══════════════════════════════════════════════════════ */
        @media (max-width: 991px) {
            .auth-wrapper   { grid-template-columns: 1fr; }
            .auth-left      { display: none; }
            .auth-right     { padding: 2.5rem 1.5rem; min-height: 100vh; }
            .auth-form-wrap { max-width: 480px; margin: 0 auto; }
        }
        @media (max-width: 480px) {
            .auth-right { padding: 2rem 1.25rem; }
            .form-heading h2 { font-size: 1.9rem; }
        }
    </style>
</head>
<body>

<div class="auth-wrapper">

    {{-- ══ LEFT PANEL ══════════════════════════════════════════ --}}
    <div class="auth-left">
        <div class="grid-lines"></div>
        <div class="diagonal-bar"></div>

        <div class="auth-left-content">
            <a href="{{ route('home') }}" class="auth-brand">
                Luxe<span>Shop</span>
            </a>

            <div class="auth-headline">
                <span class="eyebrow">Welcome back</span>
                <h1>Your premium<br>
                    <em style="color:var(--gold);font-style:italic;">shopping</em><br>
                    awaits.
                </h1>
                <p>Sign in to explore exclusive collections, track your
                   orders, and enjoy member-only benefits.</p>
            </div>

            <ul class="auth-features">
                <li>
                    <div class="feat-icon"><i class="bi bi-truck"></i></div>
                    <span>Free shipping on orders over
                        <strong style="color:rgba(255,255,255,.85);">$100</strong>
                    </span>
                </li>
                <li>
                    <div class="feat-icon">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </div>
                    <span>Hassle-free
                        <strong style="color:rgba(255,255,255,.85);">30-day</strong>
                        returns
                    </span>
                </li>
                <li>
                    <div class="feat-icon"><i class="bi bi-shield-check"></i></div>
                    <span>Secure
                        <strong style="color:rgba(255,255,255,.85);">256-bit SSL</strong>
                        checkout
                    </span>
                </li>
                <li>
                    <div class="feat-icon"><i class="bi bi-headset"></i></div>
                    <span>Dedicated support
                        <strong style="color:rgba(255,255,255,.85);">24/7</strong>
                    </span>
                </li>
            </ul>
        </div>

        <div class="auth-testimonial">
            <div class="star-row">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
            </div>
            <p>"LuxeShop has completely transformed how I shop online.
               The quality is unmatched and the experience is flawless."</p>
            <div class="reviewer">
                <div class="reviewer-avatar">S</div>
                <div class="reviewer-info">
                    <div class="r-name">Sarah Mitchell</div>
                    <div class="r-title">Verified Customer · New York</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ══ RIGHT PANEL — CUSTOMER LOGIN ONLY ══════════════════ --}}
    <div class="auth-right">
        <div class="auth-form-wrap">

            {{-- Back link --}}
            <a href="{{ route('home') }}" class="back-link">
                <i class="bi bi-arrow-left"></i> Back to Store
            </a>

            {{-- Customer badge --}}
            <div class="customer-badge">
                <i class="bi bi-person-fill"></i>
                Customer Sign In
            </div>

            {{-- Heading --}}
            <div class="form-heading">
                <h2>Welcome back</h2>
                <p>New to LuxeShop?
                    <a href="{{ route('register') }}">Create a free account</a>
                </p>
            </div>

            {{-- ── Alerts ──────────────────────────────────── --}}
            @if($errors->any())
            <div class="auth-alert error">
                <i class="bi bi-exclamation-circle-fill"></i>
                <div>{{ $errors->first() }}</div>
            </div>
            @endif

            @if(session('status'))
            <div class="auth-alert success">
                <i class="bi bi-check-circle-fill"></i>
                <div>{{ session('status') }}</div>
            </div>
            @endif

            @if(session('info'))
            <div class="auth-alert info">
                <i class="bi bi-info-circle-fill"></i>
                <div>{{ session('info') }}</div>
            </div>
            @endif

            @if(session('success'))
            <div class="auth-alert success">
                <i class="bi bi-check-circle-fill"></i>
                <div>{{ session('success') }}</div>
            </div>
            @endif

            {{-- ════════════════════════════════════════════════
                 CUSTOMER FORM ONLY
                 Route   : POST /login
                 Redirect: / (Home) — customers only
                 Admins  : Blocked in controller → /admin/login
            ════════════════════════════════════════════════ --}}
            <form method="POST"
                  action="{{ route('login') }}"
                  id="loginForm"
                  novalidate>
                @csrf

                {{-- Email --}}
                <div class="input-float has-icon">
                    <i class="bi bi-envelope fi"></i>
                    <input type="email"
                           name="email"
                           id="email"
                           placeholder="Email"
                           value="{{ old('email') }}"
                           class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                           autocomplete="email"
                           autofocus
                           required>
                    <label for="email">Email Address</label>
                    @error('email')
                    <div class="field-error">
                        <i class="bi bi-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="input-float has-icon has-toggle">
                    <i class="bi bi-lock fi"></i>
                    <input type="password"
                           name="password"
                           id="password"
                           placeholder="Password"
                           class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                           autocomplete="current-password"
                           required>
                    <label for="password">Password</label>
                    <button type="button"
                            class="pw-toggle"
                            onclick="togglePwd()"
                            aria-label="Toggle password">
                        <i class="bi bi-eye" id="pwIcon"></i>
                    </button>
                    @error('password')
                    <div class="field-error">
                        <i class="bi bi-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- Remember + Forgot --}}
                <div class="form-extras">
                    <label class="remember-label">
                        <input type="checkbox"
                               name="remember"
                               {{ old('remember') ? 'checked' : '' }}>
                        Remember me
                    </label>
                    @if(Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="forgot-link">
                        Forgot password?
                    </a>
                    @endif
                </div>

                {{-- Submit --}}
                <button type="submit"
                        class="btn-signin"
                        id="loginBtn">
                    <span class="btn-label">
                        Sign In &nbsp;<i class="bi bi-arrow-right"></i>
                    </span>
                    <span class="btn-spin">
                        <span class="spin-ring"></span>
                        Signing in…
                    </span>
                </button>

            </form>

            {{-- Footer --}}
            {{-- <div class="auth-footer-note">
                By signing in you agree to our
                <a href="#">Terms of Service</a> &amp;
                <a href="#">Privacy Policy</a>
                <br>
                <span style="margin-top:.5rem;display:inline-block;">
                    Admin?
                    <a href="{{ route('admin.login') }}">
                        Use the Admin Portal →
                    </a>
                </span>
            </div> --}}

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // ── Toggle password ─────────────────────────────────────────
    function togglePwd() {
        const input = document.getElementById('password');
        const icon  = document.getElementById('pwIcon');
        if (input.type === 'password') {
            input.type     = 'text';
            icon.className = 'bi bi-eye-slash';
        } else {
            input.type     = 'password';
            icon.className = 'bi bi-eye';
        }
    }

    // ── Loading state ───────────────────────────────────────────
    document.getElementById('loginForm')
        .addEventListener('submit', function () {
            const btn = document.getElementById('loginBtn');
            btn.classList.add('loading');
            btn.disabled = true;
        });

    // ── Real-time email validation ──────────────────────────────
    const emailEl = document.getElementById('email');
    emailEl.addEventListener('blur', function () {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        this.classList.toggle('is-invalid',
            this.value && !re.test(this.value));
    });
    emailEl.addEventListener('input', function () {
        this.classList.remove('is-invalid');
    });
</script>
</body>
</html>