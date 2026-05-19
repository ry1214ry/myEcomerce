@extends('layouts.admin')
@section('title', 'Orders')
@section('page-title', 'Orders')

@section('content')
<div class="admin-card mb-4">
    <div class="admin-card-body">
        <form action="{{ route('admin.orders.index') }}" method="GET" class="row g-2 align-items-end">
            <div class="col-md-5">
                <input type="text" name="search" class="form-control rounded-pill" placeholder="Search order number..." value="{{ request('search') }}">
            </div>
            <div class="col-md-4">
                <select name="status" class="form-select rounded-pill">
                    <option value="">All Statuses</option>
                    @foreach(['pending','processing','shipped','delivered','cancelled'] as $s)
                    <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-accent rounded-pill flex-grow-1">Filter</button>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary rounded-pill">Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="table admin-table mb-0">
            <thead><tr>
                <th>Order #</th><th>Customer</th><th>Items</th><th>Total</th><th>Payment</th><th>Status</th><th>Date</th><th>Actions</th>
            </tr></thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td class="fw-700 text-accent">{{ $order->order_number }}</td>
                    <td>
                        <div class="fw-500" style="font-size:.875rem;">{{ $order->shipping_name }}</div>
                        <div class="text-muted" style="font-size:.75rem;">{{ $order->shipping_email }}</div>
                    </td>
                    <td>{{ $order->items->count() }}</td>
                    <td class="fw-700">${{ number_format($order->total, 2) }}</td>
                    <td><span class="badge {{ $order->payment_status == 'paid' ? 'bg-success' : 'bg-warning text-dark' }} rounded-pill">{{ ucfirst($order->payment_status) }}</span></td>
                    <td>{!! $order->status_badge !!}</td>
                    <td class="text-muted" style="font-size:.85rem;">{{ $order->created_at->format('M j, Y') }}</td>
                    <td><a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">View</a></td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center py-5 text-muted">No orders found</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($orders->hasPages())
    <div class="p-4 border-top d-flex justify-content-end">
        {{ $orders->onEachSide(1)->links('vendor.pagination.admin') }}
    </div>
    @endif
</div>
@endsection
