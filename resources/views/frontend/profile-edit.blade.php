@extends('layouts.frontend')
@section('title', 'Edit Profile')

@section('content')
<div class="breadcrumb-section">
    <div class="container">
        <nav><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('profile.show') }}">My Account</a></li>
            <li class="breadcrumb-item active">Edit Profile</li>
        </ol></nav>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">
        <div class="col-lg-3">
            @include('partials.account-sidebar')
        </div>
        <div class="col-lg-9">
            {{-- Profile Form --}}
            <div class="bg-white border rounded-xl p-4 mb-4" style="border-color:var(--border)!important;box-shadow:var(--shadow-sm);">
                <h5 class="mb-4">Personal Information</h5>
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf @method('PATCH')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-500">Full Name *</label>
                            <input type="text" name="name" class="form-control rounded-pill @error('name') is-invalid @enderror"
                                   value="{{ old('name', $user->name) }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-500">Email *</label>
                            <input type="email" name="email" class="form-control rounded-pill @error('email') is-invalid @enderror"
                                   value="{{ old('email', $user->email) }}" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-500">Phone</label>
                            <input type="text" name="phone" class="form-control rounded-pill"
                                   value="{{ old('phone', $user->phone) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-500">Country</label>
                            <input type="text" name="country" class="form-control rounded-pill"
                                   value="{{ old('country', $user->country) }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-500">Address</label>
                            <input type="text" name="address" class="form-control rounded-pill"
                                   value="{{ old('address', $user->address) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-500">City</label>
                            <input type="text" name="city" class="form-control rounded-pill"
                                   value="{{ old('city', $user->city) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-500">State</label>
                            <input type="text" name="state" class="form-control rounded-pill"
                                   value="{{ old('state', $user->state) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-500">ZIP Code</label>
                            <input type="text" name="zip_code" class="form-control rounded-pill"
                                   value="{{ old('zip_code', $user->zip_code) }}">
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-accent me-2">Save Changes</button>
                        <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary rounded-pill">Cancel</a>
                    </div>
                </form>
            </div>

            {{-- Password Change --}}
            <div class="bg-white border rounded-xl p-4" style="border-color:var(--border)!important;box-shadow:var(--shadow-sm);">
                <h5 class="mb-4">Change Password</h5>
                <form action="{{ route('profile.password') }}" method="POST">
                    @csrf @method('PATCH')
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label fw-500">Current Password *</label>
                            <input type="password" name="current_password" class="form-control rounded-pill @error('current_password') is-invalid @enderror" required>
                            @error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-500">New Password *</label>
                            <input type="password" name="password" class="form-control rounded-pill @error('password') is-invalid @enderror" required>
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-500">Confirm Password *</label>
                            <input type="password" name="password_confirmation" class="form-control rounded-pill" required>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-accent">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection