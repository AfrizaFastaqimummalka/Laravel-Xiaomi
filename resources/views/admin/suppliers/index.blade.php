@extends('layouts.admin')

@section('title', 'Manajemen Supplier')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="fw-bold mb-0">Daftar Supplier</h5>
        <small class="text-muted">{{ $suppliers->total() }} supplier</small>
    </div>
    <a href="{{ route('admin.suppliers.create') }}" class="btn btn-sm fw-semibold" style="background:#FF6900;color:#fff;border:none">
        <i class="bi bi-plus-lg me-1"></i>Tambah Supplier
    </a>
</div>

<div class="card border-0 shadow-sm rounded-3">
    <div class="card-body p-0">
        @if($suppliers->isEmpty())
            <div class="text-center py-5 text-muted">
                <i class="bi bi-truck" style="font-size:2.8rem;color:#ddd"></i>
                <p class="mt-2 mb-0">Belum ada supplier.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background:#f8f9fa">
                        <tr>
                            <th class="px-4 py-3">#</th>
                            <th class="py-3">Nama</th>
                            <th class="py-3">Telepon</th>
                            <th class="py-3">Email</th>
                            <th class="py-3">Alamat</th>
                            <th class="py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($suppliers as $supplier)
                            <tr>
                                <td class="px-4 text-muted small">{{ $supplier->id }}</td>
                                <td class="fw-semibold">{{ $supplier->name }}</td>
                                <td class="text-muted small">{{ $supplier->phone ?: '-' }}</td>
                                <td class="text-muted small">{{ $supplier->email ?: '-' }}</td>
                                <td class="text-muted small">{{ $supplier->address ?: '-' }}</td>
                                <td class="text-center">
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="{{ route('admin.suppliers.edit', $supplier) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.suppliers.destroy', $supplier) }}" onsubmit="return confirm('Hapus supplier ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-3 border-top">
                {{ $suppliers->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
