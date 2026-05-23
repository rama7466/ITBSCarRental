<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Car;
use App\Models\CarType;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::with('carType')->get();
        return view('admin.cars.index', compact('cars'));
    }

    public function create()
    {
        $carTypes = CarType::all();
        return view('admin.cars.create', compact('carTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'car_type_id' => 'required|exists:car_types,id',
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'license_plate' => 'required|string|max:255|unique:cars',
            'price_per_day' => 'required|numeric|min:0',
            'year' => 'required|integer|min:1900|max:'.(date('Y')+1),
            'description' => 'nullable|string',
            'status' => 'required|in:available,rented,maintenance',
            'image' => 'nullable|image|max:2048'
        ]);

        $car = Car::create($request->all());

        if ($request->hasFile('image')) {
            $car->addMediaFromRequest('image')->toMediaCollection('cars');
        }

        return redirect()->route('admin.cars.index')->with('success', 'Mobil berhasil ditambahkan.');
    }

    public function edit(Car $car)
    {
        $carTypes = CarType::all();
        return view('admin.cars.edit', compact('car', 'carTypes'));
    }

    public function update(Request $request, Car $car)
    {
        $request->validate([
            'car_type_id' => 'required|exists:car_types,id',
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'license_plate' => 'required|string|max:255|unique:cars,license_plate,'.$car->id,
            'price_per_day' => 'required|numeric|min:0',
            'year' => 'required|integer|min:1900|max:'.(date('Y')+1),
            'description' => 'nullable|string',
            'status' => 'required|in:available,rented,maintenance',
            'image' => 'nullable|image|max:2048'
        ]);

        $car->update($request->all());

        if ($request->hasFile('image')) {
            $car->clearMediaCollection('cars');
            $car->addMediaFromRequest('image')->toMediaCollection('cars');
        }

        return redirect()->route('admin.cars.index')->with('success', 'Mobil berhasil diperbarui.');
    }

    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('admin.cars.index')->with('success', 'Mobil berhasil dihapus.');
    }
}
