@extends('layouts.app')

@section('title', 'Pesanan Berhasil')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card border-0 shadow-sm rounded-4 text-center p-5">
            <div class="mb-4">
                <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                     style="width:90px;height:90px;background:#fff0e6">
                    <i class="bi bi-check-circle-fill" style="font-size:3rem;color:#FF6900"></i>
                </div>
                <h3 class="fw-bold mb-1">Pesanan Berhasil! 🎉</h3>
                <p class="text-muted">Terima kasih, <strong>{{ $order->buyer_name }}</strong>. Pesananmu sedang diproses.</p>
            </div>

            <div class="card border-0 rounded-3 mb-4" style="background:#f8f9fa">
                <div class="card-body p-4 text-start">
                    <h6 class="fw-bold mb-3 text-center pb-2 border-bottom">Detail Pesanan #{{ $order->id }}</h6>

                    <div class="row g-2 mb-3">
                        <div class="col-5 text-muted small">Nama</div>
                        <div class="col-7 small fw-semibold">{{ $order->buyer_name }}</div>

                        <div class="col-5 text-muted small">Telepon</div>
                        <div class="col-7 small fw-semibold">{{ $order->phone }}</div>

                        <div class="col-5 text-muted small">Alamat</div>
                        <div class="col-7 small fw-semibold">{{ $order->address }}</div>

                        <div class="col-5 text-muted small">Pembayaran</div>
                        <div class="col-7 small fw-semibold text-capitalize">{{ $order->payment_method }}</div>

                        <div class="col-5 text-muted small">Status</div>
                        <div class="col-7">
                            <span class="badge" style="background:#fff3cd;color:#856404">
                                Menunggu Konfirmasi
                            </span>
                        </div>
                    </div>

                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold">Total Pembayaran</span>
                        <span class="fw-bold fs-5" style="color:#FF6900">{{ $order->formatted_total }}</span>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-3 justify-content-center">
                <a href="{{ route('shop.index') }}" class="btn btn-xiaomi px-4 py-2">
                    <i class="bi bi-shop me-2"></i>Lanjut Belanja
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
