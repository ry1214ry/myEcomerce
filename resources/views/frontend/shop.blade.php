@extends('layouts.frontend')
@section('title', 'Shop')

@section('content')

{{-- Breadcrumb --}}
<div class="breadcrumb-section">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Shop</li>
                @if(isset($category)) <li class="breadcrumb-item active">{{ $category->name }}</li> @endif
                @if(isset($brand)) <li class="breadcrumb-item active">{{ $brand->name }}</li> @endif
            </ol>
        </nav>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">

        {{-- SIDEBAR --}}
        <div class="col-lg-3">
            <div class="sticky-top" style="top:80px;">

                {{-- Search --}}
                <div class="admin-card p-4 mb-4" style="border-radius:16px;border:1px solid var(--border);box-shadow:var(--shadow-sm);">
                    <h6 class="fw-bold mb-3" style="font-family:'Cormorant Garamond',serif;font-size:1.1rem;">Search</h6>
                    <form action="{{ route('shop') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control rounded-start-pill border-end-0"
                                   placeholder="Search..." value="{{ request('search') }}" style="font-size:.875rem;">
                            <button class="btn btn-accent rounded-end-pill px-3" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Filters --}}
                <form action="{{ route('shop') }}" method="GET" id="filterForm">
                    @if(request('search'))<input type="hidden" name="search" value="{{ request('search') }}">@endif

                    {{-- Categories --}}
                    <div class="p-4 mb-3 rounded-xl bg-white border" style="border-color:var(--border)!important;">
                        <h6 class="fw-bold mb-3" style="font-family:'Cormorant Garamond',serif;font-size:1.1rem;">Categories</h6>
                        @foreach($categories as $cat)
                        <div class="form-check mb-1">
                            <input class="form-check-input" type="radio" name="category"
                                   id="cat{{ $cat->id }}" value="{{ $cat->slug }}"
                                   {{ request('category') == $cat->slug ? 'checked' : '' }}
                                   onchange="document.getElementById('filterForm').submit()">
                            <label class="form-check-label d-flex justify-content-between" for="cat{{ $cat->id }}" style="font-size:.875rem;">
                                {{ $cat->name }}
                                <span class="badge rounded-pill bg-light text-muted" style="font-size:.7rem;">{{ $cat->products_count }}</span>
                            </label>
                        </div>
                        @endforeach
                    </div>

                    {{-- Brands --}}
                    <div class="p-4 mb-3 rounded-xl bg-white border" style="border-color:var(--border)!important;">
                        <h6 class="fw-bold mb-3" style="font-family:'Cormorant Garamond',serif;font-size:1.1rem;">Brands</h6>
                        @foreach($brands->take(8) as $b)
                        <div class="form-check mb-1">
                            <input class="form-check-input" type="radio" name="brand"
                                   id="brand{{ $b->id }}" value="{{ $b->slug }}"
                                   {{ request('brand') == $b->slug ? 'checked' : '' }}
                                   onchange="document.getElementById('filterForm').submit()">
                            <label class="form-check-label d-flex justify-content-between" for="brand{{ $b->id }}" style="font-size:.875rem;">
                                {{ $b->name }}
                                <span class="badge rounded-pill bg-light text-muted" style="font-size:.7rem;">{{ $b->products_count }}</span>
                            </label>
                        </div>
                        @endforeach
                    </div>

                    {{-- Price Range --}}
                    <div class="p-4 mb-3 rounded-xl bg-white border" style="border-color:var(--border)!important;">
                        <h6 class="fw-bold mb-3" style="font-family:'Cormorant Garamond',serif;font-size:1.1rem;">Price Range</h6>
                        <div class="row g-2">
                            <div class="col-6">
                                <input type="number" name="min_price" class="form-control form-control-sm rounded-pill"
                                       placeholder="Min" value="{{ request('min_price') }}">
                            </div>
                            <div class="col-6">
                                <input type="number" name="max_price" class="form-control form-control-sm rounded-pill"
                                       placeholder="Max" value="{{ request('max_price') }}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-accent w-100 mt-2" style="font-size:.8rem;">Apply</button>
                    </div>

                    {{-- Clear Filters --}}
                    @if(request()->hasAny(['search','category','brand','min_price','max_price']))
                    <a href="{{ route('shop') }}" class="btn btn-outline-secondary w-100 rounded-pill btn-sm">
                        <i class="bi bi-x-circle me-1"></i>Clear All Filters
                    </a>
                    @endif
                </form>
            </div>
        </div>

        {{-- PRODUCTS GRID --}}
        <div class="col-lg-9">

            {{-- Sort Bar --}}
            <div class="d-flex align-items-center justify-content-between mb-4 p-3 rounded-xl bg-white border" style="border-color:var(--border)!important;">
                <span class="text-muted" style="font-size:.875rem;">
                    Showing <strong>{{ $products->firstItem() ?? 0 }}–{{ $products->lastItem() ?? 0 }}</strong> of <strong>{{ $products->total() }}</strong> products
                </span>
                <form action="{{ route('shop') }}" method="GET" class="d-flex align-items-center gap-2">
                    @foreach(request()->except('sort') as $k => $v)
                        <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                    @endforeach
                    <label for="sort" class="text-muted small mb-0 d-none d-md-block">Sort by:</label>
                    <select name="sort" id="sort" class="form-select form-select-sm rounded-pill" style="width:auto;" onchange="this.form.submit()">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                    </select>
                </form>
            </div>

            @if($products->isEmpty())
            <div class="text-center py-5">
                <i class="bi bi-search fs-1 text-muted d-block mb-3"></i>
                <h5>No products found</h5>
                <p class="text-muted">Try adjusting your filters or search terms.</p>
                <a href="{{ route('shop') }}" class="btn btn-accent">View All Products</a>
            </div>
            @else
            <div class="row g-4">
                @foreach($products as $i => $product)
                <div class="col-6 col-md-4 reveal" style="transition-delay:{{ ($i % 6) * 0.05 }}s">
                    @include('partials.product-card', ['product' => $product])
                </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-5">
                {{ $products->links('vendor.pagination.bootstrap-5') }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection