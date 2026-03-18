@extends('layouts.admin')
@section('title','Banners')
@section('page-title','Hero Banners')
@section('content')
<div class="d-flex justify-content-between mb-4">
    <p class="text-muted mb-0">Manage homepage hero banners</p>
    <a href="{{ route('admin.banners.create') }}" class="btn btn-accent"><i class="bi bi-plus-lg me-1"></i>Add Banner</a>
</div>
<div class="row g-4">
    @forelse($banners as $banner)
    <div class="col-md-6 col-lg-4">
        <div class="admin-card h-100">
            <div class="rounded-top overflow-hidden" style="height:160px;">
                <img src="{{ $banner->image_url }}" class="w-100 h-100" style="object-fit:cover;">
            </div>
            <div class="p-3">
                <h6 class="fw-700">{{ $banner->title }}</h6>
                @if($banner->subtitle)<p class="text-muted small mb-1">{{ $banner->subtitle }}</p>@endif
                <div class="d-flex justify-content-between align-items-center mt-2">
                    <span class="badge {{ $banner->is_active ? 'bg-success' : 'bg-danger' }} rounded-pill">{{ $banner->is_active ? 'Active' : 'Inactive' }}</span>
                    <div class="d-flex gap-1">
                        <a href="{{ route('admin.banners.edit', $banner) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">Edit</a>
                        <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" onsubmit="return confirm('Delete?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger rounded-pill px-3">Del</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5 text-muted">No banners yet. <a href="{{ route('admin.banners.create') }}">Add one!</a></div>
    @endforelse
</div>
@endsection