@extends('layouts.admin')

@section('page-title', 'Verifikasi Pembayaran')

@section('content')
<div class="row animate-fade-up">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header">
                <h5 class="mb-0 fw-bold"><i class="fas fa-wallet text-primary me-2"></i>Daftar Transaksi Pembayaran</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>ID Transaksi</th>
                                <th>Pemesanan</th>
                                <th>Pelanggan</th>
                                <th>Jumlah Bayar</th>
                                <th>Tanggal Bayar</th>
                                <th>Status</th>
                                <th>Bukti Transfer</th>
                                <th class="text-end">Aksi Verifikasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($payments as $payment)
                                <tr>
                                    <td class="fw-bold text-muted" style="width: 100px;">#PAY-{{ $payment->id }}</td>
                                    <td>
                                        <span class="fw-bold text-dark">#BOOK-{{ $payment->booking_id }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($payment->booking->user->name ?? 'Pelanggan') }}&background=F3E8FF&color=7c3aed&rounded=true" alt="Avatar" class="rounded-circle me-2" width="32" height="32">
                                            <div>
                                                <div class="fw-bold text-dark">{{ $payment->booking->user->name ?? 'Tanpa Nama' }}</div>
                                                <div class="text-muted small" style="font-size: 0.75rem;">{{ $payment->booking->user->email ?? '-' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bold text-dark">Rp {{ number_format($payment->amount, 0, ',', '.') }}</span>
                                    </td>
                                    <td>
                                        <span class="small text-muted fw-semibold">{{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}</span>
                                    </td>
                                    <td>
                                        @if($payment->status == 'pending')
                                            <span class="badge bg-warning"><i class="fas fa-hourglass-half me-1"></i>Menunggu</span>
                                        @elseif($payment->status == 'verified')
                                            <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>Terverifikasi</span>
                                        @else
                                            <span class="badge bg-danger"><i class="fas fa-times-circle me-1"></i>Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($payment->getFirstMediaUrl('payments'))
                                            <a href="{{ $payment->getFirstMediaUrl('payments') }}" target="_blank" class="btn btn-sm btn-outline-primary px-3 py-1.5" style="font-size: 0.8rem;">
                                                <i class="fas fa-image me-1"></i> Lihat Bukti
                                            </a>
                                        @else
                                            <span class="text-muted small italic"><i class="fas fa-eye-slash me-1"></i>Tidak Ada</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <div class="d-flex justify-content-end gap-2 px-3">
                                            @if($payment->status == 'pending')
                                                <form action="{{ route('admin.payments.update', $payment->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin memverifikasi pembayaran sebesar Rp {{ number_format($payment->amount, 0, ',', '.') }}?')">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="verified">
                                                    <button type="submit" class="btn btn-sm btn-success px-3">
                                                        <i class="fas fa-check me-1"></i> Setujui
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.payments.update', $payment->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menolak pembayaran ini?')">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit" class="btn btn-sm btn-danger px-3">
                                                        <i class="fas fa-times me-1"></i> Tolak
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-muted small fw-semibold px-2 py-1 bg-light rounded border">Selesai Diproses</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted">
                                        <i class="fas fa-wallet fa-3x mb-3 opacity-30"></i>
                                        <p class="mb-0 fw-semibold">Belum ada transaksi pembayaran terdaftar.</p>
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
