@extends('layouts.admin')

@section('page-title', 'Kelola Kategori Mobil')

@section('content')
<div class="row animate-fade-up">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm" style="max-width: 800px; margin: 0 auto;">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold"><i class="fas fa-tags text-primary me-2"></i>Kategori Jenis Mobil</h5>
                <a href="{{ route('admin.car-types.create') }}" class="btn btn-primary d-flex align-items-center">
                    <i class="fas fa-plus-circle me-2"></i> Tambah Kategori
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Kategori</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($carTypes as $type)
                                <tr>
                                    <td class="fw-bold text-muted" style="width: 100px;">#{{ $type->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-3 bg-primary bg-opacity-10 d-flex align-items-center justify-content-center text-primary me-3" style="width: 36px; height: 36px;">
                                                <i class="fas fa-folder fa-lg"></i>
                                            </div>
                                            <span class="fw-bold text-dark fs-6">{{ $type->name }}</span>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <div class="d-flex justify-content-end gap-2 px-3">
                                            <a href="{{ route('admin.car-types.edit', $type->id) }}" class="btn btn-sm btn-outline-primary px-3" title="Edit Kategori">
                                                <i class="fas fa-edit me-1"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.car-types.destroy', $type->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori {{ $type->name }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger px-3" title="Hapus Kategori">
                                                    <i class="fas fa-trash-alt me-1"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-5 text-muted">
                                        <i class="fas fa-folder-open fa-3x mb-3 opacity-30"></i>
                                        <p class="mb-0 fw-semibold">Belum ada kategori jenis mobil terdaftar.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
