<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title', 'Xiaomi Store')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root { --xiaomi-orange: #FF6900; --sidebar-width: 260px; }
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; }

        /* Sidebar */
        #sidebar {
            width: var(--sidebar-width); min-height: 100vh; background: #1a1a1a;
            position: fixed; top: 0; left: 0; z-index: 1000; transition: .3s;
        }
        .sidebar-brand { padding: 1.5rem 1.25rem; border-bottom: 1px solid #333; }
        .sidebar-brand h5 { color: #fff; margin: 0; font-weight: 700; }
        .sidebar-brand h5 span { color: var(--xiaomi-orange); }
        .sidebar-brand small { color: #888; font-size: 0.75rem; }
        .sidebar-nav { padding: 1rem 0; }
        .sidebar-nav .nav-link {
            color: #aaa; padding: .65rem 1.25rem; border-radius: 8px; margin: 2px 8px;
            display: flex; align-items: center; gap: .75rem; transition: .2s;
        }
        .sidebar-nav .nav-link:hover, .sidebar-nav .nav-link.active {
            background: var(--xiaomi-orange); color: #fff;
        }
        .sidebar-nav .nav-link i { font-size: 1.1rem; width: 20px; text-align: center; }

        /* Main */
        #main-content { margin-left: var(--sidebar-width); min-height: 100vh; }
        .topbar {
            background: #fff; padding: .75rem 1.5rem; border-bottom: 1px solid #e0e0e0;
            display: flex; align-items: center; justify-content: space-between; position: sticky; top:0; z-index:999;
        }
        .topbar h6 { margin: 0; font-weight: 600; color: #333; }
        .page-body { padding: 1.5rem; }

        /* Cards */
        .stat-card { border: none; border-radius: 14px; overflow: hidden; transition: transform .2s; }
        .stat-card:hover { transform: translateY(-2px); }
        .stat-card .icon-box {
            width: 52px; height: 52px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center; font-size: 1.5rem;
        }
        .table th { font-size: .8rem; text-transform: uppercase; letter-spacing: .5px; color: #888; }
        .badge-pending { background: #fff3cd; color: #856404; }
        .badge-processing { background: #cff4fc; color: #0c5460; }
        .badge-completed { background: #d1e7dd; color: #0f5132; }
        .badge-cancelled { background: #f8d7da; color: #842029; }
    </style>
    @stack('styles')
</head>
<body>

{{-- Sidebar --}}
<div id="sidebar">
    <div class="sidebar-brand">
        <h5><span>Xiaomi</span> Store</h5>
        <small>Admin Panel</small>
    </div>
    <nav class="sidebar-nav">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}"
                   class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.products.index') }}"
                   class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <i class="bi bi-box-seam"></i> Produk
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.categories.index') }}"
                   class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i class="bi bi-tags"></i> Kategori
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.suppliers.index') }}"
                   class="nav-link {{ request()->routeIs('admin.suppliers.*') ? 'active' : '' }}">
                    <i class="bi bi-truck"></i> Supplier
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.orders.index') }}"
                   class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <i class="bi bi-receipt"></i> Transaksi
                </a>
            </li>
            <hr style="border-color:#333; margin: .5rem 1rem;">
            <li class="nav-item">
                <a href="{{ route('shop.index') }}" class="nav-link" target="_blank">
                    <i class="bi bi-shop"></i> Lihat Toko
                </a>
            </li>
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link w-100 text-start border-0 bg-transparent text-danger">
                        <i class="bi bi-box-arrow-left"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </nav>
</div>

{{-- Main --}}
<div id="main-content">
    <div class="topbar">
        <h6><i class="bi bi-chevron-right me-1 text-muted"></i>@yield('title', 'Dashboard')</h6>
        <div class="d-flex align-items-center gap-3">
            <span class="text-muted small"><i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}</span>
        </div>
    </div>

    <div class="page-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
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
