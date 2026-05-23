@extends('layouts.admin')

@section('page-title', 'Kelola Pemesanan Mobil')

@section('content')
<div class="row animate-fade-up">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header">
                <h5 class="mb-0 fw-bold"><i class="fas fa-calendar-alt text-primary me-2"></i>Daftar Pemesanan Mobil</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pelanggan</th>
                                <th>Mobil</th>
                                <th>Tanggal Sewa</th>
                                <th>Total Harga</th>
                                <th>Status Pemesanan</th>
                                <th>Status Pembayaran</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $booking)
                                <tr>
                                    <td class="fw-bold text-muted" style="width: 70px;">#{{ $booking->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($booking->user->name) }}&background=E0F2FE&color=0284c7&rounded=true" alt="Avatar" class="rounded-circle me-2" width="32" height="32">
                                            <div>
                                                <div class="fw-bold text-dark">{{ $booking->user->name }}</div>
                                                <div class="text-muted small" style="font-size: 0.75rem;">{{ $booking->user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $booking->car->name }}</div>
                                        <span class="font-monospace text-uppercase small text-muted">{{ $booking->car->license_plate }}</span>
                                    </td>
                                    <td>
                                        <div class="small text-dark fw-semibold">{{ \Carbon\Carbon::parse($booking->start_date)->format('d M Y') }}</div>
                                        <div class="small text-muted" style="font-size: 0.75rem;">s/d {{ \Carbon\Carbon::parse($booking->end_date)->format('d M Y') }}</div>
                                    </td>
                                    <td>
                                        <span class="fw-bold text-dark">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                                    </td>
                                    <td>
                                        @if($booking->status == 'pending')
                                            <span class="badge bg-warning"><i class="fas fa-hourglass-half me-1"></i>Menunggu</span>
                                        @elseif($booking->status == 'approved')
                                            <span class="badge bg-primary"><i class="fas fa-check-circle me-1"></i>Disetujui</span>
                                        @elseif($booking->status == 'completed')
                                            <span class="badge bg-success"><i class="fas fa-flag-checkered me-1"></i>Selesai</span>
                                        @else
                                            <span class="badge bg-danger"><i class="fas fa-times-circle me-1"></i>Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($booking->payment)
                                            @if($booking->payment->status == 'pending')
                                                <span class="badge bg-warning"><i class="fas fa-wallet me-1"></i>Verifikasi</span>
                                            @elseif($booking->payment->status == 'verified')
                                                <span class="badge bg-success"><i class="fas fa-check me-1"></i>Lunas</span>
                                            @else
                                                <span class="badge bg-danger"><i class="fas fa-ban me-1"></i>Ditolak</span>
                                            @endif

                                            @if($booking->payment->getFirstMediaUrl('payments'))
                                                <div class="mt-1">
                                                    <a href="{{ $booking->payment->getFirstMediaUrl('payments') }}" target="_blank" class="text-primary small fw-bold text-decoration-none" style="font-size: 0.75rem;">
                                                        <i class="fas fa-image me-1"></i> Lihat Bukti
                                                    </a>
                                                </div>
                                            @endif
                                        @else
                                            <span class="badge bg-secondary" style="background-color: rgba(100, 116, 139, 0.1) !important; color: #64748b !important;"><i class="fas fa-exclamation-triangle me-1"></i>Belum Bayar</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <div class="px-3">
                                            <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-sm btn-outline-primary px-3">
                                                <i class="fas fa-cog me-1"></i> Ubah Status
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted">
                                        <i class="fas fa-calendar-times fa-3x mb-3 opacity-30"></i>
                                        <p class="mb-0 fw-semibold">Belum ada data pemesanan terdaftar.</p>
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
