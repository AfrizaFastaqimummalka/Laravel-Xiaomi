@extends('layouts.app')

@section('title', $product->name)

@section('content')

<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('shop.index') }}" class="text-decoration-none" style="color:#FF6900">Produk</a></li>
        @if($product->category)
            <li class="breadcrumb-item">
                <a href="{{ route('shop.index', ['category' => $product->category]) }}" class="text-decoration-none text-muted">
                    {{ $product->category }}
                </a>
            </li>
        @endif
        <li class="breadcrumb-item active">{{ $product->name }}</li>
    </ol>
</nav>

<div class="row g-4">
    {{-- Product Image --}}
    <div class="col-md-5">
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
            @if($product->image && \Storage::disk('public')->exists($product->image))
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-100"
                     style="max-height:420px;object-fit:cover;">
            @else
                <div class="d-flex align-items-center justify-content-center" style="height:380px;background:#f8f9fa;">
                    <i class="bi bi-phone" style="font-size:6rem;color:#dee2e6"></i>
                </div>
            @endif
        </div>
    </div>

    {{-- Product Info --}}
    <div class="col-md-7">
        <div class="card border-0 shadow-sm rounded-3 p-4 h-100">
            @if($product->category)
                <span class="badge mb-2" style="background:#FF6900;font-size:.8rem">{{ $product->category }}</span>
            @endif
            <h1 class="fw-bold mb-2" style="font-size:1.8rem">{{ $product->name }}</h1>
            <div class="mb-3" style="color:#FF6900;font-size:1.8rem;font-weight:700">
                {{ $product->formatted_price }}
            </div>
            <hr>
            <p class="text-muted" style="line-height:1.8">{{ $product->description }}</p>
            <hr>
            <form method="POST" action="{{ route('cart.add', $product) }}" class="d-flex gap-3 align-items-center">
                @csrf
                <div style="max-width:120px">
                    <label class="form-label small fw-semibold mb-1">Jumlah</label>
                    <input type="number" name="quantity" value="1" min="1" max="100"
                           class="form-control text-center fw-bold">
                </div>
                <div class="flex-grow-1" style="margin-top:1.5rem">
                    <button type="submit" class="btn btn-xiaomi w-100 py-2 fw-semibold">
                        <i class="bi bi-cart-plus me-2"></i>Tambah ke Keranjang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Related Products --}}
@if($related->isNotEmpty())
<div class="mt-5">
    <h5 class="fw-bold mb-4">Produk Terkait</h5>
    <div class="row g-3">
        @foreach($related as $item)
            <div class="col-sm-6 col-md-3">
                <div class="card product-card h-100 shadow-sm border-0">
                    <a href="{{ route('shop.show', $item) }}">
                        @if($item->image && \Storage::disk('public')->exists($item->image))
                            <img src="{{ $item->image_url }}" class="card-img-top" alt="{{ $item->name }}"
                                 style="height:160px;object-fit:cover;">
                        @else
                            <div class="card-img-top d-flex align-items-center justify-content-center"
                                 style="height:160px;background:#f8f9fa;">
                                <i class="bi bi-phone" style="font-size:2.5rem;color:#dee2e6"></i>
                            </div>
                        @endif
                    </a>
                    <div class="card-body p-3">
                        <h6 class="fw-semibold mb-1">
                            <a href="{{ route('shop.show', $item) }}" class="text-dark text-decoration-none">
                                {{ $item->name }}
                            </a>
                        </h6>
                        <div class="price-tag">{{ $item->formatted_price }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif

@endsection
