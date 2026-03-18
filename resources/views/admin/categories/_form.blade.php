<div class="mb-3">
    <label class="form-label fw-500">Name *</label>
    <input type="text" name="name" class="form-control rounded-pill @error('name') is-invalid @enderror"
           value="{{ old('name', $category->name ?? '') }}" required>
    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label class="form-label fw-500">Description</label>
    <textarea name="description" class="form-control rounded-3" rows="3">{{ old('description', $category->description ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label class="form-label fw-500">Sort Order</label>
    <input type="number" name="sort_order" class="form-control rounded-pill"
           value="{{ old('sort_order', $category->sort_order ?? 0) }}" min="0">
</div>
<div class="mb-3">
    @isset($category) @if($category->image)
        <img src="{{ $category->image_url }}" class="rounded-xl mb-2" style="max-height:120px;">
    @endif @endisset
    <input type="file" name="image" class="form-control rounded-pill" accept="image/*">
</div>
<div class="mb-4 form-check form-switch">
    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
           {{ old('is_active', isset($category) ? $category->is_active : true) ? 'checked' : '' }}>
    <label class="form-check-label" for="is_active">Active</label>
</div>
<div class="d-flex gap-2">
    <button type="submit" class="btn btn-accent flex-grow-1">Save Category</button>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary rounded-pill">Cancel</a>
</div>