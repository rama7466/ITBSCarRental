<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Booking;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'car', 'payment'])->latest()->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $booking->load(['user', 'car', 'payment']);
        return view('admin.bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        return view('admin.bookings.edit', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected,completed'
        ]);

        $booking->update(['status' => $request->status]);
        
        if ($request->status == 'approved') {
            $booking->car->update(['status' => 'rented']);
        } elseif ($request->status == 'completed' || $request->status == 'rejected') {
            $booking->car->update(['status' => 'available']);
        }

        return redirect()->route('admin.bookings.index')->with('success', 'Status pemesanan berhasil diperbarui.');
    }
}
