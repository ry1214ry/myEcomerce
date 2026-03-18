@extends('layouts.admin')
@section('title','Edit Brand')
@section('page-title','Edit Brand')
@section('content')
<div class="row justify-content-center"><div class="col-lg-5">
    <div class="admin-card"><div class="admin-card-header"><h6 class="mb-0 fw-700">Edit Brand</h6></div>
    <div class="admin-card-body">
        <form action="{{ route('admin.brands.update', $brand) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="mb-3"><label class="form-label fw-500">Name *</label>
                <input type="text" name="name" class="form-control rounded-pill" value="{{ old('name', $brand->name) }}" required></div>
            <div class="mb-3"><label class="form-label fw-500">Description</label>
                <textarea name="description" class="form-control rounded-3" rows="3">{{ old('description', $brand->description) }}</textarea></div>
            <div class="mb-3">
                @if($brand->logo)<img src="{{ $brand->logo_url }}" class="rounded-xl mb-2" style="max-height:80px;">@endif
                <input type="file" name="logo" class="form-control rounded-pill" accept="image/*"></div>
            <div class="mb-4 form-check form-switch">
                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ $brand->is_active ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Active</label></div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-accent flex-grow-1">Update Brand</button>
                <a href="{{ route('admin.brands.index') }}" class="btn btn-outline-secondary rounded-pill">Cancel</a>
            </div>
        </form>
    </div></div>
</div></div>
@endsection