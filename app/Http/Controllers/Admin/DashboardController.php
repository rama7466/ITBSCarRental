<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Car;
use App\Models\Booking;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCars = Car::count();
        $completedBookings = Booking::where('status', 'completed')->count();
        $activeBookings = Booking::whereIn('status', ['pending', 'approved'])->count();
        $totalCustomers = User::where('role', 'user')->count();
        $recentBookings = Booking::with(['user', 'car'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalCars', 'completedBookings', 'activeBookings', 'totalCustomers', 'recentBookings'));
    }
}
