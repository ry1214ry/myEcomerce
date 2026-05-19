@extends('layouts.frontend')
@section('title', 'Home')

@push('styles')
{{-- Swiper CSS --}}
<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

<style>
    /* ── Category Slider Wrapper ──────────────────────────────── */
    .cat-slider-wrap {
        position: relative;
        padding: 0 8px;
    }
    .categorySwiper {
        padding-bottom: 44px !important;
        overflow: visible !important;
    }
    .categorySwiper .swiper-wrapper { align-items: stretch; }
    .categorySwiper .swiper-slide   { height: auto; }

    /* ── Category Card ────────────────────────────────────────── */
    .cat-card-link {
        display: block;
        text-decoration: none;
    }
    .cat-card {
        border-radius: 16px;
        overflow: hidden;
        transition: transform .35s ease, box-shadow .35s ease;
        cursor: pointer;
    }
    .cat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 48px rgba(26,26,46,.14);
    }
    .cat-card-img {
        position: relative;
        aspect-ratio: 4/3;
        overflow: hidden;
        border-radius: 16px;
        background: var(--bg-light);
    }
    .cat-card-img img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform .5s ease;
        display: block;
    }
    .cat-card:hover .cat-card-img img { transform: scale(1.1); }

    .cat-card-placeholder {
        width: 100%; height: 100%;
        background: linear-gradient(135deg, #1a1a2e, #2d2d54);
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255,255,255,.2);
        font-size: 2.5rem;
    }

    /* Overlay */
    .cat-card-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top,
            rgba(15,15,35,.82) 0%,
            rgba(15,15,35,.15) 55%,
            transparent 100%);
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 1.1rem 1rem;
        transition: background .3s;
    }
    .cat-card:hover .cat-card-overlay {
        background: linear-gradient(to top,
            rgba(15,15,35,.9) 0%,
            rgba(15,15,35,.3) 60%,
            transparent 100%);
    }
    .cat-card-name {
        color: #fff;
        font-family: 'Cormorant Garamond', serif;
        font-size: 1rem;
        font-weight: 600;
        margin: 0 0 .2rem;
        line-height: 1.2;
    }
    .cat-card-count {
        color: rgba(255,255,255,.6);
        font-size: .75rem;
        display: block;
    }
    .cat-card-arrow {
        position: absolute;
        top: 12px; right: 12px;
        width: 28px; height: 28px;
        border-radius: 50%;
        background: rgba(255,255,255,.15);
        backdrop-filter: blur(4px);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: .75rem;
        opacity: 0;
        transform: translateX(-6px);
        transition: all .3s ease;
    }
    .cat-card:hover .cat-card-arrow {
        opacity: 1;
        transform: translateX(0);
    }

    /* ── Nav Buttons ──────────────────────────────────────────── */
    .cat-nav-btn {
        position: absolute;
        top: calc(50% - 22px);
        transform: translateY(-50%);
        z-index: 20;
        width: 44px; height: 44px;
        border-radius: 50%;
        border: 2px solid var(--border);
        background: #fff;
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 1rem;
        box-shadow: 0 4px 16px rgba(26,26,46,.1);
        transition: all .25s ease;
        outline: none;
    }
    .cat-nav-btn:hover {
        background: var(--accent);
        border-color: var(--accent);
        color: #fff;
        box-shadow: 0 8px 24px rgba(201,169,110,.35);
        transform: translateY(-50%) scale(1.05);
    }
    .cat-prev { left: -22px; }
    .cat-next { right: -22px; }

    /* ── Pagination Dots ──────────────────────────────────────── */
    .cat-dots { bottom: 0 !important; }
    .cat-dots .swiper-pagination-bullet {
        width: 8px; height: 8px;
        background: var(--border);
        opacity: 1;
        transition: all .3s ease;
    }
    .cat-dots .swiper-pagination-bullet-active {
        background: var(--accent);
        width: 24px;
        border-radius: 4px;
    }

    /* ── Responsive ───────────────────────────────────────────── */
    @media (max-width: 767px) {
        .cat-prev { left: -12px; }
        .cat-next { right: -12px; }
        .cat-nav-btn { width: 36px; height: 36px; font-size: .85rem; }
    }
</style>
@endpush

@section('content')

{{-- ════════════════════════════════════════════════════════════════
     HERO SLIDER
════════════════════════════════════════════════════════════════ --}}
<section class="hero-slider">
    <div id="heroCarousel"
         class="carousel slide carousel-fade"
         data-bs-ride="carousel"
         data-bs-interval="5000">

        <div class="carousel-indicators">
            @foreach($banners as $i => $banner)
            <button type="button"
                    data-bs-target="#heroCarousel"
                    data-bs-slide-to="{{ $i }}"
                    {{ $i === 0 ? 'class=active' : '' }}>
            </button>
            @endforeach
        </div>

        <div class="carousel-inner">
            @forelse($banners as $i => $banner)
            <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}">
                <div class="hero-overlay">
                    <div class="container">
                        <div class="hero-content
                                    animate__animated
                                    animate__fadeInLeft">
                            @if($banner->subtitle)
                            <span class="hero-label">
                                {{ $banner->subtitle }}
                            </span>
                            @endif
                            <h1 class="hero-title">{{ $banner->title }}</h1>
                            @if($banner->description)
                            <p class="hero-desc">{{ $banner->description }}</p>
                            @endif
                            @if($banner->button_text)
                            <a href="{{ $banner->button_link ?? route('shop') }}"
                               class="btn btn-accent btn-lg me-3">
                                {{ $banner->button_text }}
                                <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                            @endif
                            <a href="{{ route('shop') }}"
                               class="btn btn-outline-light btn-lg rounded-pill">
                                Explore All
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="carousel-item active">
                <div style="height:75vh;
                            background:linear-gradient(135deg,#1a1a2e,#16213e);">
                </div>
                <div class="hero-overlay">
                    <div class="container">
                        <div class="hero-content">
                            <span class="hero-label">
                                Welcome to LuxeShop
                            </span>
                            <h1 class="hero-title">
                                Premium Products,<br>Unmatched Quality
                            </h1>
                            <a href="{{ route('shop') }}"
                               class="btn btn-accent btn-lg">
                                Shop Now
                                <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforelse
        </div>

        <button class="carousel-control-prev"
                type="button"
                data-bs-target="#heroCarousel"
                data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next"
                type="button"
                data-bs-target="#heroCarousel"
                data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</section>

{{-- ════════════════════════════════════════════════════════════════
     FEATURES STRIP
════════════════════════════════════════════════════════════════ --}}
<section class="py-4"
         style="background:var(--bg-light);
                border-bottom:1px solid var(--border);">
    <div class="container">
        <div class="row g-3 text-center">
            @foreach([
                ['bi-truck',                  'Free Shipping',  'On orders over $100'],
                ['bi-shield-check',           'Secure Payment', '100% protected'],
                ['bi-arrow-counterclockwise', 'Easy Returns',   '30 day policy'],
                ['bi-headset',                '24/7 Support',   'Always here for you'],
            ] as $f)
            <div class="col-6 col-md-3">
                <div class="d-flex align-items-center gap-3
                            justify-content-center
                            justify-content-md-start">
                    <div class="rounded-circle d-flex align-items-center
                                justify-content-center flex-shrink-0"
                         style="width:48px;height:48px;
                                background:rgba(201,169,110,.12);">
                        <i class="bi {{ $f[0] }} fs-5 text-accent"></i>
                    </div>
                    <div class="text-start">
                        <div class="fw-600" style="font-size:.9rem;">
                            {{ $f[1] }}
                        </div>
                        <div style="font-size:.78rem;color:var(--text-muted);">
                            {{ $f[2] }}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════════════════════════════
     CATEGORIES — AUTO-PLAY SLIDESHOW
════════════════════════════════════════════════════════════════ --}}
@if($categories->count())
<section class="py-5">
    <div class="container">

        {{-- Header --}}
        <div class="d-flex align-items-end
                    justify-content-between mb-4 reveal">
            <div>
                <span class="section-label">Browse by</span>
                <h2 class="section-title">Shop by Category</h2>
                <div class="section-divider"></div>
            </div>
            <a href="{{ route('shop') }}"
               class="btn btn-outline-accent btn-sm
                      d-none d-md-block rounded-pill">
                All Categories
                <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>

        {{-- Slider --}}
        <div class="cat-slider-wrap reveal">

            {{-- Prev --}}
            <button class="cat-nav-btn cat-prev"
                    id="catPrev"
                    aria-label="Previous">
                <i class="bi bi-chevron-left"></i>
            </button>

            {{-- Next --}}
            <button class="cat-nav-btn cat-next"
                    id="catNext"
                    aria-label="Next">
                <i class="bi bi-chevron-right"></i>
            </button>

            <div class="swiper categorySwiper">
                <div class="swiper-wrapper">
                    @foreach($categories as $category)
                    <div class="swiper-slide">
                        <a href="{{ route('shop.category', $category->slug) }}"
                           class="cat-card-link">
                            <div class="cat-card">
                                <div class="cat-card-img">
                                    @if($category->image)
                                    <img src="{{ $category->image_url }}"
                                         alt="{{ $category->name }}"
                                         loading="lazy"
                                         onerror="this.src='https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?w=400&h=300&fit=crop'">
                                    @else
                                    <div class="cat-card-placeholder">
                                        <i class="bi bi-grid"></i>
                                    </div>
                                    @endif
                                    <div class="cat-card-overlay">
                                        <h6 class="cat-card-name">
                                            {{ $category->name }}
                                        </h6>
                                        <span class="cat-card-count">
                                            {{ $category->products_count ?? 0 }}
                                            items
                                        </span>
                                        <span class="cat-card-arrow">
                                            <i class="bi bi-arrow-right"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination cat-dots"></div>
            </div>

        </div>
    </div>
</section>
@endif

{{-- ════════════════════════════════════════════════════════════════
     FEATURED PRODUCTS
════════════════════════════════════════════════════════════════ --}}
@if($featuredProducts->count())
<section class="py-5 bg-light-main">
    <div class="container">
        <div class="d-flex align-items-end
                    justify-content-between mb-4 reveal">
            <div>
                <span class="section-label">Hand-picked</span>
                <h2 class="section-title">Featured Products</h2>
                <div class="section-divider"></div>
            </div>
            <a href="{{ route('shop') }}?filter=featured"
               class="btn btn-outline-accent btn-sm d-none d-md-block">
                View All <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
        <div class="row g-4">
            @foreach($featuredProducts as $i => $product)
            <div class="col-6 col-md-4 col-lg-3 reveal"
                 style="transition-delay:{{ ($i % 4) * 0.06 }}s">
                @include('partials.product-card', ['product' => $product])
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ════════════════════════════════════════════════════════════════
     PROMO BANNERS
════════════════════════════════════════════════════════════════ --}}
<section class="py-5">
    <div class="container">
        <div class="row g-4 reveal">
            <div class="col-md-6">
                <div class="rounded-xl p-5 d-flex
                             flex-column justify-content-center"
                     style="background:linear-gradient(135deg,#1a1a2e,#2d2d54);
                            color:#fff;min-height:220px;">
                    <span class="section-label"
                          style="color:var(--accent-light);">
                        Limited Time
                    </span>
                    <h3 class="text-white mb-2"
                        style="font-size:1.75rem;">
                        Summer Sale
                    </h3>
                    <p style="color:rgba(255,255,255,.75);"
                       class="mb-3">
                        Up to 40% off on selected items.
                        Don't miss out!
                    </p>
                    <a href="{{ route('shop') }}"
                       class="btn btn-accent align-self-start">
                        Shop Sale
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="rounded-xl p-5 d-flex
                             flex-column justify-content-center"
                     style="background:linear-gradient(135deg,#c9a96e,#e8d5b0);
                            min-height:220px;">
                    <span class="section-label"
                          style="color:#7a5c2e;">
                        New Season
                    </span>
                    <h3 class="mb-2"
                        style="font-size:1.75rem;color:#3d2c0e;">
                        New Arrivals
                    </h3>
                    <p style="color:rgba(61,44,14,.7);"
                       class="mb-3">
                        Discover the freshest styles just landed.
                    </p>
                    <a href="{{ route('shop') }}?filter=new"
                       class="btn btn-dark-main align-self-start">
                        Explore Now
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════════════════════════════
     NEW ARRIVALS
════════════════════════════════════════════════════════════════ --}}
@if($newArrivals->count())
<section class="py-5 bg-light-main">
    <div class="container">
        <div class="d-flex align-items-end
                    justify-content-between mb-4 reveal">
            <div>
                <span class="section-label">Just landed</span>
                <h2 class="section-title">New Arrivals</h2>
                <div class="section-divider"></div>
            </div>
            <a href="{{ route('shop') }}?filter=new"
               class="btn btn-outline-accent btn-sm d-none d-md-block">
                View All <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
        <div class="row g-4">
            @foreach($newArrivals as $i => $product)
            <div class="col-6 col-md-4 col-lg-3 reveal"
                 style="transition-delay:{{ ($i % 4) * 0.06 }}s">
                @include('partials.product-card', ['product' => $product])
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ════════════════════════════════════════════════════════════════
     BEST SELLERS
════════════════════════════════════════════════════════════════ --}}
@if($bestSellers->count())
<section class="py-5">
    <div class="container">
        <div class="d-flex align-items-end
                    justify-content-between mb-4 reveal">
            <div>
                <span class="section-label">Customer favorites</span>
                <h2 class="section-title">Best Sellers</h2>
                <div class="section-divider"></div>
            </div>
            <a href="{{ route('shop') }}?filter=bestseller"
               class="btn btn-outline-accent btn-sm d-none d-md-block">
                View All <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
        <div class="row g-4">
            @foreach($bestSellers as $i => $product)
            <div class="col-6 col-md-4 col-lg-3 reveal"
                 style="transition-delay:{{ ($i % 4) * 0.06 }}s">
                @include('partials.product-card', ['product' => $product])
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ════════════════════════════════════════════════════════════════
     BRANDS
════════════════════════════════════════════════════════════════ --}}
@if($brands->count())
<section class="py-5 bg-light-main">
    <div class="container">
        <div class="section-header text-center reveal mb-4">
            <span class="section-label">Our partners</span>
            <h2 class="section-title">Top Brands</h2>
            <div class="section-divider mx-auto"></div>
        </div>
        <div class="row g-3 align-items-center
                    justify-content-center reveal">
            @foreach($brands as $brand)
            <div class="col-6 col-md-3 col-lg-2">
                <a href="{{ route('shop.brand', $brand->slug) }}"
                   class="d-flex align-items-center justify-content-center
                          p-3 rounded-xl bg-white border"
                   style="height:80px;transition:all .3s;
                          border-color:var(--border)!important;"
                   onmouseover="this.style.borderColor='var(--accent)';
                                this.style.boxShadow='var(--shadow-md)'"
                   onmouseout="this.style.borderColor='var(--border)';
                               this.style.boxShadow='none'">
                    @if($brand->logo)
                    <img src="{{ $brand->logo_url }}"
                         alt="{{ $brand->name }}"
                         style="max-height:40px;max-width:100%;
                                object-fit:contain;">
                    @else
                    <span style="font-family:'Cormorant Garamond',serif;
                                 font-size:1.2rem;font-weight:700;
                                 color:var(--primary);">
                        {{ $brand->name }}
                    </span>
                    @endif
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ════════════════════════════════════════════════════════════════
     TESTIMONIALS
════════════════════════════════════════════════════════════════ --}}
<section class="py-5">
    <div class="container">
        <div class="section-header text-center reveal mb-4">
            <span class="section-label">What they say</span>
            <h2 class="section-title">Customer Reviews</h2>
            <div class="section-divider mx-auto"></div>
        </div>
        <div class="row g-4">
            @foreach([
                [
                    'Sarah M.',
                    'Absolutely love the quality. Fast delivery and beautiful packaging. Will definitely shop again!',
                    5,
                    'Fashion'
                ],
                [
                    'James R.',
                    'The electronics section is phenomenal. Got my iPhone in perfect condition with great service.',
                    5,
                    'Electronics'
                ],
                [
                    'Emma L.',
                    'LuxeShop has become my go-to for home decor. The pieces are stunning and the prices are fair.',
                    4,
                    'Home & Living'
                ],
            ] as $i => $r)
            <div class="col-md-4 reveal"
                 style="transition-delay:{{ $i * 0.1 }}s">
                <div class="p-4 rounded-xl bg-white border h-100"
                     style="border-color:var(--border)!important;
                            box-shadow:var(--shadow-sm);">
                    <div class="star-rating mb-2">
                        @for($s = 1; $s <= 5; $s++)
                            <i class="bi bi-star{{ $s <= $r[2] ? '-fill' : '' }}"></i>
                        @endfor
                    </div>
                    <p style="color:var(--text-muted);
                               font-size:.95rem;line-height:1.7;">
                        "{{ $r[1] }}"
                    </p>
                    <div class="d-flex align-items-center gap-2 mt-3">
                        <div class="rounded-circle d-flex align-items-center
                                    justify-content-center text-white fw-bold
                                    flex-shrink-0"
                             style="width:38px;height:38px;
                                    background:var(--accent);
                                    font-size:.9rem;">
                            {{ strtoupper(substr($r[0], 0, 1)) }}
                        </div>
                        <div>
                            <div class="fw-600" style="font-size:.875rem;">
                                {{ $r[0] }}
                            </div>
                            <div style="font-size:.75rem;
                                        color:var(--text-muted);">
                                {{ $r[3] }} customer
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

@push('scripts')
{{-- Swiper JS --}}
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // ════════════════════════════════════════════════════════════
    // CATEGORY AUTO-PLAY SLIDESHOW
    // ════════════════════════════════════════════════════════════
    new Swiper('.categorySwiper', {

        // How many slides visible
        slidesPerView: 2,
        spaceBetween:  14,

        // Infinite loop
        loop: true,

        // Auto play
        autoplay: {
            delay:                2500,   // 2.5s per slide
            disableOnInteraction: false,  // continue after swipe
            pauseOnMouseEnter:    true,   // pause on hover
        },

        // Slide speed
        speed: 700,

        // Dots pagination
        pagination: {
            el:        '.cat-dots',
            clickable: true,
        },

        // Arrow navigation
        navigation: {
            prevEl: '#catPrev',
            nextEl: '#catNext',
        },

        // Responsive breakpoints
        breakpoints: {
            480:  { slidesPerView: 3, spaceBetween: 14 },
            768:  { slidesPerView: 4, spaceBetween: 18 },
            992:  { slidesPerView: 5, spaceBetween: 20 },
            1200: { slidesPerView: 6, spaceBetween: 22 },
        },
    });

    // ════════════════════════════════════════════════════════════
    // ════════════════════════════════════════════════════════════
});
</script>
@endpush
