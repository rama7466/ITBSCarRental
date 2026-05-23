@extends('layouts.admin')

@section('page-title', 'Ubah Status Pemesanan')

@section('content')
<div class="row animate-fade-up">
    <div class="col-md-8 col-lg-6 offset-md-2 offset-lg-3">
        <div class="card border-0 shadow-sm">
            <div class="card-header">
                <h5 class="mb-0 fw-bold"><i class="fas fa-edit text-primary me-2"></i>Status Pemesanan #BOOK-{{ $booking->id }}</h5>
            </div>
            <div class="card-body">
                <div class="p-3 rounded-4 mb-4" style="background: rgba(124, 58, 237, 0.03); border: 1px solid var(--glass-border);">
                    <h6 class="fw-bold mb-3 text-dark"><i class="fas fa-info-circle text-info me-2"></i>Rincian Sewa</h6>
                    
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <span class="text-muted small d-block">Nama Pelanggan</span>
                            <span class="fw-bold text-dark"><i class="far fa-user me-1 text-muted"></i> {{ $booking->user->name }}</span>
                        </div>
                        <div class="col-sm-6">
                            <span class="text-muted small d-block">Armada Mobil</span>
                            <span class="fw-bold text-dark"><i class="fas fa-car me-1 text-muted"></i> {{ $booking->car->name }}</span>
                        </div>
                        <div class="col-sm-6">
                            <span class="text-muted small d-block">Durasi Tanggal</span>
                            <span class="fw-bold text-dark"><i class="far fa-calendar-alt me-1 text-muted"></i> {{ \Carbon\Carbon::parse($booking->start_date)->format('d M Y') }} s/d {{ \Carbon\Carbon::parse($booking->end_date)->format('d M Y') }}</span>
                        </div>
                        <div class="col-sm-6">
                            <span class="text-muted small d-block">Total Nominal</span>
                            <span class="fw-bold text-success fs-5"><i class="fas fa-tag me-1"></i>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="status" class="form-label fw-bold text-muted small">Ubah Status Pemesanan</label>
                        <select class="form-select" id="status" name="status" required style="height: 48px;">
                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                            <option value="approved" {{ $booking->status == 'approved' ? 'selected' : '' }}>Disetujui (Aktif)</option>
                            <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                            <option value="rejected" {{ $booking->status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-3 py-2 d-flex align-items-center">
                            <i class="fas fa-save me-2"></i> Simpan Status
                        </button>
                        <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-secondary px-3 py-2 d-flex align-items-center" style="border-color: rgba(0, 0, 0, 0.1) !important; color: #64748b !important;">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
