@extends('layouts.app')

@section('title', 'Checkout')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-credit-card me-2" style="color:#FF6900"></i>Checkout</h4>
    <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Kembali ke Keranjang
    </a>
</div>

<div class="row g-4">
    {{-- Checkout Form --}}
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-4 pb-2 border-bottom">
                    <i class="bi bi-person-lines-fill me-2" style="color:#FF6900"></i>Data Penerima
                </h6>

                <form method="POST" action="{{ route('checkout.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="buyer_name"
                               class="form-control @error('buyer_name') is-invalid @enderror"
                               value="{{ old('buyer_name') }}" placeholder="Masukkan nama lengkap" required>
                        @error('buyer_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nomor Telepon <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="bi bi-telephone"></i>
                            </span>
                            <input type="text" name="phone"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   value="{{ old('phone') }}" placeholder="08xxxxxxxxxx" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alamat Pengiriman <span class="text-danger">*</span></label>
                        <textarea name="address" rows="3"
                                  class="form-control @error('address') is-invalid @enderror"
                                  placeholder="Jl. Contoh No. 1, Kota, Provinsi, Kode Pos" required>{{ old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Metode Pembayaran <span class="text-danger">*</span></label>
                        <div class="row g-2">
                            @foreach(['transfer' => ['icon' => 'bi-bank', 'label' => 'Transfer Bank'], 'cod' => ['icon' => 'bi-cash-coin', 'label' => 'Bayar di Tempat (COD)'], 'ewallet' => ['icon' => 'bi-wallet2', 'label' => 'E-Wallet']] as $val => $opt)
                                <div class="col-12">
                                    <label class="d-flex align-items-center gap-3 p-3 border rounded-3 cursor-pointer
                                        @error('payment_method') border-danger @enderror"
                                        style="cursor:pointer;transition:.2s"
                                        onclick="this.style.borderColor='#FF6900';this.style.background='#fff8f5'">
                                        <input type="radio" name="payment_method" value="{{ $val }}"
                                               {{ old('payment_method', 'transfer') === $val ? 'checked' : '' }}
                                               class="form-check-input mt-0" style="accent-color:#FF6900">
                                        <i class="bi {{ $opt['icon'] }}" style="font-size:1.2rem;color:#FF6900"></i>
                                        <span class="fw-semibold">{{ $opt['label'] }}</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('payment_method')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-xiaomi w-100 py-3 fw-bold fs-6">
                        <i class="bi bi-check-circle me-2"></i>Buat Pesanan
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Order Summary --}}
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-4 pb-2 border-bottom">
                    <i class="bi bi-receipt me-2" style="color:#FF6900"></i>Ringkasan Pesanan
                </h6>

                @foreach($cart as $item)
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="flex-grow-1 me-2">
                            <span class="fw-semibold d-block" style="font-size:.9rem">{{ $item['product_name'] }}</span>
                            <span class="text-muted small">{{ $item['quantity'] }} × Rp {{ number_format($item['price'], 0, ',', '.') }}</span>
                        </div>
                        <span class="fw-bold small">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</span>
                    </div>
                @endforeach

                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-bold fs-6">Total Pembayaran</span>
                    <span class="fw-bold fs-5" style="color:#FF6900">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </span>
                </div>

                <div class="mt-4 p-3 rounded-3" style="background:#f8f9fa;font-size:.82rem;color:#888">
                    <i class="bi bi-shield-check me-1" style="color:#FF6900"></i>
                    Pesanan Anda dilindungi dan akan diproses segera setelah konfirmasi.
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
