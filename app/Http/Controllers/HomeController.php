<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Car;
use App\Models\Contact;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Car::where('status', 'available');

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'ilike', '%' . $request->search . '%')
                  ->orWhere('brand', 'ilike', '%' . $request->search . '%');
        }

        $cars = $query->latest()->get();

        return view('welcome', compact('cars'));
    }

    public function showCar(Car $car)
    {
        return view('car_detail', compact('car'));
    }

    public function contact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string'
        ]);

        Contact::create($request->all());

        return redirect()->back()->with('success', 'Pesan Anda berhasil dikirim ke Admin!');
    }
}
