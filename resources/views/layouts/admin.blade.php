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
            --sidebar-w:    260px;
            --primary:      #1a1a2e;
            --accent:       #c9a96e;
            --accent-hover: #b8934a;
            --bg-sidebar:   #0f0f23;
            --bg-content:   #f4f4f8;
            --border:       #e2e8f0;
            --shadow:       0 1px 3px rgba(0,0,0,.08), 0 4px 16px rgba(0,0,0,.06);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg-content);
        }
        h1,h2,h3,h4,h5,h6 {
            font-family: 'Cormorant Garamond', serif;
        }

        /* ── SIDEBAR ───────────────────────────────────────────── */
        .admin-sidebar {
            width: var(--sidebar-w);
            min-height: 100vh;
            background: var(--bg-sidebar);
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
            transition: transform .3s ease;
        }

        /* Brand */
        .sidebar-brand {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,.08);
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: #fff;
            text-decoration: none;
            display: block;
        }
        .sidebar-brand span { color: var(--accent); }

        /* Nav */
        .sidebar-nav {
            flex: 1;
            padding: 1rem 0;
            overflow-y: auto;
        }
        .sidebar-label {
            font-size: .68rem;
            text-transform: uppercase;
            letter-spacing: .15em;
            color: rgba(255,255,255,.3);
            padding: .8rem 1.5rem .3rem;
            font-weight: 600;
        }
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .7rem 1.5rem;
            color: rgba(255,255,255,.65);
            font-size: .875rem;
            font-weight: 500;
            text-decoration: none;
            border-left: 3px solid transparent;
            transition: all .2s ease;
        }
        .sidebar-link i {
            font-size: 1.05rem;
            width: 20px;
            text-align: center;
            flex-shrink: 0;
        }
        .sidebar-link:hover {
            color: #fff;
            background: rgba(255,255,255,.06);
            border-left-color: var(--accent);
        }
        .sidebar-link.active {
            color: var(--accent);
            background: rgba(201,169,110,.12);
            border-left-color: var(--accent);
        }

        /* Sidebar Footer */
        .sidebar-footer {
            border-top: 1px solid rgba(255,255,255,.08);
            padding: 1.25rem 1.5rem;
        }
        .sidebar-user {
            display: flex;
            align-items: center;
            gap: .75rem;
            margin-bottom: 1rem;
        }
        .sidebar-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: .9rem;
            flex-shrink: 0;
        }
        .sidebar-user-info .name {
            color: #fff;
            font-size: .875rem;
            font-weight: 600;
            line-height: 1.2;
        }
        .sidebar-user-info .role {
            color: rgba(255,255,255,.4);
            font-size: .75rem;
        }
        .btn-sidebar-logout {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            width: 100%;
            padding: .6rem 1rem;
            background: rgba(239,68,68,.1);
            border: 1px solid rgba(239,68,68,.2);
            border-radius: 10px;
            color: #fca5a5;
            font-size: .825rem;
            font-weight: 500;
            cursor: pointer;
            transition: all .2s;
            text-decoration: none;
        }
        .btn-sidebar-logout:hover {
            background: rgba(239,68,68,.2);
            border-color: rgba(239,68,68,.4);
            color: #fca5a5;
            transform: translateY(-1px);
        }

        /* ── MAIN CONTENT ──────────────────────────────────────── */
        .admin-main {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top Bar */
        .admin-topbar {
            background: #fff;
            border-bottom: 1px solid var(--border);
            padding: .85rem 1.75rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
            box-shadow: var(--shadow);
            gap: 1rem;
        }
        .topbar-left {
            display: flex;
            align-items: center;
            gap: .75rem;
        }
        .topbar-left h4 {
            font-size: 1.4rem;
            font-weight: 700;
            margin: 0;
            color: var(--primary);
        }
        .topbar-right {
            display: flex;
            align-items: center;
            gap: .75rem;
        }
        .topbar-date {
            color: #94a3b8;
            font-size: .8rem;
            display: none;
        }
        @media (min-width: 768px) { .topbar-date { display: block; } }

        /* Topbar User Dropdown */
        .topbar-user {
            display: flex;
            align-items: center;
            gap: .6rem;
            cursor: pointer;
            padding: .4rem .75rem;
            border-radius: 50px;
            border: 1px solid var(--border);
            background: #fff;
            transition: all .2s;
            text-decoration: none;
            color: var(--primary);
        }
        .topbar-user:hover {
            border-color: var(--accent);
            background: #fdf9f0;
            color: var(--primary);
        }
        .topbar-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: .8rem;
            flex-shrink: 0;
        }
        .topbar-user-name {
            font-size: .825rem;
            font-weight: 600;
            color: var(--primary);
        }

        /* Topbar Logout Button */
        .btn-topbar-logout {
            display: flex;
            align-items: center;
            gap: .4rem;
            padding: .5rem 1.1rem;
            background: #fff;
            border: 1.5px solid #fecaca;
            border-radius: 50px;
            color: #ef4444;
            font-size: .825rem;
            font-weight: 500;
            cursor: pointer;
            transition: all .2s;
            text-decoration: none;
        }
        .btn-topbar-logout:hover {
            background: #fef2f2;
            border-color: #ef4444;
            color: #dc2626;
            transform: translateY(-1px);
        }

        /* Mobile Toggle */
        .sidebar-toggle {
            display: none;
            background: none;
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: .35rem .6rem;
            cursor: pointer;
            color: var(--primary);
            font-size: 1.2rem;
        }
        @media (max-width: 991px) {
            .sidebar-toggle { display: flex; align-items: center; }
        }

        /* Page Content */
        .admin-content {
            flex: 1;
            padding: 1.75rem;
        }

        /* ── CARDS ─────────────────────────────────────────────── */
        .admin-card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
        }
        .admin-card-header {
            padding: 1.1rem 1.5rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .admin-card-body { padding: 1.5rem; }

        /* ── STAT CARDS ────────────────────────────────────────── */
        .stat-card {
            background: #fff;
            border-radius: 14px;
            padding: 1.4rem;
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }
        .stat-label {
            font-size: .75rem;
            text-transform: uppercase;
            letter-spacing: .1em;
            color: #6b7280;
            font-weight: 600;
            margin-bottom: .4rem;
        }
        .stat-number {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2rem;
            font-weight: 700;
            line-height: 1;
        }
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ── TABLE ─────────────────────────────────────────────── */
        .admin-table { font-size: .875rem; }
        .admin-table thead th {
            background: #f8fafc;
            font-weight: 600;
            text-transform: uppercase;
            font-size: .72rem;
            letter-spacing: .08em;
            color: #64748b;
            border: none;
            padding: .85rem 1rem;
        }
        .admin-table td {
            padding: .85rem 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            border-top: none;
        }
        .admin-table tbody tr:hover { background: #fafbfc; }
        .admin-table tbody tr:last-child td { border-bottom: none; }

        .admin-pagination .pagination {
            margin: 0;
            gap: .45rem;
        }
        .admin-pagination .page-link {
            min-width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 .95rem;
            border-radius: 999px;
            border: 1px solid var(--border);
            background: #fff;
            color: #475569;
            font-size: .85rem;
            font-weight: 600;
            box-shadow: none;
        }
        .admin-pagination .page-link:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: var(--primary);
        }
        .admin-pagination .page-item.active .page-link {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
        }
        .admin-pagination .page-item.disabled .page-link {
            background: #f8fafc;
            border-color: var(--border);
            color: #94a3b8;
        }
        .admin-pagination .page-item:first-child .page-link,
        .admin-pagination .page-item:last-child .page-link {
            min-width: auto;
        }

        /* ── BUTTONS ───────────────────────────────────────────── */
        .btn-accent {
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: .55rem 1.4rem;
            font-size: .875rem;
            font-weight: 500;
            transition: all .2s;
            cursor: pointer;
        }
        .btn-accent:hover {
            background: var(--accent-hover);
            color: #fff;
            transform: translateY(-1px);
        }
        .text-accent { color: var(--accent) !important; }
        .fw-500 { font-weight: 500 !important; }
        .fw-600 { font-weight: 600 !important; }
        .fw-700 { font-weight: 700 !important; }
        .rounded-xl { border-radius: 12px !important; }

        /* ── MOBILE SIDEBAR ────────────────────────────────────── */
        @media (max-width: 991px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }
            .admin-sidebar.open {
                transform: translateX(0);
                box-shadow: 0 0 60px rgba(0,0,0,.4);
            }
            .admin-main { margin-left: 0; }
        }

        /* Overlay for mobile sidebar */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.5);
            z-index: 99;
        }
        .sidebar-overlay.show { display: block; }
    </style>

    @stack('styles')
</head>
<body>

{{-- ── SIDEBAR OVERLAY (mobile) ──────────────────────────────── --}}
<div class="sidebar-overlay" id="sidebarOverlay"
     onclick="closeSidebar()"></div>

{{-- ════════════════════════════════════════════════════════════ --}}
{{-- SIDEBAR                                                      --}}
{{-- ════════════════════════════════════════════════════════════ --}}
<aside class="admin-sidebar" id="adminSidebar">

    {{-- Brand --}}
    <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
        Luxe<span>Shop</span>
    </a>

    {{-- Navigation --}}
    <nav class="sidebar-nav">

        <div class="sidebar-label">Main</div>
        <a href="{{ route('admin.dashboard') }}"
           class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2"></i> Dashboard
        </a>

        <div class="sidebar-label">Catalog</div>
        <a href="{{ route('admin.products.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.products*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i> Products
        </a>
        <a href="{{ route('admin.categories.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
            <i class="bi bi-tags"></i> Categories
        </a>
        <a href="{{ route('admin.brands.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.brands*') ? 'active' : '' }}">
            <i class="bi bi-award"></i> Brands
        </a>

        <div class="sidebar-label">Sales</div>
        <a href="{{ route('admin.orders.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
            <i class="bi bi-cart-check"></i> Orders
        </a>
        <a href="{{ route('admin.users.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
            <i class="bi bi-people"></i> Customers
        </a>

        <div class="sidebar-label">Media</div>
        <a href="{{ route('admin.banners.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.banners*') ? 'active' : '' }}">
            <i class="bi bi-image"></i> Banners
        </a>

        <div class="sidebar-label">Store</div>
        <a href="{{ route('home') }}" target="_blank" class="sidebar-link">
            <i class="bi bi-arrow-up-right-square"></i> View Store
        </a>

    </nav>

    {{-- Sidebar Footer — User Info + Logout --}}
    <div class="sidebar-footer">

        {{-- User Info --}}
        <div class="sidebar-user">
            <div class="sidebar-avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div class="sidebar-user-info">
                <div class="name">{{ auth()->user()->name }}</div>
                <div class="role">Administrator</div>
            </div>
        </div>

        {{-- ✅ LOGOUT BUTTON --}}
        <form method="POST" action="{{ route('admin.logout') }}" id="sidebarLogoutForm">
            @csrf
            <button type="submit" class="btn-sidebar-logout">
                <i class="bi bi-box-arrow-right"></i>
                Sign Out
            </button>
        </form>

    </div>

</aside>

{{-- ════════════════════════════════════════════════════════════ --}}
{{-- MAIN CONTENT                                                 --}}
{{-- ════════════════════════════════════════════════════════════ --}}
<div class="admin-main">

    {{-- ── TOP BAR ──────────────────────────────────────────── --}}
    <div class="admin-topbar">

        {{-- Left: Toggle + Page Title --}}
        <div class="topbar-left">
            <button class="sidebar-toggle" onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>
            <h4>@yield('page-title', 'Dashboard')</h4>
        </div>

        {{-- Right: Date + User + Logout --}}
        <div class="topbar-right">

            {{-- Date --}}
            <span class="topbar-date">
                <i class="bi bi-calendar3 me-1"></i>
                {{ now()->format('D, M j Y') }}
            </span>

            {{-- User Info --}}
            <div class="topbar-user">
                <div class="topbar-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <span class="topbar-user-name d-none d-md-block">
                    {{ auth()->user()->name }}
                </span>
                <i class="bi bi-chevron-down text-muted"
                   style="font-size:.7rem;"></i>
            </div>

            {{-- ✅ TOPBAR LOGOUT BUTTON --}}
            <form method="POST"
                  action="{{ route('admin.logout') }}"
                  id="topbarLogoutForm">
                @csrf
                <button type="submit" class="btn-topbar-logout">
                    <i class="bi bi-box-arrow-right"></i>
                    <span class="d-none d-md-inline">Logout</span>
                </button>
            </form>

        </div>
    </div>

    {{-- ── FLASH MESSAGES ───────────────────────────────────── --}}
    @if(session('success'))
    <div class="px-4 pt-3">
        <div class="alert alert-success alert-dismissible fade show
                    rounded-3 border-0 d-flex align-items-center gap-2"
             style="background:#f0fdf4;color:#166534;
                    border-left:4px solid #22c55e!important;"
             role="alert">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
            <button type="button" class="btn-close ms-auto"
                    data-bs-dismiss="alert"></button>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="px-4 pt-3">
        <div class="alert alert-danger alert-dismissible fade show
                    rounded-3 border-0 d-flex align-items-center gap-2"
             style="background:#fef2f2;color:#991b1b;
                    border-left:4px solid #ef4444!important;"
             role="alert">
            <i class="bi bi-exclamation-circle-fill"></i>
            <span>{{ session('error') }}</span>
            <button type="button" class="btn-close ms-auto"
                    data-bs-dismiss="alert"></button>
        </div>
    </div>
    @endif

    @if(session('info'))
    <div class="px-4 pt-3">
        <div class="alert alert-info alert-dismissible fade show
                    rounded-3 border-0 d-flex align-items-center gap-2"
             role="alert">
            <i class="bi bi-info-circle-fill"></i>
            <span>{{ session('info') }}</span>
            <button type="button" class="btn-close ms-auto"
                    data-bs-dismiss="alert"></button>
        </div>
    </div>
    @endif

    {{-- ── PAGE CONTENT ──────────────────────────────────────── --}}
    <div class="admin-content">
        @yield('content')
    </div>

</div>
{{-- end admin-main --}}

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // ── Sidebar Toggle ──────────────────────────────────────────
    function toggleSidebar() {
        const sidebar = document.getElementById('adminSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        sidebar.classList.toggle('open');
        overlay.classList.toggle('show');
    }

    function closeSidebar() {
        const sidebar = document.getElementById('adminSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        sidebar.classList.remove('open');
        overlay.classList.remove('show');
    }

    // ── Confirm Logout ──────────────────────────────────────────
    document.querySelectorAll('#sidebarLogoutForm, #topbarLogoutForm')
        .forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (confirm('Are you sure you want to logout?')) {
                    this.submit();
                }
            });
        });
</script>

@stack('scripts')
</body>
</html>
