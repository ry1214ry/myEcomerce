@extends('layouts.admin')
@section('title', 'Customers')
@section('page-title', 'Customers')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0">
        Manage registered customers and review account activity
    </p>
    <span class="badge bg-light text-muted border rounded-pill px-3 py-2">
        {{ $users->total() }} total customers
    </span>
</div>

<div class="admin-card mb-4">
    <div class="admin-card-body">
        <form action="{{ route('admin.users.index') }}"
              method="GET"
              class="row g-2 align-items-end">
            <div class="col-md-9">
                <label class="form-label fw-500 small">Search</label>
                <input type="text"
                       name="search"
                       class="form-control rounded-pill"
                       placeholder="Search by customer name or email..."
                       value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <div class="d-flex gap-2">
                    <button type="submit"
                            class="btn btn-accent rounded-pill flex-grow-1">
                        <i class="bi bi-search me-1"></i> Search
                    </button>
                    <a href="{{ route('admin.users.index') }}"
                       class="btn btn-outline-secondary rounded-pill px-3">
                        <i class="bi bi-x-lg"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-header">
        <h6 class="mb-0 fw-700">
            <i class="bi bi-people me-2 text-accent"></i>
            Customer Directory
            <span class="badge bg-light text-muted border ms-2"
                  style="font-size:.75rem;">
                {{ $users->total() }}
            </span>
        </h6>
    </div>

    <div class="table-responsive">
        <table class="table admin-table mb-0">
            <thead>
                <tr>
                    <th style="width:50px;">#</th>
                    <th>Customer</th>
                    <th>Contact</th>
                    <th>Orders</th>
                    <th>Location</th>
                    <th>Joined</th>
                    <th style="width:110px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td class="text-muted" style="font-size:.8rem;">
                        {{ $user->id }}
                    </td>

                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                                 style="width:44px;height:44px;background:#f3ead8;
                                        color:#9a7841;font-size:.9rem;font-weight:700;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="fw-600" style="font-size:.875rem;">
                                    {{ $user->name }}
                                </div>
                                <div class="text-muted" style="font-size:.75rem;">
                                    {{ $user->email }}
                                </div>
                            </div>
                        </div>
                    </td>

                    <td>
                        <div class="fw-500" style="font-size:.85rem;">
                            {{ $user->phone ?: '-' }}
                        </div>
                        <div class="text-muted" style="font-size:.75rem;">
                            Customer account
                        </div>
                    </td>

                    <td>
                        <span class="badge rounded-pill"
                              style="background:#eff6ff;color:#2563eb;
                                     border:1px solid #bfdbfe;font-size:.75rem;">
                            {{ $user->orders_count }} order{{ $user->orders_count === 1 ? '' : 's' }}
                        </span>
                    </td>

                    <td class="text-muted" style="font-size:.85rem;">
                        {{ implode(', ', array_filter([$user->city, $user->country])) ?: '-' }}
                    </td>

                    <td>
                        <div class="fw-500" style="font-size:.85rem;">
                            {{ $user->created_at->format('M j, Y') }}
                        </div>
                        <div class="text-muted" style="font-size:.75rem;">
                            {{ $user->created_at->diffForHumans() }}
                        </div>
                    </td>

                    <td>
                        <form action="{{ route('admin.users.destroy', $user) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Delete {{ addslashes($user->name) }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                    title="Delete customer">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5">
                        <i class="bi bi-people fs-1 d-block mb-3 text-muted opacity-50"></i>
                        <h6 class="text-muted">No customers found</h6>
                        <p class="text-muted small mb-0">
                            Try a different search or wait for new registrations.
                        </p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($users->hasPages())
    <div class="p-4 border-top d-flex justify-content-between align-items-center flex-wrap gap-2"
         style="border-color:#f1f5f9!important;">
        <div class="text-muted small">
            Showing
            <strong>{{ $users->firstItem() }}</strong>
            to
            <strong>{{ $users->lastItem() }}</strong>
            of
            <strong>{{ $users->total() }}</strong>
            customers
        </div>
        {{ $users->onEachSide(1)->links('vendor.pagination.admin') }}
    </div>
    @else
    <div class="p-4 border-top text-muted small"
         style="border-color:#f1f5f9!important;">
        Total: <strong>{{ $users->total() }}</strong> customers
    </div>
    @endif
</div>

@endsection
