@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- ── STATS ROW ──────────────────────────────────────────────── --}}
<div class="row g-4 mb-4">

    <div class="col-sm-6 col-xl-3">
        <div class="stat-card accent">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <div class="stat-label">Total Revenue</div>
                    <div class="stat-number" style="color:#c9a96e;">
                        ${{ number_format($totalRevenue, 2) }}
                    </div>
                </div>
                <div class="stat-icon rounded-circle"
                     style="background:rgba(201,169,110,.12);width:52px;height:52px;">
                    <i class="bi bi-currency-dollar fs-4" style="color:#c9a96e;"></i>
                </div>
            </div>
            <div style="font-size:.78rem;color:#6b7280;">
                <i class="bi bi-check-circle text-success me-1"></i>
                From all paid orders
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="stat-card primary">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <div class="stat-label">Total Orders</div>
                    <div class="stat-number text-primary">
                        {{ number_format($totalOrders) }}
                    </div>
                </div>
                <div class="stat-icon rounded-circle"
                     style="background:rgba(59,130,246,.12);width:52px;height:52px;">
                    <i class="bi bi-cart-check text-primary fs-4"></i>
                </div>
            </div>
            <div style="font-size:.78rem;color:#6b7280;">
                <i class="bi bi-bag me-1"></i>
                All orders placed
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="stat-card success">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <div class="stat-label">Total Products</div>
                    <div class="stat-number text-success">
                        {{ number_format($totalProducts) }}
                    </div>
                </div>
                <div class="stat-icon rounded-circle"
                     style="background:rgba(34,197,94,.12);width:52px;height:52px;">
                    <i class="bi bi-box-seam text-success fs-4"></i>
                </div>
            </div>
            <div style="font-size:.78rem;color:#6b7280;">
                <i class="bi bi-boxes me-1"></i>
                Products in catalog
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="stat-card info">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <div class="stat-label">Total Customers</div>
                    <div class="stat-number text-info">
                        {{ number_format($totalUsers) }}
                    </div>
                </div>
                <div class="stat-icon rounded-circle"
                     style="background:rgba(6,182,212,.12);width:52px;height:52px;">
                    <i class="bi bi-people text-info fs-4"></i>
                </div>
            </div>
            <div style="font-size:.78rem;color:#6b7280;">
                <i class="bi bi-person-check me-1"></i>
                Registered customers
            </div>
        </div>
    </div>

</div>

{{-- ── QUICK ACTIONS ───────────────────────────────────────────── --}}
<div class="row g-3 mb-4">
    <div class="col-12">
        <div class="admin-card">
            <div class="admin-card-header">
                <h6 class="mb-0 fw-700">
                    <i class="bi bi-lightning-charge me-2 text-accent"></i>Quick Actions
                </h6>
            </div>
            <div class="admin-card-body d-flex flex-wrap gap-2">
                <a href="{{ route('admin.products.create') }}"
                   class="btn btn-accent rounded-pill">
                    <i class="bi bi-plus-lg me-1"></i>Add Product
                </a>
                <a href="{{ route('admin.categories.create') }}"
                   class="btn btn-outline-secondary rounded-pill">
                    <i class="bi bi-tags me-1"></i>Add Category
                </a>
                <a href="{{ route('admin.brands.create') }}"
                   class="btn btn-outline-secondary rounded-pill">
                    <i class="bi bi-award me-1"></i>Add Brand
                </a>
                <a href="{{ route('admin.banners.create') }}"
                   class="btn btn-outline-secondary rounded-pill">
                    <i class="bi bi-image me-1"></i>Add Banner
                </a>
                <a href="{{ route('admin.orders.index') }}"
                   class="btn btn-outline-secondary rounded-pill">
                    <i class="bi bi-cart-check me-1"></i>View Orders
                </a>
                <a href="{{ route('admin.users.index') }}"
                   class="btn btn-outline-secondary rounded-pill">
                    <i class="bi bi-people me-1"></i>View Customers
                </a>
                <a href="{{ route('home') }}" target="_blank"
                   class="btn btn-outline-secondary rounded-pill">
                    <i class="bi bi-arrow-up-right-square me-1"></i>View Store
                </a>
            </div>
        </div>
    </div>
</div>

{{-- ── ORDER STATUS SUMMARY ────────────────────────────────────── --}}
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="admin-card">
            <div class="admin-card-header">
                <h6 class="mb-0 fw-700">
                    <i class="bi bi-pie-chart me-2 text-accent"></i>Orders by Status
                </h6>
            </div>
            <div class="admin-card-body">
                <div class="row g-3">
                    @php
                        $statuses = [
                            [
                                'label' => 'Pending',
                                'value' => 'pending',
                                'color' => '#f59e0b',
                                'bg'    => '#fef3c7',
                                'icon'  => 'bi-hourglass-split',
                            ],
                            [
                                'label' => 'Processing',
                                'value' => 'processing',
                                'color' => '#3b82f6',
                                'bg'    => '#dbeafe',
                                'icon'  => 'bi-arrow-repeat',
                            ],
                            [
                                'label' => 'Shipped',
                                'value' => 'shipped',
                                'color' => '#8b5cf6',
                                'bg'    => '#ede9fe',
                                'icon'  => 'bi-truck',
                            ],
                            [
                                'label' => 'Delivered',
                                'value' => 'delivered',
                                'color' => '#22c55e',
                                'bg'    => '#dcfce7',
                                'icon'  => 'bi-check-circle',
                            ],
                            [
                                'label' => 'Cancelled',
                                'value' => 'cancelled',
                                'color' => '#ef4444',
                                'bg'    => '#fee2e2',
                                'icon'  => 'bi-x-circle',
                            ],
                        ];
                    @endphp

                    @foreach($statuses as $status)
                    @php
                        $count = \App\Models\Order::where('status', $status['value'])->count();
                    @endphp
                    <div class="col-6 col-md-4 col-lg-2">
                        <a href="{{ route('admin.orders.index') }}?status={{ $status['value'] }}"
                           class="d-block text-decoration-none p-3 rounded-xl text-center"
                           style="background:{{ $status['bg'] }};
                                  border:1.5px solid {{ $status['color'] }}30;
                                  transition:all .25s;"
                           onmouseover="this.style.transform='translateY(-4px)';
                                        this.style.boxShadow='0 8px 24px {{ $status['color'] }}25'"
                           onmouseout="this.style.transform='translateY(0)';
                                       this.style.boxShadow='none'">
                            <i class="bi {{ $status['icon'] }} d-block mb-1 fs-4"
                               style="color:{{ $status['color'] }};"></i>
                            <div class="fw-700"
                                 style="font-size:1.6rem;color:{{ $status['color'] }};">
                                {{ $count }}
                            </div>
                            <div class="fw-600"
                                 style="font-size:.78rem;color:{{ $status['color'] }};">
                                {{ $status['label'] }}
                            </div>
                        </a>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── RECENT ORDERS + TOP PRODUCTS ───────────────────────────── --}}
<div class="row g-4">

    {{-- Recent Orders --}}
    <div class="col-lg-8">
        <div class="admin-card h-100">
            <div class="admin-card-header">
                <h6 class="mb-0 fw-700">
                    <i class="bi bi-clock-history me-2 text-accent"></i>Recent Orders
                </h6>
                <a href="{{ route('admin.orders.index') }}"
                   class="btn btn-sm btn-outline-secondary rounded-pill">
                    View All
                </a>
            </div>
            <div class="table-responsive">
                <table class="table admin-table mb-0">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $order)
                        <tr>
                            <td>
                                <span class="fw-700" style="color:#c9a96e;">
                                    {{ $order->order_number }}
                                </span>
                            </td>
                            <td>
                                <div class="fw-500" style="font-size:.85rem;">
                                    {{ $order->user->name ?? '—' }}
                                </div>
                                <div class="text-muted" style="font-size:.75rem;">
                                    {{ $order->user->email ?? '' }}
                                </div>
                            </td>
                            <td>
                                <span class="fw-700">
                                    ${{ number_format($order->total, 2) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge rounded-pill
                                    {{ $order->payment_status === 'paid'
                                        ? 'bg-success'
                                        : 'bg-warning text-dark' }}">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </td>
                            <td>{!! $order->status_badge !!}</td>
                            <td class="text-muted" style="font-size:.82rem;">
                                {{ $order->created_at->format('M j, Y') }}
                            </td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order) }}"
                                   class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                    View
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2 opacity-50"></i>
                                No orders yet
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Top Products --}}
    <div class="col-lg-4">
        <div class="admin-card h-100">
            <div class="admin-card-header">
                <h6 class="mb-0 fw-700">
                    <i class="bi bi-trophy me-2 text-accent"></i>Top Products
                </h6>
                <a href="{{ route('admin.products.index') }}"
                   class="btn btn-sm btn-outline-secondary rounded-pill">
                    View All
                </a>
            </div>
            <div>
                @forelse($topProducts as $i => $product)
                <div class="d-flex align-items-center gap-3 px-4 py-3 border-bottom"
                     style="border-color:#f1f5f9!important;">

                    {{-- Rank --}}
                    <div class="fw-700 text-muted flex-shrink-0"
                         style="width:22px;font-size:.8rem;text-align:center;">
                        {{ $i + 1 }}
                    </div>

                    {{-- Image --}}
                    <div class="rounded-xl overflow-hidden flex-shrink-0"
                         style="width:46px;height:46px;background:#f4f4f8;">
                        <img src="{{ $product->main_image_url }}"
                             class="w-100 h-100"
                             style="object-fit:cover;"
                             onerror="this.src='https://via.placeholder.com/46x46/f4f4f8/999?text=?'">
                    </div>

                    {{-- Info --}}
                    <div class="flex-grow-1 overflow-hidden">
                        <div class="fw-500 text-truncate" style="font-size:.84rem;">
                            {{ $product->name }}
                        </div>
                        <div class="text-muted" style="font-size:.75rem;">
                            <i class="bi bi-eye me-1"></i>
                            {{ number_format($product->views) }} views
                        </div>
                    </div>

                    {{-- Price --}}
                    <div class="fw-700 text-nowrap flex-shrink-0"
                         style="font-size:.875rem;color:#1a1a2e;">
                        ${{ number_format($product->current_price, 2) }}
                    </div>

                </div>
                @empty
                <div class="text-center py-5 text-muted">
                    <i class="bi bi-box-seam fs-2 d-block mb-2 opacity-50"></i>
                    No products yet
                </div>
                @endforelse
            </div>

            {{-- Add Product CTA --}}
            <div class="p-3 text-center border-top" style="border-color:#f1f5f9!important;">
                <a href="{{ route('admin.products.create') }}"
                   class="btn btn-accent btn-sm rounded-pill px-4">
                    <i class="bi bi-plus-lg me-1"></i>Add New Product
                </a>
            </div>
        </div>
    </div>

</div>

{{-- ── RECENT CUSTOMERS ────────────────────────────────────────── --}}
<div class="row g-4 mt-1">
    <div class="col-12">
        <div class="admin-card">
            <div class="admin-card-header">
                <h6 class="mb-0 fw-700">
                    <i class="bi bi-people me-2 text-accent"></i>Recent Customers
                </h6>
                <a href="{{ route('admin.users.index') }}"
                   class="btn btn-sm btn-outline-secondary rounded-pill">
                    View All
                </a>
            </div>
            <div class="table-responsive">
                <table class="table admin-table mb-0">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Phone</th>
                            <th>Location</th>
                            <th>Joined</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $recentUsers = \App\Models\User::where('role','customer')
                                ->latest()->take(5)->get();
                        @endphp
                        @forelse($recentUsers as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle d-flex align-items-center
                                                justify-content-center text-white fw-bold
                                                flex-shrink-0"
                                         style="width:36px;height:36px;
                                                background:#c9a96e;font-size:.85rem;">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-500" style="font-size:.875rem;">
                                            {{ $user->name }}
                                        </div>
                                        <div class="text-muted" style="font-size:.75rem;">
                                            {{ $user->email }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-muted" style="font-size:.875rem;">
                                {{ $user->phone ?? '—' }}
                            </td>
                            <td class="text-muted" style="font-size:.875rem;">
                                {{ implode(', ', array_filter([$user->city, $user->country])) ?: '—' }}
                            </td>
                            <td class="text-muted" style="font-size:.82rem;">
                                {{ $user->created_at->format('M j, Y') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">
                                No customers yet
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection