@extends('layouts.admin')

@section('title', 'Manajemen Kategori')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="fw-bold mb-0">Daftar Kategori</h5>
        <small class="text-muted">{{ $categories->total() }} kategori</small>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-sm fw-semibold" style="background:#FF6900;color:#fff;border:none">
        <i class="bi bi-plus-lg me-1"></i>Tambah Kategori
    </a>
</div>

<div class="card border-0 shadow-sm rounded-3">
    <div class="card-body p-0">
        @if($categories->isEmpty())
            <div class="text-center py-5 text-muted">
                <i class="bi bi-tags" style="font-size:2.8rem;color:#ddd"></i>
                <p class="mt-2 mb-0">Belum ada kategori.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background:#f8f9fa">
                        <tr>
                            <th class="px-4 py-3">#</th>
                            <th class="py-3">Nama</th>
                            <th class="py-3">Deskripsi</th>
                            <th class="py-3">Dibuat</th>
                            <th class="py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td class="px-4 text-muted small">{{ $category->id }}</td>
                                <td class="fw-semibold">{{ $category->name }}</td>
                                <td class="text-muted small">{{ $category->description ?: '-' }}</td>
                                <td class="text-muted small">{{ $category->created_at->format('d M Y') }}</td>
                                <td class="text-center">
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" onsubmit="return confirm('Hapus kategori ini?')">
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
                {{ $categories->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
