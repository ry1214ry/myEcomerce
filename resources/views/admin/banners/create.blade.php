@extends('layouts.admin')
@section('title','Add Banner')
@section('page-title','Add Banner')
@section('content')
<div class="row justify-content-center"><div class="col-lg-7">
    <div class="admin-card">
        <div class="admin-card-header"><h6 class="mb-0 fw-700">New Banner</h6></div>
        <div class="admin-card-body">
            <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label fw-500">Title *</label>
                        <input type="text" name="title" class="form-control rounded-pill" value="{{ old('title') }}" required></div>
                    <div class="col-md-6"><label class="form-label fw-500">Subtitle</label>
                        <input type="text" name="subtitle" class="form-control rounded-pill" value="{{ old('subtitle') }}"></div>
                    <div class="col-12"><label class="form-label fw-500">Description</label>
                        <textarea name="description" class="form-control rounded-3" rows="2">{{ old('description') }}</textarea></div>
                    <div class="col-md-6"><label class="form-label fw-500">Button Text</label>
                        <input type="text" name="button_text" class="form-control rounded-pill" value="{{ old('button_text') }}"></div>
                    <div class="col-md-6"><label class="form-label fw-500">Button Link</label>
                        <input type="text" name="button_link" class="form-control rounded-pill" value="{{ old('button_link') }}"></div>
                    <div class="col-md-6"><label class="form-label fw-500">Sort Order</label>
                        <input type="number" name="sort_order" class="form-control rounded-pill" value="{{ old('sort_order', 0) }}" min="0"></div>
                    <div class="col-md-6 d-flex align-items-end"><div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                        <label class="form-check-label">Active</label></div></div>
                    <div class="col-12"><label class="form-label fw-500">Banner Image * (recommended: 1920×800px)</label>
                        <input type="file" name="image" class="form-control rounded-pill @error('image') is-invalid @enderror" accept="image/*" required>
                        @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                </div>
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-accent flex-grow-1">Save Banner</button>
                    <a href="{{ route('admin.banners.index') }}" class="btn btn-outline-secondary rounded-pill">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div></div>
@endsection