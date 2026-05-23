@extends('layouts.front')

@section('content')
<div class="container py-5 mt-4">
    <div class="row mb-4">
        <div class="col-12">
            <a href="{{ route('user.dashboard') }}" class="text-muted text-decoration-none hover:text-dark" style="transition: color 0.3s ease;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#cbd5e1'">
                <i class="fas fa-arrow-left me-2"></i> Back to Dashboard
            </a>
        </div>
    </div>

    <div class="row g-4">
        <!-- Booking Details -->
        <div class="col-lg-7 animate-fade-up">
            <div class="glass-card p-4 p-md-5 h-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-dark font-bold mb-0">Booking #{{ $booking->id }}</h3>
                    <div>
                        @if($booking->status == 'pending')
                            <span class="badge bg-warning text-dark fs-6">Pending</span>
                        @elseif($booking->status == 'approved')
                            <span class="badge bg-primary fs-6" style="background: var(--accent-color) !important; color: #000 !important;">Approved</span>
                        @elseif($booking->status == 'completed')
                            <span class="badge bg-success fs-6">Completed</span>
                        @else
                            <span class="badge bg-danger fs-6">Rejected</span>
                        @endif
                    </div>
                </div>

                <div class="row mb-4 border-bottom border-secondary pb-4">
                    <div class="col-md-4">
                        <div class="text-muted small mb-1">Car Model</div>
                        <div class="text-dark font-bold">{{ $booking->car->name }}</div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-muted small mb-1">Start Date</div>
                        <div class="text-dark font-bold">{{ \Carbon\Carbon::parse($booking->start_date)->format('d M Y') }}</div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-muted small mb-1">End Date</div>
                        <div class="text-dark font-bold">{{ \Carbon\Carbon::parse($booking->end_date)->format('d M Y') }}</div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <div class="text-muted small mb-1">Total Amount</div>
                        <h4 class="text-dark font-bold mb-0" style="color: var(--accent-color) !important;">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</h4>
                    </div>
                </div>

                <div class="bg-primary bg-opacity-10 rounded p-3" style="background: rgba(124, 58, 237, 0.05) !important;">
                    <h6 class="text-dark mb-2"><i class="fas fa-info-circle me-2" style="color: var(--accent-color)"></i> Important Information</h6>
                    <ul class="text-muted small mb-0 ps-3">
                        <li>Please bring your valid ID and Driver's License upon pickup.</li>
                        <li>Payment must be verified before the car can be handed over.</li>
                        <li>Any damages during the rental period are subject to additional charges.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Payment Section -->
        <div class="col-lg-5 animate-fade-up delay-100">
            <div class="glass-card p-4 p-md-5 h-100">
                <h4 class="text-dark font-bold mb-4">Payment Status</h4>

                @if(session('success'))
                    <div class="alert alert-success bg-success bg-opacity-10 border-success text-success mb-4" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    </div>
                @endif

                @if($booking->payment)
                    <div class="text-center mb-4">
                        @if($booking->payment->status == 'pending')
                            <i class="fas fa-hourglass-half fa-3x text-warning mb-3"></i>
                            <h5 class="text-dark">Verification in Progress</h5>
                            <p class="text-muted small">Your payment proof has been uploaded and is waiting for admin verification.</p>
                        @elseif($booking->payment->status == 'verified')
                            <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                            <h5 class="text-dark">Payment Verified</h5>
                            <p class="text-muted small">Your payment has been successfully verified. Enjoy your ride!</p>
                        @else
                            <i class="fas fa-times-circle fa-3x text-danger mb-3"></i>
                            <h5 class="text-dark">Payment Rejected</h5>
                            <p class="text-muted small">Your payment was rejected. Please re-upload a valid proof of payment.</p>
                        @endif

                        @if($booking->payment->getFirstMediaUrl('payments'))
                            <a href="{{ $booking->payment->getFirstMediaUrl('payments') }}" target="_blank" class="btn btn-sm btn-outline-info mt-2">View Uploaded Proof</a>
                        @endif
                    </div>
                @endif

                @if(!$booking->payment || $booking->payment->status == 'rejected')
                    <hr class="border-secondary mb-4">
                    <h6 class="text-dark mb-3">Upload Payment Proof</h6>
                    <form action="{{ route('user.payment.upload', $booking->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="text-muted small mb-2">Select Image (Max 2MB)</label>
                            <input class="form-control form-control-glass @error('proof') is-invalid @enderror" type="file" name="proof" accept="image/*" required>
                            @error('proof') <span class="text-danger small mt-1">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="btn btn-premium w-100">
                            <i class="fas fa-upload me-2"></i> Upload Proof
                        </button>
                    </form>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
