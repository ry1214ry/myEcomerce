@extends('layouts.admin')
@section('title','Customers')
@section('page-title','Customers')
@section('content')
<div class="admin-card mb-4">
    <div class="admin-card-body">
        <form action="{{ route('admin.users.index') }}" method="GET" class="row g-2 align-items-end">
            <div class="col-md-8">
                <input type="text" name="search" class="form-control rounded-pill" placeholder="Search by name or email..." value="{{ request('search') }}">
            </div>
            <div class="col-md-4">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-accent rounded-pill flex-grow-1">Search</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary rounded-pill">Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="admin-card">
    <div class="table-responsive">
        <table class="table admin-table mb-0">
            <thead><tr><th>Customer</th><th>Phone</th><th>Orders</th><th>Joined</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>
                        <div class="fw-600" style="font-size:.875rem;">{{ $user->name }}</div>
                        <div class="text-muted" style="font-size:.75rem;">{{ $user->email }}</div>
                    </td>
                    <td class="text-muted">{{ $user->phone ?? '—' }}</td>
                    <td><span class="badge bg-light text-dark border">{{ $user->orders_count }}</span></td>
                    <td class="text-muted" style="font-size:.85rem;">{{ $user->created_at->format('M j, Y') }}</td>
                    <td>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete user?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger rounded-pill px-3">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-4">No customers found</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4 border-top">{{ $users->links() }}</div>
</div>
@endsection