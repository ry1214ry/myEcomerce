@extends('layouts.admin')
@section('title','Add Brand')
@section('page-title','Add Brand')
@section('content')
<div class="row justify-content-center"><div class="col-lg-5">
    <div class="admin-card"><div class="admin-card-header"><h6 class="mb-0 fw-700">New Brand</h6></div>
    <div class="admin-card-body">
        <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3"><label class="form-label fw-500">Name *</label>
                <input type="text" name="name" class="form-control rounded-pill" value="{{ old('name') }}" required></div>
            <div class="mb-3"><label class="form-label fw-500">Description</label>
                <textarea name="description" class="form-control rounded-3" rows="3">{{ old('description') }}</textarea></div>
            <div class="mb-3"><label class="form-label fw-500">Logo</label>
                <input type="file" name="logo" class="form-control rounded-pill" accept="image/*"></div>
            <div class="mb-4 form-check form-switch">
                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" checked>
                <label class="form-check-label" for="is_active">Active</label></div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-accent flex-grow-1">Save Brand</button>
                <a href="{{ route('admin.brands.index') }}" class="btn btn-outline-secondary rounded-pill">Cancel</a>
            </div>
        </form>
    </div></div>
</div></div>
@endsection