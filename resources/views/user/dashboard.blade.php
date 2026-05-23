@extends('layouts.front')

@section('content')
<div class="container py-5 mt-4">
    <div class="row mb-4 align-items-center">
        <div class="col-md-8 animate-fade-up">
            <h2 class="text-dark font-bold">My Dashboard</h2>
            <p class="text-muted mb-0">Manage your bookings and payments</p>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0 animate-fade-up">
            <a href="{{ route('logout') }}" class="btn btn-outline-danger px-4 py-2 rounded-pill shadow-sm"
               onclick="event.preventDefault(); document.getElementById('logout-form-dashboard').submit();">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
            </a>
            <form id="logout-form-dashboard" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-12 animate-fade-up delay-100">
            <div class="glass-card p-4">
                <h4 class="text-dark mb-4">Recent Bookings</h4>
                
                @if($bookings->isEmpty())
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-calendar-times fa-3x mb-3 opacity-50"></i>
                        <h5>You have no bookings yet.</h5>
                        <a href="{{ url('/#cars-section') }}" class="btn btn-outline-premium mt-3">Browse Cars</a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover" style="background: transparent;">
                            <thead>
                                <tr>
                                    <th class="border-secondary text-muted">Booking ID</th>
                                    <th class="border-secondary text-muted">Car</th>
                                    <th class="border-secondary text-muted">Period</th>
                                    <th class="border-secondary text-muted">Total Price</th>
                                    <th class="border-secondary text-muted">Status</th>
                                    <th class="border-secondary text-muted">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $booking)
                                    <tr>
                                        <td class="border-secondary align-middle">#{{ $booking->id }}</td>
                                        <td class="border-secondary align-middle">
                                            {{ $booking->car->name }} <br>
                                            <small class="text-muted">{{ $booking->car->license_plate }}</small>
                                        </td>
                                        <td class="border-secondary align-middle">
                                            {{ \Carbon\Carbon::parse($booking->start_date)->format('d M') }} - {{ \Carbon\Carbon::parse($booking->end_date)->format('d M Y') }}
                                        </td>
                                        <td class="border-secondary align-middle">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                        <td class="border-secondary align-middle">
                                            @if($booking->status == 'pending')
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @elseif($booking->status == 'approved')
                                                <span class="badge bg-primary" style="background: var(--accent-color) !important; color: #000 !important;">Approved</span>
                                            @elseif($booking->status == 'completed')
                                                <span class="badge bg-success">Completed</span>
                                            @else
                                                <span class="badge bg-danger">Rejected</span>
                                            @endif
                                        </td>
                                        <td class="border-secondary align-middle">
                                            <a href="{{ route('user.book.show', $booking->id) }}" class="btn btn-sm btn-outline-info">Details</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
