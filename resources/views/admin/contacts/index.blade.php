@extends('layouts.admin')

@section('page-title', 'Pesan Masuk')

@section('content')
<div class="row animate-fade-up">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm" style="max-width: 1000px; margin: 0 auto;">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold"><i class="fas fa-envelope text-primary me-2"></i>Pesan Masuk dari Pengguna</h5>
                <span class="badge bg-primary text-primary">{{ $contacts->count() }} Pesan</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pengirim</th>
                                <th>Email</th>
                                <th>Ringkasan Pesan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($contacts as $contact)
                                <tr style="{{ !$contact->is_read ? 'background-color: rgba(124, 58, 237, 0.02);' : '' }}">
                                    <td class="fw-bold text-muted" style="width: 80px;">#MSG-{{ $contact->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @php
                                                $avatarName = $contact->name ?? ($contact->user ? $contact->user->name : 'Guest');
                                                $avatarColor = !$contact->is_read ? '7c3aed' : '64748b';
                                                $avatarBg = !$contact->is_read ? 'F3E8FF' : 'F1F5F9';
                                            @endphp
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($avatarName) }}&background={{ $avatarBg }}&color={{ $avatarColor }}&rounded=true" alt="Avatar" class="rounded-circle me-2" width="32" height="32">
                                            <span class="{{ !$contact->is_read ? 'fw-bold text-dark' : 'text-muted' }}">{{ $avatarName }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="small {{ !$contact->is_read ? 'fw-bold text-dark' : 'text-muted' }}">{{ $contact->email ?? ($contact->user ? $contact->user->email : '-') }}</span>
                                    </td>
                                    <td>
                                        <span class="text-truncate d-inline-block {{ !$contact->is_read ? 'fw-bold text-dark' : 'text-muted' }}" style="max-width: 250px;">
                                            {{ Str::limit($contact->message, 45) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="small text-muted fw-semibold">
                                            <i class="far fa-clock me-1"></i> {{ $contact->created_at->diffForHumans() }}
                                        </span>
                                    </td>
                                    <td>
                                        @if(!$contact->is_read)
                                            <span class="badge bg-danger text-danger" style="font-size: 0.72rem; background-color: rgba(239, 68, 68, 0.1) !important; color: #ef4444 !important;">Belum Dibaca</span>
                                        @else
                                            <span class="badge bg-success text-success" style="font-size: 0.72rem; background-color: rgba(16, 185, 129, 0.1) !important; color: #10b981 !important;">Dibaca</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <div class="d-flex justify-content-end gap-2 px-3">
                                            <a href="{{ route('admin.contacts.show', $contact->id) }}" class="btn btn-outline-primary btn-sm py-1 px-2 d-flex align-items-center gap-1" style="border-radius: 6px;">
                                                <i class="fas fa-eye small"></i> Detail
                                            </a>
                                            <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm py-1 px-2 d-flex align-items-center gap-1" style="border-radius: 6px;">
                                                    <i class="fas fa-trash-alt small"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="fas fa-inbox fa-3x mb-3 opacity-30"></i>
                                        <p class="mb-0 fw-semibold">Tidak ada pesan masuk.</p>
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
