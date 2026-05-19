<div class="row g-4">

    {{-- ── LEFT COLUMN ─────────────────────────────────────────── --}}
    <div class="col-lg-8">

        {{-- Basic Info --}}
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <h6 class="mb-0 fw-700">
                    <i class="bi bi-info-circle me-2 text-accent"></i>
                    Product Information
                </h6>
            </div>
            <div class="admin-card-body">

                {{-- Name --}}
                <div class="mb-3">
                    <label class="form-label fw-500">
                        Product Name <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                           name="name"
                           id="productName"
                           class="form-control rounded-pill @error('name') is-invalid @enderror"
                           value="{{ old('name', isset($product) ? $product->name : '') }}"
                           placeholder="Enter product name"
                           required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Short Description --}}
                <div class="mb-3">
                    <label class="form-label fw-500">Short Description</label>
                    <input type="text"
                           name="short_description"
                           class="form-control rounded-pill"
                           value="{{ old('short_description', isset($product) ? $product->short_description : '') }}"
                           placeholder="One line summary shown in product cards">
                </div>

                {{-- Full Description --}}
                <div class="mb-3">
                    <label class="form-label fw-500">Full Description</label>
                    <textarea name="description"
                              class="form-control rounded-3"
                              rows="6"
                              placeholder="Detailed product description...">{{ old('description', isset($product) ? $product->description : '') }}</textarea>
                </div>

                {{-- Price Row --}}
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-500">
                            Regular Price <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text rounded-start-pill bg-light">$</span>
                            <input type="number"
                                   name="price"
                                   step="0.01"
                                   min="0"
                                   class="form-control @error('price') is-invalid @enderror"
                                   value="{{ old('price', isset($product) ? $product->price : '') }}"
                                   placeholder="0.00"
                                   required>
                        </div>
                        @error('price')
                            <div class="text-danger mt-1" style="font-size:.8rem;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-500">
                            Sale Price
                            <small class="text-muted fw-normal">(optional)</small>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text rounded-start-pill bg-light">$</span>
                            <input type="number"
                                   name="sale_price"
                                   step="0.01"
                                   min="0"
                                   class="form-control"
                                   value="{{ old('sale_price', isset($product) ? $product->sale_price : '') }}"
                                   placeholder="0.00">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-500">
                            Stock Quantity <span class="text-danger">*</span>
                        </label>
                        <input type="number"
                               name="stock_quantity"
                               min="0"
                               class="form-control rounded-pill @error('stock_quantity') is-invalid @enderror"
                               value="{{ old('stock_quantity', isset($product) ? $product->stock_quantity : 0) }}"
                               required>
                        @error('stock_quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>
        </div>

        {{-- Inventory --}}
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <h6 class="mb-0 fw-700">
                    <i class="bi bi-upc-scan me-2 text-accent"></i>
                    Inventory
                </h6>
            </div>
            <div class="admin-card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-500">SKU</label>
                        <input type="text"
                               name="sku"
                               class="form-control rounded-pill @error('sku') is-invalid @enderror"
                               value="{{ old('sku', isset($product) ? $product->sku : '') }}"
                               placeholder="e.g. PRD-001">
                        @error('sku')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-500">Slug</label>
                        <input type="text"
                               name="slug"
                               id="productSlug"
                               class="form-control rounded-pill"
                               value="{{ old('slug', isset($product) ? $product->slug : '') }}"
                               placeholder="Auto-generated from name"
                               style="background:#f8fafc;"
                               readonly>
                        <div class="form-text">Auto-generated from product name</div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- ── RIGHT COLUMN ─────────────────────────────────────────── --}}
    <div class="col-lg-4">

        {{-- Classification --}}
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <h6 class="mb-0 fw-700">
                    <i class="bi bi-folder me-2 text-accent"></i>
                    Classification
                </h6>
            </div>
            <div class="admin-card-body">

                {{-- Category --}}
                <div class="mb-3">
                    <label class="form-label fw-500">
                        Category <span class="text-danger">*</span>
                    </label>
                    <select name="category_id"
                            class="form-select rounded-pill @error('category_id') is-invalid @enderror"
                            required>
                        <option value="">— Select Category —</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}"
                            {{ old('category_id', isset($product) ? $product->category_id : '') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Brand --}}
                <div class="mb-0">
                    <label class="form-label fw-500">Brand</label>
                    <select name="brand_id" class="form-select rounded-pill">
                        <option value="">— No Brand —</option>
                        @foreach($brands as $brand)
                        <option value="{{ $brand->id }}"
                            {{ old('brand_id', isset($product) ? $product->brand_id : '') == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

            </div>
        </div>

        {{-- Main Image --}}
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <h6 class="mb-0 fw-700">
                    <i class="bi bi-image me-2 text-accent"></i>
                    Main Image
                </h6>
            </div>
            <div class="admin-card-body">

                {{-- Show current image if editing --}}
                @if(isset($product) && $product->main_image)
                    <div class="mb-3">
                        <div class="rounded-xl overflow-hidden"
                             style="height:160px;background:#f4f4f8;">
                            <img src="{{ $product->main_image_url }}"
                                 class="w-100 h-100"
                                 style="object-fit:cover;"
                                 id="imagePreview">
                        </div>
                        <small class="text-muted d-block mt-1">
                            Current image — upload new to replace
                        </small>
                    </div>
                @else
                    <div class="mb-3 rounded-xl d-flex align-items-center
                                justify-content-center"
                         style="height:140px;background:#f8fafc;
                                border:2px dashed #e2e8f0;"
                         id="previewBox">
                        <img src=""
                             id="imagePreview"
                             class="w-100 h-100 rounded-xl"
                             style="object-fit:cover;display:none;">
                        <div id="previewPlaceholder" class="text-center text-muted">
                            <i class="bi bi-cloud-upload fs-2 d-block mb-1 opacity-50"></i>
                            <small>Image preview</small>
                        </div>
                    </div>
                @endif

                <input type="file"
                       name="main_image"
                       class="form-control rounded-pill"
                       accept="image/jpeg,image/png,image/webp"
                       onchange="previewImage(this)">
                <div class="form-text mt-1">
                    JPG, PNG or WebP. Max 2MB.
                </div>

            </div>
        </div>

        {{-- Product Flags --}}
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <h6 class="mb-0 fw-700">
                    <i class="bi bi-tags me-2 text-accent"></i>
                    Product Flags
                </h6>
            </div>
            <div class="admin-card-body">

                {{-- Active --}}
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_active"
                           id="is_active"
                           value="1"
                           {{ old('is_active', isset($product) ? $product->is_active : true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">
                        <i class="bi bi-eye text-accent me-1"></i>
                        Active / Visible
                    </label>
                </div>

                {{-- Featured --}}
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_featured"
                           id="is_featured"
                           value="1"
                           {{ old('is_featured', isset($product) ? $product->is_featured : false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_featured">
                        <i class="bi bi-star text-accent me-1"></i>
                        Featured Product
                    </label>
                </div>

                {{-- New Arrival --}}
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_new_arrival"
                           id="is_new_arrival"
                           value="1"
                           {{ old('is_new_arrival', isset($product) ? $product->is_new_arrival : false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_new_arrival">
                        <i class="bi bi-lightning text-accent me-1"></i>
                        New Arrival
                    </label>
                </div>

                {{-- Best Seller --}}
                <div class="form-check form-switch mb-0">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_best_seller"
                           id="is_best_seller"
                           value="1"
                           {{ old('is_best_seller', isset($product) ? $product->is_best_seller : false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_best_seller">
                        <i class="bi bi-fire text-accent me-1"></i>
                        Best Seller
                    </label>
                </div>

            </div>
        </div>

        {{-- Submit Buttons --}}
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-accent py-2 rounded-pill">
                <i class="bi bi-check-lg me-2"></i>
                {{ isset($product) ? 'Update Product' : 'Save Product' }}
            </button>
            <a href="{{ route('admin.products.index') }}"
               class="btn btn-outline-secondary rounded-pill">
                <i class="bi bi-x me-1"></i> Cancel
            </a>
        </div>

    </div>

</div>

@push('scripts')
<script>
    // ── Image Preview ───────────────────────────────────────────
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview     = document.getElementById('imagePreview');
                const placeholder = document.getElementById('previewPlaceholder');

                if (preview) {
                    preview.src          = e.target.result;
                    preview.style.display = 'block';
                }
                if (placeholder) {
                    placeholder.style.display = 'none';
                }
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // ── Auto-generate Slug from Name ────────────────────────────
    const nameInput = document.getElementById('productName');
    const slugInput = document.getElementById('productSlug');

    if (nameInput && slugInput) {
        nameInput.addEventListener('input', function () {
            // Only auto-generate if slug is empty (new product)
            if (!slugInput.dataset.locked) {
                slugInput.value = this.value
                    .toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-')
                    .trim('-');
            }
        });

        // Lock slug if it already has a value (editing existing product)
        if (slugInput.value) {
            slugInput.dataset.locked = 'true';
        }
    }
</script>
@endpush