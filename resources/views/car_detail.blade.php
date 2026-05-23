@extends('layouts.front')

@section('content')
<div class="container py-5 mt-4">
    <div class="row">
        <div class="col-12 mb-4">
            <a href="{{ url('/#cars-section') }}" class="text-muted text-decoration-none hover:text-dark" style="transition: color 0.3s ease;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#cbd5e1'">
                <i class="fas fa-arrow-left me-2"></i> Back to Fleet
            </a>
        </div>
    </div>

    <div class="row g-5">
        <!-- Car Image -->
        <div class="col-lg-7 animate-fade-up">
            <div class="glass-card p-2 h-100 d-flex align-items-center justify-content-center" style="background: rgba(0,0,0,0.2);">
                @if($car->getFirstMediaUrl('cars'))
                    <img src="{{ $car->getFirstMediaUrl('cars') }}" alt="{{ $car->name }}" class="img-fluid rounded-4 w-100" style="max-height: 500px; object-fit: cover;">
                @else
                    <img src="https://images.unsplash.com/photo-1503376760302-8a22b7d42294?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Default Car" class="img-fluid rounded-4 w-100" style="max-height: 500px; object-fit: cover;">
                @endif
            </div>
        </div>

        <!-- Car Details -->
        <div class="col-lg-5 animate-fade-up delay-100">
            <div class="glass-card p-4 p-md-5 h-100 d-flex flex-column">
                <div class="mb-4">
                    <span class="badge badge-premium mb-2">{{ $car->carType->name ?? 'Premium' }}</span>
                    <h2 class="text-dark font-bold mb-1">{{ $car->name }}</h2>
                    <p class="text-muted fs-5 mb-0">{{ $car->brand }} &bull; {{ $car->year }}</p>
                </div>

                <div class="mb-4">
                    <h3 class="text-dark font-bold mb-0" style="color: var(--accent-color) !important;">
                        Rp {{ number_format($car->price_per_day, 0, ',', '.') }}
                        <span class="text-muted fs-6 fw-normal">/ day</span>
                    </h3>
                </div>

                <div class="mb-4">
                    <h5 class="text-dark mb-3">Specifications</h5>
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 rounded p-2 me-3" style="background: rgba(124, 58, 237, 0.1) !important;">
                                    <i class="fas fa-cogs" style="color: var(--accent-color); width: 20px; text-align: center;"></i>
                                </div>
                                <div>
                                    <p class="text-muted mb-0 small">Transmission</p>
                                    <h6 class="text-dark mb-0">Automatic</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 rounded p-2 me-3" style="background: rgba(124, 58, 237, 0.1) !important;">
                                    <i class="fas fa-user-friends" style="color: var(--accent-color); width: 20px; text-align: center;"></i>
                                </div>
                                <div>
                                    <p class="text-muted mb-0 small">Seats</p>
                                    <h6 class="text-dark mb-0">4+ Persons</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 rounded p-2 me-3" style="background: rgba(124, 58, 237, 0.1) !important;">
                                    <i class="fas fa-gas-pump" style="color: var(--accent-color); width: 20px; text-align: center;"></i>
                                </div>
                                <div>
                                    <p class="text-muted mb-0 small">Fuel</p>
                                    <h6 class="text-dark mb-0">Gasoline</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 rounded p-2 me-3" style="background: rgba(124, 58, 237, 0.1) !important;">
                                    <i class="fas fa-id-card" style="color: var(--accent-color); width: 20px; text-align: center;"></i>
                                </div>
                                <div>
                                    <p class="text-muted mb-0 small">Plate</p>
                                    <h6 class="text-dark mb-0">{{ $car->license_plate }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4 flex-grow-1">
                    <h5 class="text-dark mb-2">Description</h5>
                    <p class="text-muted">{{ $car->description ?? 'Experience luxury and comfort with this premium vehicle. Maintained to the highest standards for your peace of mind.' }}</p>
                </div>

                <div>
                    @if($car->status == 'available')
                        @auth
                            <button type="button" class="btn btn-premium w-100 py-3 fs-5" data-bs-toggle="modal" data-bs-target="#bookingModal">
                                <i class="fas fa-calendar-check me-2"></i> Book Now
                            </button>
                        @else
                            <a href="{{ route('login') }}?redirect={{ urlencode(request()->getRequestUri() . '?book=true') }}" class="btn btn-premium w-100 py-3 fs-5">
                                <i class="fas fa-sign-in-alt me-2"></i> Login to Book
                            </a>
                        @endauth
                    @else
                        <button class="btn btn-secondary w-100 py-3 fs-5" disabled>
                            <i class="fas fa-ban me-2"></i> Currently Unavailable
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@auth
<!-- Booking Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content glass-card" style="background: var(--secondary-bg);">
            <div class="modal-header border-secondary">
                <h5 class="modal-title text-dark" id="bookingModalLabel">Book {{ $car->name }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('user.book.store', $car->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="text-muted mb-2">Tanggal Mulai Sewa</label>
                        <input type="date" name="start_date" id="start_date" class="form-control form-control-glass" required min="{{ date('Y-m-d') }}">
                    </div>
                    <div class="mb-3">
                        <label class="text-muted mb-2">Tanggal Selesai Sewa</label>
                        <input type="date" name="end_date" id="end_date" class="form-control form-control-glass" required min="{{ date('Y-m-d') }}">
                    </div>
                    <div class="alert alert-info border-0 mt-3 d-flex align-items-center mb-0" style="background: rgba(124, 58, 237, 0.1); color: #6d28d9; border-radius: 12px;">
                        <i class="fas fa-info-circle me-2 fa-lg" style="color: var(--accent-color);"></i>
                        <div>
                            Tarif sewa mobil: <strong>Rp {{ number_format($car->price_per_day, 0, ',', '.') }}</strong> per hari.
                        </div>
                    </div>

                    <!-- Dynamic Price Calculation Box -->
                    <div id="price-calc-box" class="p-3 rounded-4 mt-3 d-none" style="background: rgba(16, 185, 129, 0.08); border: 1px dashed rgba(16, 185, 129, 0.3); color: #065f46; border-radius: 12px; transition: all 0.3s ease;">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="small fw-semibold text-muted">Durasi Sewa:</span>
                            <span class="fw-bold" id="calc-days" style="color: #0f172a;">0 hari</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center pt-2 border-top" style="border-color: rgba(16, 185, 129, 0.2) !important;">
                            <span class="small fw-bold text-dark">Estimasi Total Harga:</span>
                            <span class="fs-5 fw-bold text-success" id="calc-total">Rp 0</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-outline-secondary text-dark border-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-premium">Confirm Booking</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endauth

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-open modal if redirect query parameter book=true exists
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('book') && urlParams.get('book') === 'true') {
            const modalEl = document.getElementById('bookingModal');
            if (modalEl) {
                const bookingModal = new bootstrap.Modal(modalEl);
                bookingModal.show();
            }
        }

        // Live price calculation logic
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');
        const priceCalcBox = document.getElementById('price-calc-box');
        const calcDaysSpan = document.getElementById('calc-days');
        const calcTotalSpan = document.getElementById('calc-total');
        const pricePerDay = {{ $car->price_per_day }};

        function calculateTotalPrice() {
            const startVal = startDateInput.value;
            const endVal = endDateInput.value;

            if (startVal && endVal) {
                const startDate = new Date(startVal);
                const endDate = new Date(endVal);

                if (endDate >= startDate) {
                    // Calculate days difference (inclusive of both start and end days)
                    const timeDiff = endDate.getTime() - startDate.getTime();
                    const diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)) + 1;

                    const totalPrice = diffDays * pricePerDay;

                    // Update UI elements
                    calcDaysSpan.textContent = diffDays + ' hari';
                    calcTotalSpan.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(totalPrice);
                    priceCalcBox.classList.remove('d-none');
                } else {
                    priceCalcBox.classList.add('d-none');
                }
            } else {
                priceCalcBox.classList.add('d-none');
            }
        }

        if (startDateInput && endDateInput) {
            startDateInput.addEventListener('change', function() {
                // Restrict end date to be at least start date
                endDateInput.min = startDateInput.value;
                calculateTotalPrice();
            });
            endDateInput.addEventListener('change', calculateTotalPrice);
        }
    });
</script>
@endpush
@endsection
