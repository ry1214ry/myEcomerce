<div class="bg-white border rounded-xl p-3 sticky-top" style="border-color:var(--border)!important;top:80px;box-shadow:var(--shadow-sm);">
    <div class="text-center p-3 mb-2 rounded-xl" style="background:var(--bg-light);">
        <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center text-white fw-bold mb-2"
             style="width:56px;height:56px;background:var(--accent);font-size:1.2rem;">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>
        <div class="fw-600">{{ auth()->user()->name }}</div>
        <div class="text-muted" style="font-size:.78rem;">Customer</div>
    </div>

    @php
    $navItems = [
        ['route' => 'profile.show',  'icon' => 'bi-person',         'label' => 'My Profile'],
        ['route' => 'profile.edit',  'icon' => 'bi-pencil',         'label' => 'Edit Profile'],
        ['route' => 'orders.index',  'icon' => 'bi-bag-check',      'label' => 'My Orders'],
        ['route' => 'wishlist.index','icon' => 'bi-heart',          'label' => 'Wishlist'],
        ['route' => 'cart.index',    'icon' => 'bi-cart',           'label' => 'Shopping Cart'],
    ];
    @endphp

    <nav>
        @foreach($navItems as $item)
        <a href="{{ route($item['route']) }}"
           class="d-flex align-items-center gap-2 px-3 py-2 rounded-xl mb-1 {{ request()->routeIs($item['route']) ? 'text-white' : 'text-dark' }}"
           style="{{ request()->routeIs($item['route']) ? 'background:var(--accent);' : '' }} font-size:.875rem;transition:all .2s;"
           onmouseover="{{ request()->routeIs($item['route']) ? '' : "this.style.background='var(--bg-light)'" }}"
           onmouseout="{{ request()->routeIs($item['route']) ? '' : "this.style.background='transparent'" }}">
            <i class="bi {{ $item['icon'] }}"></i>
            {{ $item['label'] }}
        </a>
        @endforeach
    </nav>

    <hr style="border-color:var(--border);">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn w-100 d-flex align-items-center gap-2 text-danger px-3 py-2" style="font-size:.875rem;border:none;background:transparent;">
            <i class="bi bi-box-arrow-right"></i>Logout
        </button>
    </form>
</div>