@extends('layouts.frontend')
@section('title', $product->name)

@section('content')

<div class="breadcrumb-section">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('shop') }}">Shop</a></li>
                <li class="breadcrumb-item"><a href="{{ route('shop.category', $product->category->slug) }}">{{ $product->category->name }}</a></li>
                <li class="breadcrumb-item active">{{ Str::limit($product->name, 40) }}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container py-5">
    <div class="row g-5">

        {{-- Product Images --}}
        <div class="col-lg-6">
            <div class="sticky-top" style="top:80px;">
                {{-- Main Image --}}
                <div class="rounded-xl overflow-hidden mb-3" style="aspect-ratio:1;background:var(--bg-light);">
                    <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}"
                         class="w-100 h-100" style="object-fit:cover;" id="mainProductImg">
                </div>
                {{-- Thumbnails --}}
                @if($product->images->count())
                <div class="d-flex gap-2 flex-wrap">
                    <div class="rounded-xl overflow-hidden border-2 cursor-pointer"
                         style="width:72px;height:72px;cursor:pointer;border:2px solid var(--accent);"
                         onclick="document.getElementById('mainProductImg').src='{{ $product->main_image_url }}'">
                        <img src="{{ $product->main_image_url }}" class="w-100 h-100" style="object-fit:cover;">
                    </div>
                    @foreach($product->images as $img)
                    <div class="rounded-xl overflow-hidden"
                         style="width:72px;height:72px;cursor:pointer;border:2px solid var(--border);"
                         onclick="document.getElementById('mainProductImg').src='{{ $img->image_url }}'">
                        <img src="{{ $img->image_url }}" class="w-100 h-100" style="object-fit:cover;">
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>

        {{-- Product Info --}}
        <div class="col-lg-6">
            {{-- Badges --}}
            <div class="d-flex gap-2 mb-3">
                @if($product->is_new_arrival)<span class="badge bg-dark rounded-pill">New Arrival</span>@endif
                @if($product->is_featured)<span class="badge rounded-pill" style="background:var(--accent);">Featured</span>@endif
                @if($product->is_best_seller)<span class="badge bg-danger rounded-pill">Best Seller</span>@endif
                @if($product->stock_quantity <= 5 && $product->stock_quantity > 0)
                    <span class="badge bg-warning text-dark rounded-pill">Only {{ $product->stock_quantity }} left!</span>
                @endif
            </div>

            <p class="text-accent fw-semibold mb-1" style="font-size:.8rem;letter-spacing:.1em;text-transform:uppercase;">
                <a href="{{ route('shop.category', $product->category->slug) }}">{{ $product->category->name }}</a>
                @if($product->brand) · <a href="{{ route('shop.brand', $product->brand->slug) }}">{{ $product->brand->name }}</a>@endif
            </p>
            <h1 style="font-size:2rem;">{{ $product->name }}</h1>

            {{-- Rating --}}
            @if($product->reviews_count > 0)
            <div class="d-flex align-items-center gap-2 mb-3">
                <div class="star-rating">
                    @for($i=1;$i<=5;$i++)<i class="bi bi-star{{ $i <= round($product->rating) ? '-fill' : '' }}"></i>@endfor
                </div>
                <span class="text-muted" style="font-size:.875rem;">{{ number_format($product->rating, 1) }} ({{ $product->reviews_count }} reviews)</span>
            </div>
            @endif

            {{-- Price --}}
            <div class="mb-4">
                <span style="font-size:2.2rem;font-weight:700;color:var(--primary);">${{ number_format($product->current_price, 2) }}</span>
                @if($product->sale_price)
                <span class="text-muted text-decoration-line-through ms-2" style="font-size:1.2rem;">${{ number_format($product->price, 2) }}</span>
                <span class="badge bg-danger rounded-pill ms-2">{{ $product->discount_percent }}% OFF</span>
                @endif
            </div>

            {{-- Short Description --}}
            @if($product->short_description)
            <p class="mb-4" style="color:var(--text-muted);line-height:1.7;">{{ $product->short_description }}</p>
            @endif

            {{-- Stock --}}
            <div class="mb-4">
                @if($product->stock_quantity > 0)
                    <span class="text-success"><i class="bi bi-check-circle-fill me-1"></i>In Stock ({{ $product->stock_quantity }} available)</span>
                @else
                    <span class="text-danger"><i class="bi bi-x-circle-fill me-1"></i>Out of Stock</span>
                @endif
                @if($product->sku)
                    <span class="text-muted ms-3" style="font-size:.85rem;">SKU: {{ $product->sku }}</span>
                @endif
            </div>

            {{-- Add to Cart --}}
            @if($product->stock_quantity > 0)
            <form action="{{ route('cart.add') }}" method="POST" class="mb-4">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="d-flex align-items-center gap-3 flex-wrap">
                    <div class="d-flex align-items-center border rounded-pill overflow-hidden" style="border-color:var(--border)!important;">
                        <button type="button" class="btn border-0 px-3" onclick="changeQty(-1)" style="font-size:1.2rem;">−</button>
                        <input type="number" name="quantity" id="qty" value="1" min="1" max="{{ $product->stock_quantity }}"
                               class="form-control border-0 text-center" style="width:60px;font-weight:600;">
                        <button type="button" class="btn border-0 px-3" onclick="changeQty(1)" style="font-size:1.2rem;">+</button>
                    </div>
                    <button type="submit" class="btn btn-accent flex-grow-1 flex-md-grow-0 px-4 py-2">
                        <i class="bi bi-bag-plus me-2"></i>Add to Cart
                    </button>
                    @auth
                    <form action="{{ route('wishlist.toggle', $product) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary rounded-pill px-3 py-2" title="Wishlist">
                            <i class="bi bi-heart"></i>
                        </button>
                    </form>
                    @endauth
                </div>
            </form>
            @endif

            {{-- Meta --}}
            <div class="border-top pt-3" style="border-color:var(--border)!important;">
                <div class="row g-3" style="font-size:.875rem;">
                    <div class="col-6">
                        <i class="bi bi-truck me-2 text-accent"></i>Free Shipping over $100
                    </div>
                    <div class="col-6">
                        <i class="bi bi-shield-check me-2 text-accent"></i>Secure Checkout
                    </div>
                    <div class="col-6">
                        <i class="bi bi-arrow-counterclockwise me-2 text-accent"></i>30-Day Returns
                    </div>
                    <div class="col-6">
                        <i class="bi bi-headset me-2 text-accent"></i>24/7 Support
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Description & Reviews --}}
    <div class="row g-4 mt-4">
        <div class="col-12">
            <ul class="nav nav-tabs border-0 mb-4" id="productTabs">
                <li class="nav-item">
                    <button class="nav-link active px-4 py-2 fw-500" data-bs-toggle="tab" data-bs-target="#descTab"
                            style="border:none;border-bottom:3px solid transparent;font-size:.9rem;">Description</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link px-4 py-2 fw-500" data-bs-toggle="tab" data-bs-target="#reviewsTab"
                            style="border:none;border-bottom:3px solid transparent;font-size:.9rem;">
                        Reviews ({{ $product->reviews->count() }})
                    </button>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="descTab">
                    <div style="max-width:800px;line-height:1.8;color:var(--text-muted);">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                </div>

                <div class="tab-pane fade" id="reviewsTab">
                    @forelse($product->reviews as $review)
                    <div class="border-bottom pb-4 mb-4" style="border-color:var(--border)!important;">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
                                 style="width:40px;height:40px;background:var(--accent);font-size:.9rem;flex-shrink:0;">
                                {{ strtoupper(substr($review->user->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="fw-600">{{ $review->user->name }}</div>
                                <div class="star-rating" style="font-size:.8rem;">
                                    @for($i=1;$i<=5;$i++)<i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>@endfor
                                </div>
                            </div>
                            <span class="text-muted ms-auto" style="font-size:.8rem;">{{ $review->created_at->diffForHumans() }}</span>
                        </div>
                        @if($review->title)<h6 class="mb-1">{{ $review->title }}</h6>@endif
                        <p class="text-muted mb-0" style="font-size:.9rem;">{{ $review->body }}</p>
                    </div>
                    @empty
                    <p class="text-muted">No reviews yet. Be the first to review!</p>
                    @endforelse

                    {{-- Write Review --}}
                    @auth
                    <div class="mt-4 p-4 rounded-xl" style="background:var(--bg-light);">
                        <h5 class="mb-3">Write a Review</h5>
                        <form action="{{ route('reviews.store', $product) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-500">Rating</label>
                                <div class="d-flex gap-1" id="starRating">
                                    @for($i=1;$i<=5;$i++)
                                    <i class="bi bi-star fs-4 text-muted" data-rating="{{ $i }}"
                                       style="cursor:pointer;" onclick="setRating({{ $i }})"></i>
                                    @endfor
                                </div>
                                <input type="hidden" name="rating" id="ratingInput" value="5">
                            </div>
                            <div class="mb-3">
                                <input type="text" name="title" class="form-control rounded-pill" placeholder="Review title (optional)">
                            </div>
                            <div class="mb-3">
                                <textarea name="body" class="form-control rounded-3" rows="4" placeholder="Share your experience..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-accent">Submit Review</button>
                        </form>
                    </div>
                    @else
                    <div class="mt-3 p-3 rounded-xl" style="background:var(--bg-light);">
                        <a href="{{ route('login') }}" class="text-accent">Sign in</a> to write a review.
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    {{-- Related Products --}}
    @if($relatedProducts->count())
    <div class="mt-5">
        <h3 class="mb-4">Related Products</h3>
        <div class="row g-4">
            @foreach($relatedProducts as $product)
            <div class="col-6 col-md-3">
                @include('partials.product-card', ['product' => $product])
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script>
function changeQty(delta) {
    const input = document.getElementById('qty');
    const val = parseInt(input.value) + delta;
    const max = parseInt(input.max);
    if (val >= 1 && val <= max) input.value = val;
}

function setRating(rating) {
    document.getElementById('ratingInput').value = rating;
    document.querySelectorAll('#starRating i').forEach((star, i) => {
        star.className = 'bi bi-star' + (i < rating ? '-fill text-warning' : ' text-muted') + ' fs-4';
    });
}
setRating(5);
</script>
@endpush
@endsection