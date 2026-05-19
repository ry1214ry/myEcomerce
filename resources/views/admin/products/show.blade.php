@extends('layouts.admin')
@section('title', $product->name)
@section('page-title', 'Product Detail')

@section('content')

<div class="mb-3 d-flex gap-2">
    <a href="{{ route('admin.products.index') }}"
       class="btn btn-outline-secondary rounded-pill btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Back
    </a>
    <a href="{{ route('admin.products.edit', $product) }}"
       class="btn btn-accent btn-sm rounded-pill">
        <i class="bi bi-pencil me-1"></i> Edit Product
    </a>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="admin-card">
            <div class="rounded-xl overflow-hidden"
                 style="height:280px;background:#f4f4f8;">
                <img src="{{ $product->main_image_url }}"
                     class="w-100 h-100" style="object-fit:cover;">
            </div>
            <div class="p-4">
                <h5 class="fw-700">{{ $product->name }}</h5>
                <p class="text-muted small">{{ $product->short_description }}</p>
                <div class="d-flex gap-2 flex-wrap mt-2">
                    @if($product->is_active)
                        <span class="badge bg-success rounded-pill">Active</span>
                    @else
                        <span class="badge bg-danger rounded-pill">Inactive</span>
                    @endif
                    @if($product->is_featured)
                        <span class="badge bg-warning text-dark rounded-pill">Featured</span>
                    @endif
                    @if($product->is_new_arrival)
                        <span class="badge bg-info rounded-pill">New Arrival</span>
                    @endif
                    @if($product->is_best_seller)
                        <span class="badge bg-danger rounded-pill">Best Seller</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <h6 class="mb-0 fw-700">Product Details</h6>
            </div>
            <div class="admin-card-body">
                <div class="row g-3">
                    @foreach([
                        ['Category',   $product->category->name ?? '—'],
                        ['Brand',      $product->brand->name ?? '—'],
                        ['SKU',        $product->sku ?? '—'],
                        ['Price',      '$'.number_format($product->price, 2)],
                        ['Sale Price', $product->sale_price ? '$'.number_format($product->sale_price,2) : '—'],
                        ['Stock',      $product->stock_quantity],
                        ['Views',      number_format($product->views)],
                        ['Rating',     $product->rating . ' (' . $product->reviews_count . ' reviews)'],
                    ] as $detail)
                    <div class="col-md-6">
                        <div class="p-3 rounded-xl" style="background:#f8fafc;">
                            <div class="text-muted" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.08em;">
                                {{ $detail[0] }}
                            </div>
                            <div class="fw-600 mt-1">{{ $detail[1] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Reviews --}}
        <div class="admin-card">
            <div class="admin-card-header">
                <h6 class="mb-0 fw-700">
                    Reviews ({{ $product->reviews->count() }})
                </h6>
            </div>
            <div class="table-responsive">
                <table class="table admin-table mb-0">
                    <thead>
                        <tr><th>Customer</th><th>Rating</th><th>Comment</th><th>Date</th></tr>
                    </thead>
                    <tbody>
                        @forelse($product->reviews as $review)
                        <tr>
                            <td class="fw-500">{{ $review->user->name }}</td>
                            <td>
                                <div style="color:#f59e0b;font-size:.85rem;">
                                    @for($i=1;$i<=5;$i++)
                                        <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>
                                    @endfor
                                </div>
                            </td>
                            <td class="text-muted" style="font-size:.85rem;">
                                {{ Str::limit($review->body, 60) }}
                            </td>
                            <td class="text-muted" style="font-size:.82rem;">
                                {{ $review->created_at->format('M j, Y') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">
                                No reviews yet
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