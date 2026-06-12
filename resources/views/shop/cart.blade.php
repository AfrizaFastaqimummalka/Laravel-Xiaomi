@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-cart3 me-2" style="color:#FF6900"></i>Keranjang Belanja</h4>
    <a href="{{ route('shop.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Lanjut Belanja
    </a>
</div>

@if(empty($cart))
    <div class="text-center py-5">
        <i class="bi bi-cart-x" style="font-size:4rem;color:#dee2e6"></i>
        <h5 class="text-muted mt-3 mb-1">Keranjang masih kosong</h5>
        <p class="text-muted small">Tambahkan produk dari halaman toko</p>
        <a href="{{ route('shop.index') }}" class="btn btn-xiaomi mt-2">
            <i class="bi bi-shop me-2"></i>Belanja Sekarang
        </a>
    </div>
@else
    <div class="row g-4">
        {{-- Cart Items --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-0">
                    <table class="table mb-0 align-middle">
                        <thead style="background:#f8f9fa;">
                            <tr>
                                <th class="px-4 py-3" style="font-size:.8rem;text-transform:uppercase;color:#888;letter-spacing:.5px">Produk</th>
                                <th class="py-3 text-center" style="font-size:.8rem;text-transform:uppercase;color:#888">Harga</th>
                                <th class="py-3 text-center" style="font-size:.8rem;text-transform:uppercase;color:#888">Jumlah</th>
                                <th class="py-3 text-center" style="font-size:.8rem;text-transform:uppercase;color:#888">Subtotal</th>
                                <th class="py-3 text-center" style="font-size:.8rem;text-transform:uppercase;color:#888"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $id => $item)
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="rounded-2 overflow-hidden flex-shrink-0"
                                                 style="width:60px;height:60px;background:#f8f9fa;display:flex;align-items:center;justify-content:center;">
                                                @if($item['image'] && !str_contains($item['image'], 'no-image'))
                                                    <img src="{{ $item['image'] }}" alt="{{ $item['product_name'] }}"
                                                         style="width:60px;height:60px;object-fit:cover;">
                                                @else
                                                    <i class="bi bi-phone" style="font-size:1.5rem;color:#ccc"></i>
                                                @endif
                                            </div>
                                            <div>
                                                <span class="fw-semibold d-block">{{ $item['product_name'] }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center text-muted small">
                                        Rp {{ number_format($item['price'], 0, ',', '.') }}
                                    </td>
                                    <td class="text-center">
                                        <form method="POST" action="{{ route('cart.update', $id) }}" class="d-inline">
                                            @csrf @method('PATCH')
                                            <div class="d-flex align-items-center justify-content-center gap-1">
                                                <input type="number" name="quantity" value="{{ $item['quantity'] }}"
                                                       min="1" max="100"
                                                       class="form-control text-center p-1 fw-bold"
                                                       style="width:60px;font-size:.9rem"
                                                       onchange="this.form.submit()">
                                            </div>
                                        </form>
                                    </td>
                                    <td class="text-center fw-bold" style="color:#FF6900">
                                        Rp {{ number_format($item['subtotal'], 0, ',', '.') }}
                                    </td>
                                    <td class="text-center">
                                        <form method="POST" action="{{ route('cart.remove', $id) }}">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Hapus produk ini?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Clear Cart --}}
            <div class="mt-2 text-end">
                <form method="POST" action="{{ route('cart.clear') }}">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger"
                            onclick="return confirm('Kosongkan semua keranjang?')">
                        <i class="bi bi-trash3 me-1"></i>Kosongkan Keranjang
                    </button>
                </form>
            </div>
        </div>

        {{-- Order Summary --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-4 pb-2 border-bottom">Ringkasan Pesanan</h6>

                    @foreach($cart as $item)
                        <div class="d-flex justify-content-between mb-2 small">
                            <span class="text-muted">{{ $item['product_name'] }} ×{{ $item['quantity'] }}</span>
                            <span>Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</span>
                        </div>
                    @endforeach

                    <hr>
                    <div class="d-flex justify-content-between fw-bold fs-5 mb-4">
                        <span>Total</span>
                        <span style="color:#FF6900">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <a href="{{ route('checkout.index') }}" class="btn btn-xiaomi w-100 py-2 fw-semibold">
                        <i class="bi bi-credit-card me-2"></i>Proses Checkout
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif

@endsection
