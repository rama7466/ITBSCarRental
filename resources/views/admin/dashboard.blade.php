@extends('layouts.admin')

@section('page-title', 'Dashboard Overview')

@section('content')
    <div class="row g-4 mb-4">
        <!-- Stat Card 1 -->
        <div class="col-md-6 col-xl-3">
            <div class="card h-100 border-0 shadow-sm" style="border-left: 4px solid var(--accent-color) !important;">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small fw-bold text-uppercase d-block mb-1">Total Armada</span>
                            <h3 class="fw-bold mb-0 text-dark">{{ $totalCars }}</h3>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 52px; height: 52px; background: rgba(124, 58, 237, 0.1); color: var(--accent-color);">
                            <i class="fas fa-car fa-lg"></i>
                        </div>
                    </div>
                    <div class="mt-3 pt-3 border-top" style="border-color: var(--glass-border) !important;">
                        <a href="{{ route('admin.cars.index') }}"
                            class="text-decoration-none small fw-bold d-flex align-items-center"
                            style="color: var(--accent-color);">
                            Kelola Armada <i class="fas fa-arrow-right ms-1 small"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="col-md-6 col-xl-3">
            <div class="card h-100 border-0 shadow-sm" style="border-left: 4px solid #10b981 !important;">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small fw-bold text-uppercase d-block mb-1">Pemesanan Selesai</span>
                            <h3 class="fw-bold mb-0 text-dark">{{ $completedBookings }}</h3>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 52px; height: 52px; background: rgba(16, 185, 129, 0.1); color: #10b981;">
                            <i class="fas fa-calendar-check fa-lg"></i>
                        </div>
                    </div>
                    <div class="mt-3 pt-3 border-top" style="border-color: var(--glass-border) !important;">
                        <a href="{{ route('admin.bookings.index') }}"
                            class="text-decoration-none small fw-bold d-flex align-items-center" style="color: #10b981;">
                            Lihat Riwayat <i class="fas fa-arrow-right ms-1 small"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stat Card 3 -->
        <div class="col-md-6 col-xl-3">
            <div class="card h-100 border-0 shadow-sm" style="border-left: 4px solid #f59e0b !important;">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small fw-bold text-uppercase d-block mb-1">Pemesanan Aktif</span>
                            <h3 class="fw-bold mb-0 text-dark">{{ $activeBookings }}</h3>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 52px; height: 52px; background: rgba(245, 158, 11, 0.1); color: #f59e0b;">
                            <i class="fas fa-clock fa-lg"></i>
                        </div>
                    </div>
                    <div class="mt-3 pt-3 border-top" style="border-color: var(--glass-border) !important;">
                        <a href="{{ route('admin.bookings.index') }}"
                            class="text-decoration-none small fw-bold d-flex align-items-center" style="color: #f59e0b;">
                            Proses Pemesanan <i class="fas fa-arrow-right ms-1 small"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stat Card 4 -->
        <div class="col-md-6 col-xl-3">
            <div class="card h-100 border-0 shadow-sm" style="border-left: 4px solid #8b5cf6 !important;">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small fw-bold text-uppercase d-block mb-1">Total Customer</span>
                            <h3 class="fw-bold mb-0 text-dark">{{ $totalCustomers }}</h3>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 52px; height: 52px; background: rgba(139, 92, 246, 0.1); color: #8b5cf6;">
                            <i class="fas fa-users fa-lg"></i>
                        </div>
                    </div>
                    <div class="mt-3 pt-3 border-top" style="border-color: var(--glass-border) !important;">
                        <a href="{{ route('admin.customers.index') }}"
                            class="text-decoration-none small fw-bold d-flex align-items-center" style="color: #8b5cf6;">
                            Daftar Customer <i class="fas fa-arrow-right ms-1 small"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Recent Bookings Table -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-history me-2 text-primary"></i>Aktivitas Pemesanan Terbaru
                    </h5>
                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-sm btn-outline-primary px-3">Lihat
                        Semua</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Pelanggan</th>
                                    <th>Mobil</th>
                                    <th>Tanggal Sewa</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentBookings as $booking)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($booking->user->name) }}&background=E0F2FE&color=0284c7&rounded=true"
                                                    alt="Avatar" class="rounded-circle me-2" width="32" height="32">
                                                <div>
                                                    <div class="fw-bold text-dark">{{ $booking->user->name }}</div>
                                                    <div class="text-muted small" style="font-size: 0.75rem;">
                                                        {{ $booking->user->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="fw-semibold text-dark">{{ $booking->car->name }}</span>
                                        </td>
                                        <td>
                                            <span
                                                class="small text-muted d-block">{{ \Carbon\Carbon::parse($booking->start_date)->format('d M Y') }}</span>
                                            <span class="small text-muted" style="font-size: 0.75rem;">s/d
                                                {{ \Carbon\Carbon::parse($booking->end_date)->format('d M Y') }}</span>
                                        </td>
                                        <td>
                                            <span class="fw-bold text-dark">Rp
                                                {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                                        </td>
                                        <td>
                                            @if($booking->status == 'pending')
                                                <span class="badge bg-warning">Menunggu</span>
                                            @elseif($booking->status == 'approved')
                                                <span class="badge bg-primary">Disetujui</span>
                                            @elseif($booking->status == 'rejected')
                                                <span class="badge bg-danger">Ditolak</span>
                                            @elseif($booking->status == 'completed')
                                                <span class="badge bg-success">Selesai</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.bookings.edit', $booking->id) }}"
                                                class="btn btn-sm btn-outline-primary py-1 px-2 rounded-circle"
                                                title="Detail / Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5 text-muted">
                                            <i class="fas fa-calendar-times fa-3x mb-3 opacity-30"></i>
                                            <p class="mb-0 fw-semibold">Belum ada pemesanan masuk saat ini.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions & Systems Panel -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-bolt me-2 text-warning"></i>Aksi Cepat Admin</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-3">
                        <a href="{{ route('admin.cars.create') }}"
                            class="btn btn-primary d-flex align-items-center justify-content-between py-3 px-4 shadow-sm"
                            style="border-radius: 6px;">
                            <span><i class="fas fa-plus-circle me-2"></i> Tambah Mobil Baru</span>
                            <i class="fas fa-chevron-right small"></i>
                        </a>

                        <a href="{{ route('admin.car-types.create') }}"
                            class="btn btn-outline-primary d-flex align-items-center justify-content-between py-3 px-4"
                            style="border-radius: 6px; border-color: rgba(124, 58, 237, 0.2) !important;">
                            <span class="text-dark"><i class="fas fa-folder-plus me-2 text-info"></i> Tambah Kategori
                                Jenis</span>
                            <i class="fas fa-chevron-right text-muted small"></i>
                        </a>

                        <a href="{{ route('admin.payments.index') }}"
                            class="btn btn-outline-primary d-flex align-items-center justify-content-between py-3 px-4"
                            style="border-radius: 6px; border-color: rgba(124, 58, 237, 0.2) !important;">
                            <span class="text-dark"><i class="fas fa-wallet me-2 text-success"></i> Verifikasi
                                Pembayaran</span>
                            <i class="fas fa-chevron-right text-muted small"></i>
                        </a>

                        <a href="{{ url('/') }}" target="_blank"
                            class="btn btn-outline-secondary d-flex align-items-center justify-content-between py-3 px-4"
                            style="border-radius: 6px; border-color: rgba(0, 0, 0, 0.08) !important;">
                            <span class="text-dark"><i class="fas fa-globe me-2 text-muted"></i> Kunjungi Landing
                                Page</span>
                            <i class="fas fa-external-link-alt text-muted small"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection