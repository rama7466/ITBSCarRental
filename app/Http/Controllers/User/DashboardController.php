<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('user_id', auth()->id())->latest()->get();
        return view('user.dashboard', compact('bookings'));
    }
}
