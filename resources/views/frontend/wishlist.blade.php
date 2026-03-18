@extends('layouts.frontend')
@section('title', 'Wishlist')

@section('content')
<div class="breadcrumb-section">
    <div class="container">
        <nav><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Wishlist</li>
        </ol></nav>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">
        <div class="col-lg-3">
            @include('partials.account-sidebar')
        </div>
        <div class="col-lg-9">
            <h4 class="mb-4">My Wishlist ({{ $wishlists->count() }} items)</h4>
            @if($wishlists->isEmpty())
            <div class="text-center py-5">
                <i class="bi bi-heart fs-1 text-muted d-block mb-3"></i>
                <h5>Your wishlist is empty</h5>
                <a href="{{ route('shop') }}" class="btn btn-accent">Explore Products</a>
            </div>
            @else
            <div class="row g-4">
                @foreach($wishlists as $wishlist)
                <div class="col-6 col-md-4">
                    @include('partials.product-card', ['product' => $wishlist->product])
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
@endsection