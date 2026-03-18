@extends('layouts.frontend')
@section('title', 'About Us')

@section('content')
<div class="breadcrumb-section">
    <div class="container">
        <nav><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">About</li>
        </ol></nav>
    </div>
</div>

{{-- Hero --}}
<section class="py-5" style="background:linear-gradient(135deg,#1a1a2e,#2d2d54);color:#fff;">
    <div class="container py-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="section-label" style="color:var(--accent-light);">Our Story</span>
                <h1 style="font-size:3rem;color:#fff;">Passion for<br>Premium Quality</h1>
                <p style="color:rgba(255,255,255,.75);font-size:1.05rem;line-height:1.7;">
                    Founded in 2018, LuxeShop was born from a simple belief: everyone deserves access to premium products without premium complexity. We curate the finest items from around the world and bring them to your doorstep.
                </p>
                <a href="{{ route('shop') }}" class="btn btn-accent mt-2">Explore Our Collection</a>
            </div>
            <div class="col-lg-6">
                <div class="row g-3">
                    @foreach([['10K+','Happy Customers'],['500+','Premium Products'],['50+','Top Brands'],['99%','Satisfaction Rate']] as $s)
                    <div class="col-6">
                        <div class="p-4 rounded-xl text-center" style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);">
                            <div style="font-family:'Cormorant Garamond',serif;font-size:2.5rem;font-weight:700;color:var(--accent);">{{ $s[0] }}</div>
                            <div style="font-size:.875rem;color:rgba(255,255,255,.7);">{{ $s[1] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Values --}}
<section class="py-5">
    <div class="container">
        <div class="section-header text-center reveal">
            <span class="section-label">What drives us</span>
            <h2 class="section-title">Our Core Values</h2>
            <div class="section-divider mx-auto"></div>
        </div>
        <div class="row g-4">
            @foreach([
                ['bi-gem','Quality First','We carefully curate every product to ensure it meets our high standards for quality and durability.'],
                ['bi-people','Customer Focus','Your satisfaction is our priority. We go above and beyond to ensure an exceptional experience.'],
                ['bi-shield-check','Trust & Integrity','We believe in complete transparency with our pricing, policies, and products.'],
                ['bi-lightning','Innovation','We continuously improve our platform to bring you the most seamless shopping experience.'],
            ] as $i => $v)
            <div class="col-md-6 col-lg-3 reveal" style="transition-delay:{{ $i*0.1 }}s">
                <div class="text-center p-4 rounded-xl bg-white border h-100" style="border-color:var(--border)!important;box-shadow:var(--shadow-sm);">
                    <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3"
                         style="width:64px;height:64px;background:rgba(201,169,110,.12);">
                        <i class="bi {{ $v[0] }} fs-3 text-accent"></i>
                    </div>
                    <h5>{{ $v[1] }}</h5>
                    <p class="text-muted" style="font-size:.875rem;">{{ $v[2] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection