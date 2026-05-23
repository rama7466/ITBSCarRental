@extends('layouts.front')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center align-items-center min-vh-75 animate-fade-up">
        <div class="col-md-6 col-lg-5">
            <div class="glass-card p-4 p-md-5 shadow-lg">
                <div class="text-center mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle mb-3" style="width: 70px; height: 70px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid rgba(0,0,0,0.05);">
                        <i class="fas fa-user-plus fa-2x" style="color: var(--accent-color);"></i>
                    </div>
                    <h3 class="fw-bold mb-1" style="background: linear-gradient(to right, #0f172a, #334155); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Daftar Akun</h3>
                    <p class="text-muted small">Buat akun gratis untuk mulai menyewa mobil impian Anda</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold text-muted small">{{ __('Nama Lengkap') }}</label>
                        <div class="input-group">
                            <span class="input-group-text border-end-0 bg-transparent text-muted px-3" style="border: 1px solid rgba(0,0,0,0.1); border-radius: 10px 0 0 10px; transition: all 0.3s ease;">
                                <i class="fas fa-user"></i>
                            </span>
                            <input id="name" type="text" class="form-control form-control-glass border-start-0 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nama Lengkap" style="border-radius: 0 10px 10px 0; padding-left: 5px; height: 46px;">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold text-muted small">{{ __('Alamat Email') }}</label>
                        <div class="input-group">
                            <span class="input-group-text border-end-0 bg-transparent text-muted px-3" style="border: 1px solid rgba(0,0,0,0.1); border-radius: 10px 0 0 10px; transition: all 0.3s ease;">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input id="email" type="email" class="form-control form-control-glass border-start-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="nama@email.com" style="border-radius: 0 10px 10px 0; padding-left: 5px; height: 46px;">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold text-muted small">{{ __('Password') }}</label>
                        <div class="input-group">
                            <span class="input-group-text border-end-0 bg-transparent text-muted px-3" style="border: 1px solid rgba(0,0,0,0.1); border-radius: 10px 0 0 10px; transition: all 0.3s ease;">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input id="password" type="password" class="form-control form-control-glass border-start-0 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter" style="border-radius: 0 10px 10px 0; padding-left: 5px; height: 46px;">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="password-confirm" class="form-label fw-semibold text-muted small">{{ __('Konfirmasi Password') }}</label>
                        <div class="input-group">
                            <span class="input-group-text border-end-0 bg-transparent text-muted px-3" style="border: 1px solid rgba(0,0,0,0.1); border-radius: 10px 0 0 10px; transition: all 0.3s ease;">
                                <i class="fas fa-shield-halved"></i>
                            </span>
                            <input id="password-confirm" type="password" class="form-control form-control-glass border-start-0" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password" style="border-radius: 0 10px 10px 0; padding-left: 5px; height: 46px;">
                        </div>
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-premium w-100 py-2.5 d-flex align-items-center justify-content-center" style="height: 46px; font-size: 1rem;">
                            {{ __('Daftar') }} <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>

                    <div class="text-center mt-4">
                        <p class="text-muted small mb-0">Sudah punya akun? 
                            <a href="{{ route('login') }}" class="text-decoration-none fw-bold" style="color: var(--accent-color);">Login Sekarang</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .min-vh-75 {
        min-height: 70vh;
    }
    .form-control-glass {
        border-left: 0 !important;
    }
    .input-group:focus-within .input-group-text {
        border-color: var(--accent-color) !important;
        color: var(--accent-color) !important;
    }
    .input-group:focus-within .form-control-glass {
        border-color: var(--accent-color) !important;
    }
</style>
@endsection
