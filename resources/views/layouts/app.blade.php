<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Xiaomi Store')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root { --xiaomi-orange: #FF6900; --xiaomi-dark: #1a1a1a; }
        body { font-family: 'Segoe UI', sans-serif; background: #f8f9fa; }
        .navbar { background: var(--xiaomi-dark) !important; }
        .navbar-brand { color: #fff !important; font-weight: 700; font-size: 1.4rem; }
        .navbar-brand span { color: var(--xiaomi-orange); }
        .btn-xiaomi { background: var(--xiaomi-orange); border: none; color: #fff; }
        .btn-xiaomi:hover { background: #e05e00; color: #fff; }
        .badge-xiaomi { background: var(--xiaomi-orange); }
        .product-card { transition: transform .2s, box-shadow .2s; border: none; border-radius: 12px; overflow: hidden; }
        .product-card:hover { transform: translateY(-4px); box-shadow: 0 12px 24px rgba(0,0,0,.12); }
        .product-card .card-img-top { height: 220px; object-fit: cover; background: #f0f0f0; }
        .price-tag { color: var(--xiaomi-orange); font-weight: 700; font-size: 1.1rem; }
        footer { background: var(--xiaomi-dark); color: #aaa; padding: 2rem 0; margin-top: 4rem; }
        .cart-badge { position: relative; }
        .cart-count { position: absolute; top: -8px; right: -8px; background: var(--xiaomi-orange);
                      color: #fff; border-radius: 50%; width: 18px; height: 18px; font-size: 11px;
                      display: flex; align-items: center; justify-content: center; }
    </style>
    @stack('styles')
</head>
<body>

{{-- Navbar --}}
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('shop.index') }}">
            <span>Xiaomi</span> Store
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('shop.index') ? 'active' : '' }}"
                       href="{{ route('shop.index') }}">Produk</a>
                </li>
            </ul>
            <ul class="navbar-nav align-items-center gap-2">
                {{-- Cart Icon --}}
                <li class="nav-item">
                    <a href="{{ route('cart.index') }}" class="btn btn-outline-light btn-sm cart-badge position-relative">
                        <i class="bi bi-cart3"></i>
                        @php $cartCount = count(session('cart', [])); @endphp
                        @if($cartCount > 0)
                            <span class="cart-count">{{ $cartCount }}</span>
                        @endif
                    </a>
                </li>
                {{-- Admin Link --}}
                @auth
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-xiaomi btn-sm">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button class="btn btn-outline-danger btn-sm">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">
                            <i class="bi bi-lock"></i> Admin
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

{{-- Alerts --}}
<div class="container mt-3">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
</div>

{{-- Main Content --}}
<main class="container py-4">
    @yield('content')
</main>

<footer>
    <div class="container text-center">
        <p class="mb-1">© {{ date('Y') }} <strong style="color:#fff">Xiaomi Store</strong>. All rights reserved.</p>
        <small>Teknologi untuk Semua Orang</small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
