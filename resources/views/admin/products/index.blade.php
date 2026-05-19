@extends('layouts.admin')
@section('title', 'Products')
@section('page-title', 'Products')

@section('content')

{{-- ── HEADER ───────────────────────────────────────────────── --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0">
        Manage your product catalog
    </p>
    <a href="{{ route('admin.products.create') }}"
       class="btn btn-accent rounded-pill">
        <i class="bi bi-plus-lg me-1"></i> Add New Product
    </a>
</div>

{{-- ── FILTERS ──────────────────────────────────────────────── --}}
<div class="admin-card mb-4">
    <div class="admin-card-body">
        <form action="{{ route('admin.products.index') }}"
              method="GET"
              class="row g-2 align-items-end">

            {{-- Search --}}
            <div class="col-md-4">
                <label class="form-label fw-500 small">Search</label>
                <input type="text"
                       name="search"
                       class="form-control rounded-pill"
                       placeholder="Search by product name..."
                       value="{{ request('search') }}">
            </div>

            {{-- Category --}}
            <div class="col-md-3">
                <label class="form-label fw-500 small">Category</label>
                <select name="category" class="form-select rounded-pill">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}"
                        {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            {{-- Status --}}
            <div class="col-md-2">
                <label class="form-label fw-500 small">Status</label>
                <select name="status" class="form-select rounded-pill">
                    <option value="">All Status</option>
                    <option value="1"
                        {{ request('status') === '1' ? 'selected' : '' }}>
                        Active
                    </option>
                    <option value="0"
                        {{ request('status') === '0' ? 'selected' : '' }}>
                        Inactive
                    </option>
                </select>
            </div>

            {{-- Buttons --}}
            <div class="col-md-3">
                <div class="d-flex gap-2">
                    <button type="submit"
                            class="btn btn-accent rounded-pill flex-grow-1">
                        <i class="bi bi-funnel me-1"></i> Filter
                    </button>
                    <a href="{{ route('admin.products.index') }}"
                       class="btn btn-outline-secondary rounded-pill px-3">
                        <i class="bi bi-x-lg"></i>
                    </a>
                </div>
            </div>

        </form>
    </div>
</div>

{{-- ── PRODUCTS TABLE ───────────────────────────────────────── --}}
<div class="admin-card">

    {{-- Card Header --}}
    <div class="admin-card-header">
        <h6 class="mb-0 fw-700">
            <i class="bi bi-box-seam me-2 text-accent"></i>
            All Products
            <span class="badge bg-light text-muted border ms-2"
                  style="font-size:.75rem;">
                {{ $products->total() }}
            </span>
        </h6>
    </div>

    {{-- Table --}}
    <div class="table-responsive">
        <table class="table admin-table mb-0">
            <thead>
                <tr>
                    <th style="width:50px;">#</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Flags</th>
                    <th style="width:120px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $item)
                <tr>

                    {{-- ID --}}
                    <td class="text-muted" style="font-size:.8rem;">
                        {{ $item->id }}
                    </td>

                    {{-- Product --}}
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            {{-- Image --}}
                            <div class="rounded-xl overflow-hidden flex-shrink-0"
                                 style="width:48px;height:48px;background:#f4f4f8;">
                                <img src="{{ $item->main_image_url }}"
                                     class="w-100 h-100"
                                     style="object-fit:cover;"
                                     onerror="this.src='https://via.placeholder.com/48x48/f4f4f8/999?text=?'">
                            </div>
                            {{-- Info --}}
                            <div>
                                <div class="fw-600" style="font-size:.875rem;">
                                    {{ Str::limit($item->name, 30) }}
                                </div>
                                <div class="text-muted" style="font-size:.75rem;">
                                    SKU: {{ $item->sku ?? '—' }}
                                </div>
                            </div>
                        </div>
                    </td>

                    {{-- Category --}}
                    <td>
                        <span class="badge bg-light text-dark border"
                              style="font-size:.78rem;">
                            {{ $item->category->name ?? '—' }}
                        </span>
                    </td>

                    {{-- Brand --}}
                    <td class="text-muted" style="font-size:.85rem;">
                        {{ $item->brand->name ?? '—' }}
                    </td>

                    {{-- Price --}}
                    <td>
                        <div class="fw-700" style="font-size:.9rem;">
                            ${{ number_format($item->current_price, 2) }}
                        </div>
                        @if($item->sale_price)
                        <div class="text-muted text-decoration-line-through"
                             style="font-size:.75rem;">
                            ${{ number_format($item->price, 2) }}
                        </div>
                        @endif
                    </td>

                    {{-- Stock --}}
                    <td>
                        @if($item->stock_quantity <= 0)
                            <span class="fw-700 text-danger">
                                {{ $item->stock_quantity }}
                            </span>
                            <div style="font-size:.72rem;color:#ef4444;">
                                Out of stock
                            </div>
                        @elseif($item->stock_quantity <= 10)
                            <span class="fw-700 text-warning">
                                {{ $item->stock_quantity }}
                            </span>
                            <div style="font-size:.72rem;color:#f59e0b;">
                                Low stock
                            </div>
                        @else
                            <span class="fw-700 text-success">
                                {{ $item->stock_quantity }}
                            </span>
                        @endif
                    </td>

                    {{-- Status --}}
                    <td>
                        @if($item->is_active)
                            <span class="badge rounded-pill"
                                  style="background:#dcfce7;color:#16a34a;
                                         border:1px solid #bbf7d0;
                                         font-size:.75rem;">
                                <i class="bi bi-circle-fill me-1"
                                   style="font-size:.45rem;"></i>
                                Active
                            </span>
                        @else
                            <span class="badge rounded-pill"
                                  style="background:#fee2e2;color:#dc2626;
                                         border:1px solid #fecaca;
                                         font-size:.75rem;">
                                <i class="bi bi-circle-fill me-1"
                                   style="font-size:.45rem;"></i>
                                Inactive
                            </span>
                        @endif
                    </td>

                    {{-- Flags --}}
                    <td>
                        <div class="d-flex flex-wrap gap-1">
                            @if($item->is_featured)
                            <span class="badge rounded-pill"
                                  style="background:#fef3c7;color:#d97706;
                                         border:1px solid #fde68a;
                                         font-size:.7rem;">
                                ⭐ Featured
                            </span>
                            @endif
                            @if($item->is_new_arrival)
                            <span class="badge rounded-pill"
                                  style="background:#dbeafe;color:#2563eb;
                                         border:1px solid #bfdbfe;
                                         font-size:.7rem;">
                                🆕 New
                            </span>
                            @endif
                            @if($item->is_best_seller)
                            <span class="badge rounded-pill"
                                  style="background:#fee2e2;color:#dc2626;
                                         border:1px solid #fecaca;
                                         font-size:.7rem;">
                                🔥 Hot
                            </span>
                            @endif
                        </div>
                    </td>

                    {{-- Actions --}}
                    <td>
                        <div class="d-flex gap-1">
                            {{-- Edit --}}
                            <a href="{{ route('admin.products.edit', $item) }}"
                               class="btn btn-sm btn-outline-primary rounded-pill px-3"
                               title="Edit Product">
                                <i class="bi bi-pencil"></i>
                            </a>
                            {{-- Delete --}}
                            <form action="{{ route('admin.products.destroy', $item) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete {{ addslashes($item->name) }}? This cannot be undone.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                        title="Delete Product">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center py-5">
                        <i class="bi bi-box-seam fs-1 d-block mb-3 text-muted opacity-50"></i>
                        <h6 class="text-muted">No products found</h6>
                        <p class="text-muted small mb-3">
                            Try adjusting your filters or add a new product.
                        </p>
                        <a href="{{ route('admin.products.create') }}"
                           class="btn btn-accent btn-sm rounded-pill">
                            <i class="bi bi-plus-lg me-1"></i>
                            Add First Product
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($products->hasPages())
    <div class="p-4 border-top d-flex justify-content-between align-items-center
                flex-wrap gap-2"
         style="border-color:#f1f5f9!important;">
        <div class="text-muted small">
            Showing
            <strong>{{ $products->firstItem() }}</strong>
            to
            <strong>{{ $products->lastItem() }}</strong>
            of
            <strong>{{ $products->total() }}</strong>
            products
        </div>
        {{ $products->onEachSide(1)->links('vendor.pagination.admin') }}
    </div>
    @else
    <div class="p-4 border-top text-muted small"
         style="border-color:#f1f5f9!important;">
        Total: <strong>{{ $products->total() }}</strong> products
    </div>
    @endif

</div>

@endsection
