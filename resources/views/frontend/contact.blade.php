@extends('layouts.frontend')
@section('title', 'Contact Us')

@section('content')
<div class="breadcrumb-section">
    <div class="container">
        <nav><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Contact</li>
        </ol></nav>
    </div>
</div>

<div class="container py-5">
    <div class="section-header text-center reveal mb-5">
        <span class="section-label">Get in touch</span>
        <h2 class="section-title">Contact Us</h2>
        <div class="section-divider mx-auto"></div>
        <p class="section-subtitle">We'd love to hear from you. Our friendly team is always here to help.</p>
    </div>

    <div class="row g-5">
        <div class="col-lg-5">
            <div class="mb-4">
                @foreach([
                    ['bi-geo-alt-fill','Our Location','123 Luxury Avenue, New York, NY 10001, USA'],
                    ['bi-envelope-fill','Email Us','admin@luxeshop.com'],
                    ['bi-telephone-fill','Call Us','+1 (800) 123-4567'],
                    ['bi-clock-fill','Business Hours','Mon–Fri: 9AM–6PM EST'],
                ] as $c)
                <div class="d-flex gap-3 mb-4">
                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 text-white"
                         style="width:48px;height:48px;background:var(--accent);">
                        <i class="bi {{ $c[0] }}"></i>
                    </div>
                    <div>
                        <div class="fw-600">{{ $c[1] }}</div>
                        <div class="text-muted" style="font-size:.9rem;">{{ $c[2] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="col-lg-7">
            <div class="bg-white border rounded-xl p-5" style="border-color:var(--border)!important;box-shadow:var(--shadow-md);">
                <form action="{{ route('contact.send') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-500">Your Name *</label>
                            <input type="text" name="name" class="form-control rounded-pill @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-500">Email Address *</label>
                            <input type="email" name="email" class="form-control rounded-pill @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-500">Subject *</label>
                            <input type="text" name="subject" class="form-control rounded-pill @error('subject') is-invalid @enderror"
                                   value="{{ old('subject') }}" required>
                            @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-500">Message *</label>
                            <textarea name="message" class="form-control rounded-3 @error('message') is-invalid @enderror"
                                      rows="6" required>{{ old('message') }}</textarea>
                            @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-accent px-5">
                                <i class="bi bi-send me-2"></i>Send Message
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection