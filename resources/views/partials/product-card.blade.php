<div class="product-card h-100">
    {{-- Badge --}}
    @if($product->is_new_arrival)
        <span class="product-badge badge-new">New</span>
    @elseif($product->discount_percent > 0)
        <span class="product-badge badge-sale">-{{ $product->discount_percent }}%</span>
    @elseif($product->is_best_seller)
        <span class="product-badge badge-hot">Hot</span>
    @endif

    {{-- Actions --}}
    <div class="product-card-actions">
        @auth
        <form action="{{ route('wishlist.toggle', $product) }}" method="POST">
            @csrf
            <button type="submit" class="product-action-btn" title="Add to Wishlist">
                <i class="bi bi-heart{{ auth()->user()->wishlists()->where('product_id',$product->id)->exists() ? '-fill text-danger' : '' }}"></i>
            </button>
        </form>
        @endauth
        <a href="{{ route('product.show', $product->slug) }}" class="product-action-btn" title="Quick View">
            <i class="bi bi-eye"></i>
        </a>
    </div>

    {{-- Image --}}
    <a href="{{ route('product.show', $product->slug) }}" class="d-block">
        <div class="product-card-img-wrap">
            <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}" loading="lazy">
        </div>
    </a>

    {{-- Body --}}
    <div class="product-body">
        <div class="product-category">
            <a href="{{ route('shop.category', $product->category->slug) }}">{{ $product->category->name }}</a>
        </div>
        <h6 class="product-name">
            <a href="{{ route('product.show', $product->slug) }}" class="stretched-link" style="position:relative;">
                {{ Str::limit($product->name, 45) }}
            </a>
        </h6>

        @if($product->reviews_count > 0)
        <div class="star-rating mb-1">
            @for($i=1;$i<=5;$i++)
                <i class="bi bi-star{{ $i <= round($product->rating) ? '-fill' : ($i - $product->rating < 1 ? '-half' : '') }}"></i>
            @endfor
            <small class="text-muted ms-1">({{ $product->reviews_count }})</small>
        </div>
        @endif

        <div class="d-flex align-items-center justify-content-between mt-2">
            <div class="product-price">
                ${{ number_format($product->current_price, 2) }}
                @if($product->sale_price)
                    <span class="original">${{ number_format($product->price, 2) }}</span>
                @endif
            </div>
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="btn-accent" style="padding:.4rem .9rem;font-size:.75rem;border-radius:50px;" title="Add to Cart">
                    <i class="bi bi-bag-plus"></i>
                </button>
            </form>
        </div>
    </div>
</div>