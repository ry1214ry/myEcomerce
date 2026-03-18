<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — LuxeShop Admin</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --sidebar-w:     260px;
            --primary:       #1a1a2e;
            --accent:        #c9a96e;
            --bg-sidebar:    #0f0f23;
            --bg-content:    #f4f4f8;
            --text-sidebar:  rgba(255,255,255,.75);
            --border:        #e2e8f0;
            --shadow:        0 1px 3px rgba(0,0,0,.08),0 4px 16px rgba(0,0,0,.06);
        }
        body { font-family: 'DM Sans', sans-serif; background: var(--bg-content); margin: 0; }
        h1,h2,h3,h4,h5 { font-family: 'Cormorant Garamond', serif; }

        /* Sidebar */
        .admin-sidebar {
            width: var(--sidebar-w);
            min-height: 100vh;
            background: var(--bg-sidebar);
            position: fixed;
            top: 0; left: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
            transition: transform .3s ease;
        }
        .sidebar-brand {
            padding: 1.5rem 1.5rem 1.25rem;
            border-bottom: 1px solid rgba(255,255,255,.08);
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: #fff;
        }
        .sidebar-brand span { color: var(--accent); }
        .sidebar-nav { flex: 1; padding: 1rem 0; overflow-y: auto; }
        .sidebar-label {
            font-size: .68rem;
            text-transform: uppercase;
            letter-spacing: .15em;
            color: rgba(255,255,255,.35);
            padding: .8rem 1.5rem .4rem;
            font-weight: 600;
        }
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .7rem 1.5rem;
            color: var(--text-sidebar);
            font-size: .875rem;
            font-weight: 500;
            transition: all .2s ease;
            border-left: 3px solid transparent;
            text-decoration: none;
        }
        .sidebar-link i { font-size: 1.1rem; width: 20px; text-align: center; }
        .sidebar-link:hover, .sidebar-link.active {
            color: #fff;
            background: rgba(255,255,255,.06);
            border-left-color: var(--accent);
        }
        .sidebar-link.active { background: rgba(201,169,110,.15); color: var(--accent); }
        .sidebar-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(255,255,255,.08);
            font-size: .85rem;
            color: rgba(255,255,255,.5);
        }

        /* Main Content */
        .admin-main {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .admin-topbar {
            background: #fff;
            border-bottom: 1px solid var(--border);
            padding: 1rem 1.75rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
            box-shadow: var(--shadow);
        }
        .admin-topbar h4 { font-family: 'Cormorant Garamond', serif; font-size: 1.5rem; font-weight: 700; margin: 0; color: var(--primary); }
        .admin-content { flex: 1; padding: 1.75rem; }

        /* Cards */
        .admin-card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
        }
        .admin-card-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .admin-card-body { padding: 1.5rem; }

        /* Stats */
        .stat-card {
            background: #fff;
            border-radius: 14px;
            padding: 1.5rem;
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; right: 0;
            width: 100px; height: 100px;
            border-radius: 50%;
            opacity: .06;
        }
        .stat-card.accent::before { background: var(--accent); }
        .stat-card.primary::before { background: var(--primary); }
        .stat-card.success::before { background: #22c55e; }
        .stat-card.info::before { background: #3b82f6; }
        .stat-number { font-size: 2rem; font-weight: 700; font-family: 'Cormorant Garamond', serif; }
        .stat-label { font-size: .8rem; text-transform: uppercase; letter-spacing: .1em; color: #6b7280; font-weight: 600; }
        .stat-icon {
            width: 48px; height: 48px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem;
        }

        /* Table */
        .admin-table { font-size: .875rem; }
        .admin-table thead th { background: #f8fafc; font-weight: 600; text-transform: uppercase; font-size: .75rem; letter-spacing: .08em; color: #64748b; border: none; padding: .85rem 1rem; }
        .admin-table td { padding: .85rem 1rem; vertical-align: middle; border-bottom: 1px solid #f1f5f9; }
        .admin-table tbody tr:hover { background: #fafbfc; }

        /* Buttons */
        .btn-accent { background: var(--accent); color: #fff; border: none; }
        .btn-accent:hover { background: #b8934a; color: #fff; }
        .btn-primary-admin { background: var(--primary); color: #fff; border: none; }
        .btn-primary-admin:hover { background: #0f0f23; color: #fff; }

        /* Toggle sidebar on mobile */
        @media (max-width: 991px) {
            .admin-sidebar { transform: translateX(-100%); }
            .admin-sidebar.open { transform: translateX(0); }
            .admin-main { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>

{{-- Sidebar --}}
<aside class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-brand">Luxe<span>Shop</span></div>
    <nav class="sidebar-nav">
        <div class="sidebar-label">Main</div>
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid"></i> Dashboard
        </a>

        <div class="sidebar-label">Catalog</div>
        <a href="{{ route('admin.products.index') }}" class="sidebar-link {{ request()->routeIs('admin.products*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i> Products
        </a>
        <a href="{{ route('admin.categories.index') }}" class="sidebar-link {{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
            <i class="bi bi-tags"></i> Categories
        </a>
        <a href="{{ route('admin.brands.index') }}" class="sidebar-link {{ request()->routeIs('admin.brands*') ? 'active' : '' }}">
            <i class="bi bi-award"></i> Brands
        </a>

        <div class="sidebar-label">Sales</div>
        <a href="{{ route('admin.orders.index') }}" class="sidebar-link {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
            <i class="bi bi-cart-check"></i> Orders
        </a>
        <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
            <i class="bi bi-people"></i> Customers
        </a>

        <div class="sidebar-label">Media</div>
        <a href="{{ route('admin.banners.index') }}" class="sidebar-link {{ request()->routeIs('admin.banners*') ? 'active' : '' }}">
            <i class="bi bi-image"></i> Banners
        </a>

        <div class="sidebar-label">Site</div>
        <a href="{{ route('home') }}" target="_blank" class="sidebar-link">
            <i class="bi bi-arrow-up-right-square"></i> View Store
        </a>
    </nav>
    <div class="sidebar-footer">
        <div class="d-flex align-items-center gap-2 mb-2">
            <div class="rounded-circle bg-accent d-flex align-items-center justify-content-center text-white"
                 style="width:32px;height:32px;background:var(--accent)!important;font-weight:700;font-size:.875rem;">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div>
                <div class="text-white fw-500" style="font-size:.85rem;">{{ auth()->user()->name }}</div>
                <div style="font-size:.75rem;">Administrator</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-sm w-100" style="background:rgba(255,255,255,.1);color:rgba(255,255,255,.7);">
                <i class="bi bi-box-arrow-right me-1"></i> Logout
            </button>
        </form>
    </div>
</aside>

{{-- Main --}}
<div class="admin-main">
    <div class="admin-topbar">
        <div class="d-flex align-items-center gap-3">
            <button class="btn border-0 d-lg-none" onclick="document.getElementById('adminSidebar').classList.toggle('open')">
                <i class="bi bi-list fs-4"></i>
            </button>
            <h4>@yield('page-title', 'Dashboard')</h4>
        </div>
        <div class="d-flex align-items-center gap-3">
            @if(session('success'))
                <span class="badge bg-success">{{ session('success') }}</span>
            @endif
            <span class="text-muted" style="font-size:.85rem;">{{ now()->format('D, M j Y') }}</span>
        </div>
    </div>

    <div class="admin-content">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>