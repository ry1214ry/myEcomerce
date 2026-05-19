@extends('layouts.admin')
@section('title', 'Add Product')
@section('page-title', 'Add New Product')

@section('content')

<div class="mb-3">
    <a href="{{ route('admin.products.index') }}"
       class="btn btn-outline-secondary rounded-pill btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Back to Products
    </a>
</div>

<form action="{{ route('admin.products.store') }}"
      method="POST"
      enctype="multipart/form-data">
    @csrf
    @include('admin.products._form')
</form>

@endsection