<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sign In — LuxeShop</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* ════════════════════════════════════════════════════════
           VARIABLES
        ════════════════════════════════════════════════════════ */
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
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html, body {
            height: 100%;
            font-family: 'DM Sans', sans-serif;
            background: var(--dark);
            overflow-x: hidden;
        }

        h1,h2,h3,h4,h5 { font-family: 'Cormorant Garamond', serif; }

        /* ════════════════════════════════════════════════════════
           PAGE WRAPPER
        ════════════════════════════════════════════════════════ */
        .admin-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            padding: 2rem 1rem;
        }

        /* ── Animated background blobs ── */
        .admin-page::before {
            content: '';
            position: fixed;
            width: 700px; height: 700px;
            background: radial-gradient(circle,
                rgba(201,169,110,.08) 0%, transparent 65%);
            border-radius: 50%;
            top: -200px; right: -200px;
            pointer-events: none;
            animation: blobA 10s ease-in-out infinite;
        }
        .admin-page::after {
            content: '';
            position: fixed;
            width: 500px; height: 500px;
            background: radial-gradient(circle,
                rgba(201,169,110,.06) 0%, transparent 65%);
            border-radius: 50%;
            bottom: -150px; left: -150px;
            pointer-events: none;
            animation: blobB 14s ease-in-out infinite;
        }
        @keyframes blobA {
            0%,100% { transform: translate(0,0) scale(1); }
            50%      { transform: translate(-30px,30px) scale(1.07); }
        }
        @keyframes blobB {
            0%,100% { transform: translate(0,0) scale(1); }
            50%      { transform: translate(20px,-20px) scale(1.05); }
        }

        /* ── Grid pattern ── */
        .grid-bg {
            position: fixed; inset: 0;
            background-image:
                linear-gradient(rgba(201,169,110,.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(201,169,110,.03) 1px, transparent 1px);
            background-size: 52px 52px;
            pointer-events: none;
        }

        /* ── Diagonal accent line ── */
        .diagonal-line {
            position: fixed;
            width: 200%; height: 1px;
            background: linear-gradient(90deg,
                transparent, rgba(201,169,110,.15), transparent);
            top: 38%; left: -50%;
            transform: rotate(-8deg);
            pointer-events: none;
        }

        /* ════════════════════════════════════════════════════════
           CARD
        ════════════════════════════════════════════════════════ */
        .admin-card {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 460px;
            background: rgba(26,26,46,.95);
            border: 1px solid rgba(201,169,110,.15);
            border-radius: 20px;
            padding: 2.75rem 2.5rem;
            box-shadow:
                0 32px 80px rgba(0,0,0,.5),
                0 0 0 1px rgba(201,169,110,.08) inset;
            backdrop-filter: blur(20px);
            animation: slideUp .6s ease both;
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(28px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Gold top stripe */
        .admin-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg,
                var(--gold-dark), var(--gold), var(--gold-light), var(--gold));
            border-radius: 20px 20px 0 0;
        }

        /* ════════════════════════════════════════════════════════
           CARD HEADER
        ════════════════════════════════════════════════════════ */
        /* Brand */
        .admin-brand {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.7rem;
            font-weight: 700;
            color: var(--white);
            text-decoration: none;
            display: block;
            text-align: center;
            margin-bottom: .35rem;
        }
        .admin-brand span { color: var(--gold); }

        /* Shield badge */
        .admin-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .4rem;
            margin: 0 auto .75rem;
            width: fit-content;
            padding: .3rem 1rem;
            background: rgba(201,169,110,.1);
            border: 1px solid rgba(201,169,110,.2);
            border-radius: 50px;
            color: var(--gold);
            font-size: .7rem; font-weight: 700;
            letter-spacing: .14em; text-transform: uppercase;
        }

        /* Heading */
        .card-title {
            font-size: 2rem; font-weight: 700;
            color: var(--white);
            text-align: center;
            line-height: 1.1;
            margin-bottom: .3rem;
        }
        .card-sub {
            text-align: center;
            font-size: .875rem;
            color: rgba(255,255,255,.4);
            margin-bottom: 2rem;
        }

        /* Divider */
        .card-divider {
            height: 1px;
            background: rgba(255,255,255,.07);
            margin-bottom: 1.75rem;
        }

        /* ════════════════════════════════════════════════════════
           ALERT BOXES
        ════════════════════════════════════════════════════════ */
        .auth-alert {
            display: flex; align-items: flex-start; gap: .55rem;
            padding: .8rem 1rem; border-radius: 10px;
            font-size: .825rem; margin-bottom: 1.25rem;
            border-left: 3px solid transparent;
            animation: shake .4s ease;
        }
        @keyframes shake {
            0%,100% { transform: translateX(0); }
            20%,60%  { transform: translateX(-5px); }
            40%,80%  { transform: translateX(5px); }
        }
        .auth-alert i { flex-shrink: 0; margin-top: .1rem; }

        .auth-alert.error {
            background: rgba(239,68,68,.1);
            border: 1px solid rgba(239,68,68,.2);
            border-left-color: #ef4444;
            color: #fca5a5;
        }
        .auth-alert.success {
            background: rgba(34,197,94,.1);
            border: 1px solid rgba(34,197,94,.2);
            border-left-color: #22c55e;
            color: #86efac;
        }
        .auth-alert.info {
            background: rgba(201,169,110,.1);
            border: 1px solid rgba(201,169,110,.2);
            border-left-color: var(--gold);
            color: var(--gold-light);
        }

        /* ════════════════════════════════════════════════════════
           FLOATING LABEL INPUTS
        ════════════════════════════════════════════════════════ */
        .input-float {
            position: relative;
            margin-bottom: 1rem;
        }
        .input-float label {
            position: absolute;
            top: 50%; left: 1.1rem;
            transform: translateY(-50%);
            font-size: .875rem;
            color: rgba(255,255,255,.3);
            pointer-events: none;
            transition: all .2s ease;
            background: transparent;
            padding: 0 .25rem;
            z-index: 2;
        }
        .input-float.has-icon label { left: 3rem; }

        /* Float up */
        .input-float input:focus ~ label,
        .input-float input:not(:placeholder-shown) ~ label {
            top: 0; font-size: .68rem;
            color: var(--gold); font-weight: 700;
            letter-spacing: .07em; text-transform: uppercase;
            background: var(--dark-2);
        }

        /* Field icon */
        .fi {
            position: absolute; left: 1rem; top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,.2); font-size: .95rem;
            z-index: 3; pointer-events: none; transition: color .2s;
        }
        .input-float input:focus ~ .fi { color: var(--gold); }

        /* Input */
        .input-float input {
            width: 100%; height: 52px;
            border: 1.5px solid rgba(255,255,255,.1);
            border-radius: 12px;
            font-size: .9rem; font-family: 'DM Sans', sans-serif;
            color: var(--white);
            background: rgba(255,255,255,.05);
            transition: all .25s ease; outline: none; padding: 0 1.1rem;
        }
        .input-float.has-icon   input { padding-left: 3rem; }
        .input-float.has-toggle input { padding-right: 3.2rem; }
        .input-float input::placeholder { color: transparent; }
        .input-float input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 4px rgba(201,169,110,.12);
            background: rgba(255,255,255,.08);
        }
        .input-float input.is-invalid {
            border-color: #ef4444;
            box-shadow: 0 0 0 4px rgba(239,68,68,.1);
        }
        .invalid-feedback {
            display: block; font-size: .76rem;
            color: #fca5a5; margin-top: .3rem; padding-left: .25rem;
        }

        /* Password toggle */
        .pw-toggle {
            position: absolute; right: 1rem; top: 50%;
            transform: translateY(-50%);
            background: none; border: none;
            color: rgba(255,255,255,.25); font-size: .95rem;
            cursor: pointer; padding: 0; z-index: 4; transition: color .2s;
        }
        .pw-toggle:hover { color: var(--gold); }

        /* ════════════════════════════════════════════════════════
           FORM EXTRAS
        ════════════════════════════════════════════════════════ */
        .form-extras {
            display: flex; align-items: center;
            justify-content: space-between;
            margin: .25rem 0 1.5rem;
        }
        .remember-label {
            display: flex; align-items: center; gap: .5rem;
            font-size: .83rem; color: rgba(255,255,255,.4); cursor: pointer;
        }
        .remember-label input[type="checkbox"] {
            width: 15px; height: 15px;
            accent-color: var(--gold); cursor: pointer;
        }
        .form-check-label { color: rgba(255,255,255,.4); font-size: .83rem; }

        /* ════════════════════════════════════════════════════════
           SUBMIT BUTTON
        ════════════════════════════════════════════════════════ */
        .btn-admin-login {
            width: 100%; height: 52px;
            background: linear-gradient(135deg, var(--gold-dark), var(--gold));
            color: var(--dark);
            border: none; border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: .9rem; font-weight: 700;
            letter-spacing: .06em; text-transform: uppercase;
            cursor: pointer; position: relative; overflow: hidden;
            transition: all .3s ease;
            display: flex; align-items: center; justify-content: center; gap: .5rem;
        }
        .btn-admin-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(201,169,110,.35);
            filter: brightness(1.06);
        }
        .btn-admin-login:active  { transform: translateY(0); }
        .btn-admin-login:disabled { opacity: .65; cursor: not-allowed; transform: none; }

        .btn-admin-login .btn-label,
        .btn-admin-login .btn-spin { position: relative; z-index: 1; }
        .btn-admin-login .btn-spin {
            display: none; align-items: center; gap: .5rem;
        }
        .btn-admin-login.loading .btn-label { display: none; }
        .btn-admin-login.loading .btn-spin  { display: flex; }

        /* Spinner */
        .spin-ring {
            width: 18px; height: 18px;
            border-radius: 50%;
            border: 2px solid rgba(13,13,26,.2);
            border-top-color: var(--dark);
            animation: spin .7s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* ════════════════════════════════════════════════════════
           BACK LINK
        ════════════════════════════════════════════════════════ */
        .back-link {
            display: inline-flex; align-items: center; gap: .4rem;
            font-size: .8rem; color: rgba(255,255,255,.3);
            text-decoration: none; margin-bottom: 2rem;
            transition: color .2s;
        }
        .back-link:hover { color: var(--gold); }

        /* ════════════════════════════════════════════════════════
           FOOTER NOTE
        ════════════════════════════════════════════════════════ */
        .footer-note {
            text-align: center; margin-top: 1.75rem;
            font-size: .76rem; color: rgba(255,255,255,.2);
            line-height: 1.6;
        }
        .footer-note a { color: rgba(201,169,110,.45); text-decoration: none; transition: color .2s; }
        .footer-note a:hover { color: var(--gold); }

        /* ════════════════════════════════════════════════════════
           CUSTOMER LINK
        ════════════════════════════════════════════════════════ */
        .customer-link {
            display: flex; align-items: center; gap: .65rem;
            padding: .85rem 1rem; margin-top: 1.25rem;
            border: 1px solid rgba(255,255,255,.07);
            border-radius: 12px;
            background: rgba(255,255,255,.03);
            text-decoration: none;
            color: rgba(255,255,255,.55);
            font-size: .825rem;
            transition: all .2s;
        }
        .customer-link:hover {
            border-color: rgba(201,169,110,.25);
            background: rgba(201,169,110,.05);
            color: rgba(255,255,255,.75);
            transform: translateY(-1px);
        }
        .customer-link-icon {
            width: 36px; height: 36px;
            border-radius: 9px;
            background: rgba(255,255,255,.06);
            display: flex; align-items: center; justify-content: center;
            color: rgba(255,255,255,.4); font-size: .9rem; flex-shrink: 0;
        }
        .customer-link:hover .customer-link-icon { color: var(--gold); }
        .cl-title { font-weight: 600; color: rgba(255,255,255,.7); font-size: .85rem; }
        .cl-sub   { font-size: .75rem; color: rgba(255,255,255,.3); }
        .cl-arrow { margin-left: auto; color: rgba(255,255,255,.2); transition: transform .2s, color .2s; }
        .customer-link:hover .cl-arrow { transform: translateX(3px); color: var(--gold); }

        /* ════════════════════════════════════════════════════════
           RESPONSIVE
        ════════════════════════════════════════════════════════ */
        @media (max-width: 576px) {
            .admin-card { padding: 2rem 1.5rem; }
            .card-title { font-size: 1.75rem; }
        }
    </style>
</head>
<body>

{{-- Background effects --}}
<div class="grid-bg"></div>
<div class="diagonal-line"></div>

<div class="admin-page">
    <div class="admin-card">

        {{-- Back link --}}
        <a href="{{ route('home') }}" class="back-link">
            <i class="bi bi-arrow-left"></i> Back to Store
        </a>

        {{-- Brand --}}
        <a href="{{ route('home') }}" class="admin-brand">
            Luxe<span>Shop</span>
        </a>

        {{-- Shield badge --}}
        <div class="admin-badge">
            <i class="bi bi-shield-lock-fill"></i>
            Admin Portal
        </div>

        {{-- Title --}}
        <h2 class="card-title">Sign In</h2>
        <p class="card-sub">Restricted to authorized administrators</p>

        <div class="card-divider"></div>

        {{-- ── Alerts ─────────────────────────────────────────── --}}
        @if(session('success'))
        <div class="auth-alert success">
            <i class="bi bi-check-circle-fill"></i>
            <div>{{ session('success') }}</div>
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

        @if($errors->any())
        <div class="auth-alert error">
            <i class="bi bi-exclamation-circle-fill"></i>
            <div>{{ $errors->first() }}</div>
        </div>
        @endif

        {{-- ── ADMIN LOGIN FORM ─────────────────────────────────
             Action   : POST /admin/login
             Redirects: /admin (Dashboard)
        ─────────────────────────────────────────────────────── --}}
        <form method="POST"
              action="{{ route('admin.login.post') }}"
              id="adminForm"
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
                <label for="email">Admin Email</label>
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
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
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Remember + extras --}}
            <div class="form-extras">
                <label class="remember-label">
                    <input type="checkbox"
                           name="remember"
                           {{ old('remember') ? 'checked' : '' }}>
                    Keep me signed in
                </label>
            </div>

            {{-- Submit --}}
            <button type="submit"
                    class="btn-admin-login"
                    id="loginBtn">
                <span class="btn-label">
                    <i class="bi bi-shield-check me-1"></i>
                    Sign In to Dashboard
                </span>
                <span class="btn-spin">
                    <span class="spin-ring"></span>
                    Authenticating…
                </span>
            </button>

        </form>

        {{-- Customer portal link --}}
        {{-- <a href="{{ route('login') }}" class="customer-link">
            <div class="customer-link-icon">
                <i class="bi bi-person-fill"></i>
            </div>
            <div>
                <div class="cl-title">Customer Login</div>
                <div class="cl-sub">Sign in to your shopping account</div>
            </div>
            <i class="bi bi-arrow-right cl-arrow"></i>
        </a> --}}

        {{-- Footer --}}
        <div class="footer-note">
            Protected area &bull; Unauthorized access is prohibited<br>
            <a href="{{ route('home') }}">Return to LuxeShop Store</a>
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
    document.getElementById('adminForm').addEventListener('submit', function () {
        const btn = document.getElementById('loginBtn');
        btn.classList.add('loading');
        btn.disabled = true;
    });

    // ── Email validation ────────────────────────────────────────
    const emailEl = document.getElementById('email');
    emailEl.addEventListener('blur', function () {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        this.classList.toggle('is-invalid', this.value && !re.test(this.value));
    });
    emailEl.addEventListener('input', function () {
        this.classList.remove('is-invalid');
    });
</script>
</body>
</html>