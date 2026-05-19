@extends('layouts.admin')
@section('title','Categories')
@section('page-title','Categories')
@section('content')
<div class="d-flex justify-content-between mb-4">
    <p class="text-muted mb-0">Manage product categories</p>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-accent"><i class="bi bi-plus-lg me-1"></i>Add Category</a>
</div>
<div class="admin-card">
    <div class="table-responsive">
        <table class="table admin-table mb-0">
            <thead><tr><th>Name</th><th>Products</th><th>Status</th><th>Order</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($categories as $cat)
                <tr>
                    <td class="fw-600">{{ $cat->name }}</td>
                    <td><span class="badge bg-light text-dark border">{{ $cat->products_count }}</span></td>
                    <td><span class="badge {{ $cat->is_active ? 'bg-success' : 'bg-danger' }} rounded-pill">{{ $cat->is_active ? 'Active' : 'Inactive' }}</span></td>
                    <td>{{ $cat->sort_order }}</td>
                    <td>
                        <a href="{{ route('admin.categories.edit', $cat) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 me-1">Edit</a>
                        <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger rounded-pill px-3">Del</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-4">No categories yet</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($categories->hasPages())
    <div class="p-4 border-top d-flex justify-content-end">
        {{ $categories->onEachSide(1)->links('vendor.pagination.admin') }}
    </div>
    @endif
</div>
@endsection
