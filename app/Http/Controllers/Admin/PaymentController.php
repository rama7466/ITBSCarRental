<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Payment;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('booking.user')->latest()->get();
        return view('admin.payments.index', compact('payments'));
    }

    public function show(Payment $payment)
    {
        $payment->load('booking.user');
        return view('admin.payments.show', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'status' => 'required|in:pending,verified,rejected'
        ]);

        $payment->update(['status' => $request->status]);

        // Auto-update booking status & car availability
        if ($request->status === 'verified') {
            $payment->booking->update(['status' => 'approved']);
            $payment->booking->car->update(['status' => 'rented']);
        } elseif ($request->status === 'rejected') {
            $payment->booking->update(['status' => 'rejected']);
            $payment->booking->car->update(['status' => 'available']);
        }

        return redirect()->route('admin.payments.index')->with('success', 'Status pembayaran dan status pemesanan berhasil diperbarui.');
    }
}
