@extends('layouts.admin')

@section('page-title', 'Daftar Pelanggan')

@section('content')
<div class="row animate-fade-up">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm" style="max-width: 900px; margin: 0 auto;">
            <div class="card-header">
                <h5 class="mb-0 fw-bold"><i class="fas fa-users text-primary me-2"></i>Data Pelanggan Terdaftar</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>ID User</th>
                                <th>Nama Pelanggan</th>
                                <th>Alamat Email</th>
                                <th>Tanggal Bergabung</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($customers as $customer)
                                <tr>
                                    <td class="fw-bold text-muted" style="width: 100px;">#USR-{{ $customer->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($customer->name) }}&background=E0F2FE&color=0284c7&rounded=true" alt="Avatar" class="rounded-circle me-2" width="32" height="32">
                                            <span class="fw-bold text-dark fs-6">{{ $customer->name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-semibold text-muted">{{ $customer->email }}</span>
                                    </td>
                                    <td>
                                        <span class="small text-muted fw-semibold">
                                            <i class="far fa-calendar-alt text-muted me-1"></i> {{ $customer->created_at->format('d M Y') }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary text-primary" style="font-size: 0.75rem;">Pelanggan</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="fas fa-user-slash fa-3x mb-3 opacity-30"></i>
                                        <p class="mb-0 fw-semibold">Belum ada pelanggan terdaftar.</p>
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
