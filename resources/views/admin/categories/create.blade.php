@extends('layouts.admin')
@section('title','Add Category')
@section('page-title','Add Category')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="admin-card">
            <div class="admin-card-header"><h6 class="mb-0 fw-700">New Category</h6></div>
            <div class="admin-card-body">
                <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('admin.categories._form')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection