@extends('layouts.admin')

@section('page-title', 'Detail Pesan Masuk')

@section('content')
<div class="row animate-fade-up">
    <div class="col-md-8 offset-md-2 col-lg-6 offset-lg-3">
        <div class="card border-0 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold"><i class="fas fa-envelope text-primary me-2"></i>Detail Pesan #MSG-{{ $contact->id }}</h5>
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-secondary btn-sm py-1 px-3 d-flex align-items-center gap-1" style="border-radius: 6px;">
                    <i class="fas fa-arrow-left small"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                <div class="p-3 rounded-4 mb-4" style="background: rgba(124, 58, 237, 0.03); border: 1px solid var(--glass-border);">
                    <h6 class="fw-bold mb-3 text-dark"><i class="fas fa-info-circle text-primary me-2"></i>Informasi Pengirim</h6>
                    
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <span class="text-muted small d-block">Nama Pengirim</span>
                            <span class="fw-bold text-dark">
                                <i class="far fa-user me-1 text-muted"></i> 
                                {{ $contact->name ?? ($contact->user ? $contact->user->name : 'Guest') }}
                            </span>
                        </div>
                        <div class="col-sm-6">
                            <span class="text-muted small d-block">Alamat Email</span>
                            <span class="fw-bold text-dark">
                                <i class="far fa-envelope me-1 text-muted"></i> 
                                {{ $contact->email ?? ($contact->user ? $contact->user->email : '-') }}
                            </span>
                        </div>
                        <div class="col-sm-6">
                            <span class="text-muted small d-block">Waktu Masuk</span>
                            <span class="fw-bold text-dark">
                                <i class="far fa-calendar-alt me-1 text-muted"></i> 
                                {{ $contact->created_at->format('d M Y - H:i') }} ({{ $contact->created_at->diffForHumans() }})
                            </span>
                        </div>
                        <div class="col-sm-6">
                            <span class="text-muted small d-block">Status</span>
                            @if(!$contact->is_read)
                                <span class="badge bg-danger text-danger mt-1" style="font-size: 0.72rem; background-color: rgba(239, 68, 68, 0.1) !important; color: #ef4444 !important;">Belum Dibaca</span>
                            @else
                                <span class="badge bg-success text-success mt-1" style="font-size: 0.72rem; background-color: rgba(16, 185, 129, 0.1) !important; color: #10b981 !important;">Dibaca</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <h6 class="fw-bold mb-2 text-dark"><i class="fas fa-comment-alt text-primary me-2"></i>Isi Pesan</h6>
                    <div class="p-3 bg-light rounded text-dark fs-6" style="min-height: 120px; white-space: pre-line; border: 1px solid var(--glass-border); line-height: 1.6;">
                        {{ $contact->message }}
                    </div>
                </div>

                <div class="d-flex justify-content-between border-top pt-3" style="border-color: var(--glass-border) !important;">
                    <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger d-flex align-items-center gap-1" style="border-radius: 6px;">
                            <i class="fas fa-trash-alt"></i> Hapus Pesan
                        </button>
                    </form>
                    
                    <a href="mailto:{{ $contact->email ?? ($contact->user ? $contact->user->email : '') }}?subject=Re:%20ITBSCarRental%20Inquiry" class="btn btn-primary d-flex align-items-center gap-1" style="border-radius: 6px;">
                        <i class="fas fa-reply"></i> Balas via Email
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
