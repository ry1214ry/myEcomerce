@extends('layouts.admin')
@section('title','Brands')
@section('page-title','Brands')
@section('content')
<div class="d-flex justify-content-between mb-4">
    <p class="text-muted mb-0">Manage product brands</p>
    <a href="{{ route('admin.brands.create') }}" class="btn btn-accent"><i class="bi bi-plus-lg me-1"></i>Add Brand</a>
</div>
<div class="admin-card">
    <div class="table-responsive">
        <table class="table admin-table mb-0">
            <thead><tr><th>Brand</th><th>Products</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($brands as $brand)
                <tr>
                    <td class="fw-600">{{ $brand->name }}</td>
                    <td><span class="badge bg-light text-dark border">{{ $brand->products_count }}</span></td>
                    <td><span class="badge {{ $brand->is_active ? 'bg-success' : 'bg-danger' }} rounded-pill">{{ $brand->is_active ? 'Active' : 'Inactive' }}</span></td>
                    <td>
                        <a href="{{ route('admin.brands.edit', $brand) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 me-1">Edit</a>
                        <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger rounded-pill px-3">Del</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center text-muted py-4">No brands yet</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4 border-top">{{ $brands->links() }}</div>
</div>
@endsection