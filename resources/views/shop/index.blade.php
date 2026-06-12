@extends('layouts.app')

@section('title', 'Produk - Xiaomi Store')

@section('content')

{{-- Hero Banner --}}
<div class="rounded-4 mb-4 p-4 p-md-5 text-white"
     style="background: linear-gradient(135deg, #1a1a1a 60%, #FF6900); min-height: 180px; display:flex; align-items:center;">
    <div>
        <h1 class="fw-bold mb-1" style="font-size:2.2rem">Xiaomi Store</h1>
        <p class="mb-3 text-white-50">Produk resmi Xiaomi — Smartphone, Tablet, Wearable & Aksesoris</p>
        <form method="GET" action="{{ route('shop.index') }}" class="d-flex gap-2 flex-wrap">
            <input type="text" name="search" class="form-control" style="max-width:320px; background:rgba(255,255,255,.1); border:1.5px solid rgba(255,255,255,.3); color:#fff;"
                   placeholder="Cari produk..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-xiaomi px-4">
                <i class="bi bi-search me-1"></i>Cari
            </button>
            @if(request()->anyFilled(['search','category']))
                <a href="{{ route('shop.index') }}" class="btn btn-outline-light">Reset</a>
            @endif
        </form>
    </div>
</div>

<div class="row g-4">
    {{-- Filter Sidebar --}}
    <div class="col-lg-2">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-3">
                <p class="fw-bold mb-2 small text-uppercase text-muted">Kategori</p>
                <ul class="list-unstyled mb-0">
                    <li>
                        <a href="{{ route('shop.index', request()->except('category')) }}"
                           class="text-decoration-none d-block py-2 px-3 rounded mb-1 transition
                           {{ !request('category') ? 'bg-warning bg-opacity-10 text-dark fw-bold border border-warning border-opacity-25' : 'text-muted hover-bg-light' }}"
                           style="{{ !request('category') ? 'color:#FF6900 !important' : '' }}">
                            Semua
                        </a>
                    </li>
                    @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('shop.index', array_merge(request()->query(), ['category' => $cat])) }}"
                               class="text-decoration-none d-block py-2 px-3 rounded mb-1 transition
                               {{ request('category') === $cat ? 'bg-warning bg-opacity-10 text-dark fw-bold border border-warning border-opacity-25' : 'text-muted hover-bg-light' }}"
                               style="{{ request('category') === $cat ? 'color:#FF6900 !important' : '' }}">
                                {{ $cat }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    {{-- Products Grid --}}
    <div class="col-lg-10">
        @if($products->isEmpty())
            <div class="text-center py-5 bg-white rounded-3 shadow-sm border-0">
                <i class="bi bi-search" style="font-size:3rem;color:#dee2e6"></i>
                <p class="text-muted mt-3 mb-4">Produk tidak ditemukan. Coba sesuaikan kata kunci pencarian Anda.</p>
                <a href="{{ route('shop.index') }}" class="btn btn-xiaomi px-4 py-2">Lihat Semua Produk</a>
            </div>
        @else
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted small">Menampilkan <span class="fw-bold text-dark">{{ $products->total() }}</span> produk</span>
            </div>
            <div class="row g-4">
                @foreach($products as $product)
                    <div class="col-sm-6 col-md-4 col-xl-3">
                        <div class="card product-card h-100 shadow-sm border-0">
                            <a href="{{ route('shop.show', $product) }}" class="d-block text-decoration-none overflow-hidden">
                                @if($product->image && \Storage::disk('public')->exists($product->image))
                                    <img src="{{ $product->image_url }}"
                                         class="card-img-top w-100" alt="{{ $product->name }}"
                                         style="aspect-ratio: 1 / 1; object-fit: cover;">
                                @else
                                    <div class="card-img-top w-100 d-flex align-items-center justify-content-center"
                                         style="aspect-ratio: 1 / 1; background:#f8f9fa;">
                                        <i class="bi bi-phone" style="font-size:3.5rem;color:#dee2e6"></i>
                                    </div>
                                @endif
                            </a>
                            <div class="card-body d-flex flex-column p-3 p-xl-4">
                                @if($product->category)
                                    <span class="badge bg-light text-secondary border mb-2 align-self-start fw-normal px-2 py-1" style="font-size:0.75rem">
                                        {{ $product->category }}
                                    </span>
                                @endif
                                <h6 class="card-title mb-2 fw-bold" style="line-height:1.4">
                                    <a href="{{ route('shop.show', $product) }}" class="text-dark text-decoration-none product-title-link">
                                        {{ $product->name }}
                                    </a>
                                </h6>
                                <p class="text-muted small mb-3 flex-grow-1" style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden; line-height:1.5;">
                                    {{ $product->description }}
                                </p>
                                <div class="mt-auto border-top pt-3">
                                    <div class="price-tag mb-3">{{ $product->formatted_price }}</div>
                                    <form method="POST" action="{{ route('cart.add', $product) }}">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-outline-dark w-100 btn-sm py-2 fw-semibold d-flex align-items-center justify-content-center gap-2 hover-xiaomi">
                                            <i class="bi bi-cart-plus"></i> Keranjang
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-5 d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>

<style>
    .hover-bg-light:hover { background-color: #f8f9fa; }
    .product-title-link:hover { color: var(--xiaomi-orange) !important; }
    .hover-xiaomi:hover { background-color: var(--xiaomi-orange); border-color: var(--xiaomi-orange); color: white; }
</style>
@endsection
