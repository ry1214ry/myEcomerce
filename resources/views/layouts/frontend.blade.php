<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'LuxeShop') — Premium Online Store</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Animate.css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        :root {
            --primary:       #1a1a2e;
            --primary-light: #16213e;
            --accent:        #c9a96e;
            --accent-light:  #e8d5b0;
            --accent-hover:  #b8934a;
            --text-dark:     #1a1a2e;
            --text-muted:    #6c757d;
            --bg-light:      #f8f6f1;
            --bg-white:      #ffffff;
            --border:        #e9e3d8;
            --shadow-sm:     0 2px 12px rgba(26,26,46,.06);
            --shadow-md:     0 8px 32px rgba(26,26,46,.10);
            --shadow-lg:     0 16px 48px rgba(26,26,46,.14);
            --radius:        16px;
            --radius-sm:     10px;
            --transition:    all 0.3s cubic-bezier(.25,.8,.25,1);
        }
        * { box-sizing: border-box; }
        body {
            font-family: 'DM Sans', sans-serif;
            color: var(--text-dark);
            background: var(--bg-white);
            overflow-x: hidden;
        }
        h1,h2,h3,h4,h5 { font-family: 'Cormorant Garamond', serif; font-weight: 600; }
        a { text-decoration: none; color: inherit; transition: var(--transition); }

        /* ─── NAVBAR ─── */
        .navbar-main {
            background: rgba(255,255,255,.96);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            padding: 0;
            position: sticky;
            top: 0;
            z-index: 1040;
            box-shadow: var(--shadow-sm);
        }
        .navbar-brand-text {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary);
            letter-spacing: -0.02em;
        }
        .navbar-brand-text span { color: var(--accent); }
        .navbar-main .nav-link {
            font-size: .875rem;
            font-weight: 500;
            color: var(--text-dark) !important;
            padding: 1.5rem 1rem !important;
            letter-spacing: .03em;
            text-transform: uppercase;
            position: relative;
        }
        .navbar-main .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: var(--accent);
            transition: width .3s ease;
        }
        .navbar-main .nav-link:hover::after,
        .navbar-main .nav-link.active::after { width: 60%; }
        .navbar-main .nav-link:hover { color: var(--accent) !important; }
        .nav-icon-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--bg-light);
            color: var(--text-dark);
            font-size: 1.1rem;
            transition: var(--transition);
            position: relative;
        }
        .nav-icon-btn:hover { background: var(--accent); color: #fff; }
        .cart-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: var(--accent);
            color: #fff;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: .65rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        /* ─── TOP BAR ─── */
        .top-bar {
            background: var(--primary);
            color: rgba(255,255,255,.8);
            font-size: .8rem;
            padding: .4rem 0;
        }
        .top-bar a { color: var(--accent-light); }

        /* ─── BUTTONS ─── */
        .btn-accent {
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: .65rem 1.8rem;
            font-weight: 500;
            font-size: .875rem;
            letter-spacing: .04em;
            text-transform: uppercase;
            transition: var(--transition);
        }
        .btn-accent:hover {
            background: var(--accent-hover);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(201,169,110,.35);
        }
        .btn-outline-accent {
            background: transparent;
            color: var(--accent);
            border: 2px solid var(--accent);
            border-radius: 50px;
            padding: .6rem 1.8rem;
            font-weight: 500;
            font-size: .875rem;
            letter-spacing: .04em;
            text-transform: uppercase;
            transition: var(--transition);
        }
        .btn-outline-accent:hover {
            background: var(--accent);
            color: #fff;
            transform: translateY(-2px);
        }
        .btn-dark-main {
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: .65rem 1.8rem;
            font-weight: 500;
            font-size: .875rem;
            letter-spacing: .04em;
            transition: var(--transition);
        }
        .btn-dark-main:hover { background: var(--primary-light); color: #fff; transform: translateY(-2px); }

        /* ─── PRODUCT CARD ─── */
        .product-card {
            background: var(--bg-white);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            transition: var(--transition);
            position: relative;
        }
        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-lg);
            border-color: transparent;
        }
        .product-card-img-wrap {
            position: relative;
            overflow: hidden;
            aspect-ratio: 1;
            background: var(--bg-light);
        }
        .product-card-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s ease;
        }
        .product-card:hover .product-card-img-wrap img { transform: scale(1.08); }
        .product-card-actions {
            position: absolute;
            top: 12px;
            right: 12px;
            display: flex;
            flex-direction: column;
            gap: 6px;
            opacity: 0;
            transform: translateX(12px);
            transition: var(--transition);
        }
        .product-card:hover .product-card-actions { opacity: 1; transform: translateX(0); }
        .product-action-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #fff;
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .9rem;
            color: var(--text-dark);
            transition: var(--transition);
            cursor: pointer;
        }
        .product-action-btn:hover { background: var(--accent); color: #fff; border-color: var(--accent); }
        .product-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            padding: .25rem .65rem;
            border-radius: 50px;
            font-size: .72rem;
            font-weight: 600;
            letter-spacing: .05em;
            text-transform: uppercase;
        }
        .badge-new     { background: var(--primary); color: #fff; }
        .badge-sale    { background: #e74c3c; color: #fff; }
        .badge-hot     { background: var(--accent); color: #fff; }
        .product-body  { padding: 1.2rem; }
        .product-category { font-size: .75rem; color: var(--accent); font-weight: 600; text-transform: uppercase; letter-spacing: .08em; }
        .product-name { font-size: 1rem; font-weight: 600; margin: .3rem 0 .5rem; line-height: 1.3; }
        .product-price { font-size: 1.1rem; font-weight: 700; color: var(--primary); }
        .product-price .original { text-decoration: line-through; color: var(--text-muted); font-size: .875rem; font-weight: 400; margin-left: .4rem; }
        .star-rating { color: #f4c430; font-size: .85rem; }

        /* ─── SECTION STYLES ─── */
        .section-header { margin-bottom: 3rem; }
        .section-label { font-size: .8rem; font-weight: 600; color: var(--accent); text-transform: uppercase; letter-spacing: .15em; display: block; margin-bottom: .5rem; }
        .section-title { font-size: 2.5rem; font-weight: 700; color: var(--primary); margin: 0; line-height: 1.1; }
        .section-subtitle { color: var(--text-muted); font-size: 1rem; margin-top: .5rem; }
        .section-divider { width: 60px; height: 3px; background: linear-gradient(90deg, var(--accent), var(--accent-light)); border-radius: 3px; margin: 1rem 0; }

        /* ─── CATEGORIES GRID ─── */
        .category-card {
            position: relative;
            border-radius: var(--radius);
            overflow: hidden;
            aspect-ratio: 4/3;
            cursor: pointer;
        }
        .category-card img { width: 100%; height: 100%; object-fit: cover; transition: transform .5s ease; }
        .category-card:hover img { transform: scale(1.1); }
        .category-card-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(26,26,46,.75) 0%, transparent 60%);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 1.5rem;
            transition: var(--transition);
        }
        .category-card:hover .category-card-overlay { background: linear-gradient(to top, rgba(26,26,46,.85) 0%, rgba(26,26,46,.2) 100%); }
        .category-card-title { color: #fff; font-size: 1.25rem; font-weight: 600; margin: 0; }
        .category-card-count { color: rgba(255,255,255,.7); font-size: .8rem; }

        /* ─── HERO SLIDER ─── */
        .hero-slider .carousel-item { height: 75vh; min-height: 560px; }
        .hero-slider .carousel-item img { width: 100%; height: 100%; object-fit: cover; }
        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, rgba(26,26,46,.8) 0%, rgba(26,26,46,.3) 60%, transparent 100%);
            display: flex;
            align-items: center;
        }
        .hero-content { color: #fff; max-width: 560px; }
        .hero-label { font-size: .8rem; font-weight: 600; text-transform: uppercase; letter-spacing: .2em; color: var(--accent-light); display: block; margin-bottom: 1rem; }
        .hero-title { font-size: clamp(2.5rem, 5vw, 4rem); font-weight: 700; line-height: 1.1; margin-bottom: 1rem; }
        .hero-desc { font-size: 1.1rem; color: rgba(255,255,255,.8); margin-bottom: 2rem; }
        .carousel-indicators [data-bs-target] { width: 8px; height: 8px; border-radius: 50%; border: none; background: rgba(255,255,255,.5); }
        .carousel-indicators [data-bs-target].active { background: var(--accent); width: 24px; border-radius: 4px; }

        /* ─── FOOTER ─── */
        footer {
            background: var(--primary);
            color: rgba(255,255,255,.75);
        }
        footer h5 { color: #fff; font-family: 'Cormorant Garamond', serif; font-size: 1.25rem; margin-bottom: 1.25rem; }
        footer a { color: rgba(255,255,255,.65); font-size: .9rem; display: block; margin-bottom: .5rem; }
        footer a:hover { color: var(--accent); padding-left: 4px; }
        .footer-brand { font-family: 'Cormorant Garamond', serif; font-size: 2rem; color: #fff; font-weight: 700; }
        .footer-brand span { color: var(--accent); }
        .footer-divider { border-color: rgba(255,255,255,.1); }
        .social-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: rgba(255,255,255,.1);
            color: #fff;
            margin-right: .5rem;
            transition: var(--transition);
        }
        .social-link:hover { background: var(--accent); color: #fff; transform: translateY(-3px); }
        .footer-bottom { background: rgba(0,0,0,.25); padding: 1rem 0; font-size: .85rem; }

        /* ─── BREADCRUMB ─── */
        .breadcrumb-section {
            background: var(--bg-light);
            padding: 1.2rem 0;
            border-bottom: 1px solid var(--border);
        }
        .breadcrumb-item a { color: var(--accent); }
        .breadcrumb-item.active { color: var(--text-muted); }

        /* ─── ALERTS ─── */
        .alert-luxury {
            border: none;
            border-radius: var(--radius-sm);
            border-left: 4px solid var(--accent);
            background: #fdf9f0;
            color: var(--text-dark);
        }

        /* ─── SCROLL REVEAL ─── */
        .reveal { opacity: 0; transform: translateY(30px); transition: opacity .6s ease, transform .6s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }

        /* ─── MISC ─── */
        .bg-light-main { background: var(--bg-light) !important; }
        .text-accent { color: var(--accent) !important; }
        .border-accent { border-color: var(--accent) !important; }
        .rounded-xl { border-radius: var(--radius) !important; }
        .shadow-luxury { box-shadow: var(--shadow-md) !important; }

        @media (max-width: 768px) {
            .hero-slider .carousel-item { height: 55vh; min-height: 380px; }
            .section-title { font-size: 2rem; }
        }
    </style>

    @stack('styles')
</head>
<body>

{{-- Top Bar --}}
<div class="top-bar">
    <div class="container d-flex justify-content-between align-items-center">
        <span><i class="bi bi-truck me-1"></i> Free shipping on orders over $100</span>
        <span>
            @guest
                <a href="{{ route('login') }}" class="me-3"><i class="bi bi-person me-1"></i>Sign In</a>
                <a href="{{ route('register') }}"><i class="bi bi-person-plus me-1"></i>Register</a>
            @else
                <span>Welcome, {{ auth()->user()->name }}</span>
            @endguest
        </span>
    </div>
</div>

{{-- Navbar --}}
<nav class="navbar navbar-main navbar-expand-lg">
    <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand navbar-brand-text me-4">
            Luxe<span>Shop</span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <i class="bi bi-list fs-4"></i>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                <li class="nav-item"><a href="{{ route('shop') }}" class="nav-link {{ request()->routeIs('shop*') ? 'active' : '' }}">Shop</a></li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Categories</a>
                    <ul class="dropdown-menu border-0 shadow-luxury rounded-xl py-2">
                        @php $navCategories = \App\Models\Category::where('is_active', true)->take(8)->get(); @endphp
                        @foreach($navCategories as $cat)
                            <li><a href="{{ route('shop.category', $cat->slug) }}" class="dropdown-item py-2">{{ $cat->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item"><a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
                <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
            </ul>

            {{-- Search --}}
            <form action="{{ route('shop') }}" method="GET" class="d-flex me-3">
                <div class="input-group" style="width:240px;">
                    <input type="text" name="search" class="form-control rounded-start-pill border-end-0"
                           placeholder="Search products..." value="{{ request('search') }}"
                           style="border:1.5px solid var(--border); font-size:.875rem;">
                    <button type="submit" class="btn btn-accent rounded-end-pill px-3" style="border-radius: 0 50px 50px 0 !important;">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>

            {{-- Icons --}}
            <div class="d-flex align-items-center gap-2">
                @auth
                <a href="{{ route('wishlist.index') }}" class="nav-icon-btn"><i class="bi bi-heart"></i></a>
                <a href="{{ route('profile.show') }}" class="nav-icon-btn"><i class="bi bi-person"></i></a>
                @endauth
                <a href="{{ route('cart.index') }}" class="nav-icon-btn">
                    <i class="bi bi-bag"></i>
                    @php $cartCount = auth()->check() ? \App\Models\Cart::where('user_id', auth()->id())->sum('quantity') : \App\Models\Cart::where('session_id', session()->getId())->sum('quantity'); @endphp
                    @if($cartCount > 0)
                        <span class="cart-badge">{{ $cartCount }}</span>
                    @endif
                </a>
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-accent btn-sm">Admin</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-secondary rounded-pill">Logout</button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</nav>

{{-- Flash Messages --}}
@if(session('success'))
<div class="container mt-3">
    <div class="alert alert-luxury alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill text-success me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
</div>
@endif
@if(session('error'))
<div class="container mt-3">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
</div>
@endif

{{-- Main Content --}}
@yield('content')

{{-- Footer --}}
<footer class="pt-5 mt-5">
    <div class="container pb-4">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="footer-brand">Luxe<span>Shop</span></div>
                <p class="mt-3" style="font-size:.9rem;line-height:1.7;">
                    Your premium destination for curated products across fashion, electronics, home living, and more. Quality you can trust.
                </p>
                <div class="mt-3">
                    <a href="#" class="social-link"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-link"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-link"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="social-link"><i class="bi bi-pinterest"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-6">
                <h5>Shop</h5>
                <a href="{{ route('shop') }}">All Products</a>
                <a href="{{ route('shop') }}?filter=new">New Arrivals</a>
                <a href="{{ route('shop') }}?filter=featured">Featured</a>
                <a href="{{ route('shop') }}?filter=sale">On Sale</a>
            </div>
            <div class="col-lg-2 col-6">
                <h5>Info</h5>
                <a href="{{ route('about') }}">About Us</a>
                <a href="{{ route('contact') }}">Contact</a>
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
            </div>
            <div class="col-lg-4">
                <h5>Newsletter</h5>
                <p style="font-size:.9rem;">Get exclusive deals and the latest news delivered straight to your inbox.</p>
                <div class="input-group mt-2">
                    <input type="email" class="form-control rounded-start-pill border-0"
                           placeholder="Your email address"
                           style="background:rgba(255,255,255,.1);color:#fff;">
                    <button class="btn btn-accent rounded-end-pill" style="border-radius:0 50px 50px 0 !important;">
                        Subscribe
                    </button>
                </div>
                <div class="mt-3">
                    <small><i class="bi bi-envelope me-2 text-accent"></i>admin@luxeshop.com</small><br>
                    <small><i class="bi bi-telephone me-2 text-accent"></i>+1 (800) 123-4567</small>
                </div>
            </div>
        </div>
    </div>
    <hr class="footer-divider">
    <div class="footer-bottom">
        <div class="container d-flex flex-wrap justify-content-between align-items-center">
            <span>&copy; {{ date('Y') }} LuxeShop. All rights reserved.</span>
            <div class="d-flex gap-2 mt-2 mt-md-0">
                <img src="https://via.placeholder.com/40x25/1a1a2e/c9a96e?text=VISA" alt="Visa" class="rounded" style="height:25px;">
                <img src="https://via.placeholder.com/40x25/1a1a2e/c9a96e?text=MC" alt="Mastercard" class="rounded" style="height:25px;">
                <img src="https://via.placeholder.com/40x25/1a1a2e/c9a96e?text=PP" alt="PayPal" class="rounded" style="height:25px;">
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Scroll reveal
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                setTimeout(() => entry.target.classList.add('visible'), i * 80);
            }
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>
@stack('scripts')
</body>
</html>