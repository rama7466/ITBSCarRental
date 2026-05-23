@extends('layouts.admin')

@section('page-title', 'Kelola Armada Mobil')

@section('content')
<div class="row animate-fade-up">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold"><i class="fas fa-car text-primary me-2"></i>Daftar Armada Mobil</h5>
                <a href="{{ route('admin.cars.create') }}" class="btn btn-primary d-flex align-items-center">
                    <i class="fas fa-plus-circle me-2"></i> Tambah Mobil
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Visual</th>
                                <th>Detail Mobil</th>
                                <th>Kategori Jenis</th>
                                <th>Plat Nomor</th>
                                <th>Tarif / Hari</th>
                                <th>Status</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cars as $car)
                                <tr>
                                    <td class="fw-bold text-muted" style="width: 60px;">#{{ $car->id }}</td>
                                    <td style="width: 120px;">
                                        @if($car->getFirstMediaUrl('cars'))
                                            <div class="rounded-3 overflow-hidden shadow-sm" style="width: 90px; height: 60px; border: 1px solid var(--glass-border);">
                                                <img src="{{ $car->getFirstMediaUrl('cars') }}" alt="Foto {{ $car->name }}" class="w-100 h-100" style="object-fit: cover;">
                                            </div>
                                        @else
                                            <div class="rounded-3 bg-light d-flex align-items-center justify-content-center text-muted shadow-sm" style="width: 90px; height: 60px; border: 1px solid var(--glass-border);">
                                                <i class="fas fa-image fa-lg opacity-40"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark fs-6">{{ $car->name }}</div>
                                        <div class="text-muted small">{{ $car->brand }} &bull; Th. {{ $car->year }}</div>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary text-primary">{{ $car->carType->name ?? 'Tanpa Jenis' }}</span>
                                    </td>
                                    <td>
                                        <span class="font-monospace text-uppercase fw-semibold px-2 py-1 bg-light border text-dark rounded-3" style="font-size: 0.85rem; letter-spacing: 0.5px;">
                                            {{ $car->license_plate }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="fw-bold text-dark">Rp {{ number_format($car->price_per_day, 0, ',', '.') }}</span>
                                    </td>
                                    <td>
                                        @if($car->status == 'available')
                                            <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>Tersedia</span>
                                        @elseif($car->status == 'rented')
                                            <span class="badge bg-warning text-dark"><i class="fas fa-key me-1"></i>Disewa</span>
                                        @else
                                            <span class="badge bg-danger"><i class="fas fa-tools me-1"></i>Servis</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <div class="d-flex justify-content-end gap-2 px-3">
                                            <a href="{{ route('admin.cars.edit', $car->id) }}" class="btn btn-sm btn-outline-primary px-3" title="Edit Mobil">
                                                <i class="fas fa-edit me-1"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.cars.destroy', $car->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus mobil {{ $car->name }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger px-3" title="Hapus Mobil">
                                                    <i class="fas fa-trash-alt me-1"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted">
                                        <i class="fas fa-car-crash fa-3x mb-3 opacity-30"></i>
                                        <p class="mb-0 fw-semibold">Belum ada armada mobil terdaftar.</p>
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
