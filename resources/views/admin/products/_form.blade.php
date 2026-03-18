<div class="row g-4">
    <div class="col-lg-8">
        <div class="admin-card mb-4">
            <div class="admin-card-header"><h6 class="mb-0 fw-700">Product Information</h6></div>
            <div class="admin-card-body">
                <div class="mb-3">
                    <label class="form-label fw-500">Product Name *</label>
                    <input type="text" name="name" class="form-control rounded-pill @error('name') is-invalid @enderror"
                           value="{{ old('name', $product->name ?? '') }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-500">Short Description</label>
                    <input type="text" name="short_description" class="form-control rounded-pill"
                           value="{{ old('short_description', $product->short_description ?? '') }}"
                           placeholder="One-line product summary">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-500">Full Description</label>
                    <textarea name="description" class="form-control rounded-3" rows="6">{{ old('description', $product->description ?? '') }}</textarea>
                </div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-500">Regular Price *</label>
                        <div class="input-group">
                            <span class="input-group-text rounded-start-pill">$</span>
                            <input type="number" name="price" step="0.01" class="form-control @error('price') is-invalid @enderror"
                                   value="{{ old('price', $product->price ?? '') }}" required>
                        </div>
                        @error('price')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-500">Sale Price</label>
                        <div class="input-group">
                            <span class="input-group-text rounded-start-pill">$</span>
                            <input type="number" name="sale_price" step="0.01" class="form-control"
                                   value="{{ old('sale_price', $product->sale_price ?? '') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-500">Stock Quantity *</label>
                        <input type="number" name="stock_quantity" class="form-control rounded-pill"
                               value="{{ old('stock_quantity', $product->stock_quantity ?? 0) }}" required min="0">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        {{-- Category & Brand --}}
        <div class="admin-card mb-4">
            <div class="admin-card-header"><h6 class="mb-0 fw-700">Classification</h6></div>
            <div class="admin-card-body">
                <div class="mb-3">
                    <label class="form-label fw-500">Category *</label>
                    <select name="category_id" class="form-select rounded-pill @error('category_id') is-invalid @enderror" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-500">Brand</label>
                    <select name="brand_id" class="form-select rounded-pill">
                        <option value="">No Brand</option>
                        @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id ?? '') == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-500">SKU</label>
                    <input type="text" name="sku" class="form-control rounded-pill"
                           value="{{ old('sku', $product->sku ?? '') }}">
                </div>
            </div>
        </div>

        {{-- Image --}}
        <div class="admin-card mb-4">
            <div class="admin-card-header"><h6 class="mb-0 fw-700">Main Image</h6></div>
            <div class="admin-card-body">
                @isset($product)
                @if($product->main_image)
                <img src="{{ $product->main_image_url }}" class="w-100 rounded-xl mb-3" style="max-height:200px;object-fit:cover;">
                @endif
                @endisset
                <input type="file" name="main_image" class="form-control rounded-pill" accept="image/*">
            </div>
        </div>

        {{-- Flags --}}
        <div class="admin-card mb-4">
            <div class="admin-card-header"><h6 class="mb-0 fw-700">Product Flags</h6></div>
            <div class="admin-card-body">
                @foreach([
                    ['is_active','Active / Visible',true],
                    ['is_featured','Featured Product',false],
                    ['is_new_arrival','New Arrival',false],
                    ['is_best_seller','Best Seller',false],
                ] as $flag)
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" name="{{ $flag[0] }}" id="{{ $flag[0] }}" value="1"
                           {{ old($flag[0], isset($product) ? $product->{$flag[0]} : $flag[2]) ? 'checked' : '' }}>
                    <label class="form-check-label" for="{{ $flag[0] }}">{{ $flag[1] }}</label>
                </div>
                @endforeach
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-accent flex-grow-1">
                <i class="bi bi-check-lg me-1"></i>Save Product
            </button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary rounded-pill">Cancel</a>
        </div>
    </div>
</div>