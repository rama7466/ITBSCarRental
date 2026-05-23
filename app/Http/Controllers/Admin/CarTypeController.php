<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CarType;

class CarTypeController extends Controller
{
    public function index()
    {
        $carTypes = CarType::all();
        return view('admin.car_types.index', compact('carTypes'));
    }

    public function create()
    {
        return view('admin.car_types.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        CarType::create($request->all());
        return redirect()->route('admin.car-types.index')->with('success', 'Jenis Mobil berhasil ditambahkan.');
    }

    public function edit(CarType $carType)
    {
        return view('admin.car_types.edit', compact('carType'));
    }

    public function update(Request $request, CarType $carType)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $carType->update($request->all());
        return redirect()->route('admin.car-types.index')->with('success', 'Jenis Mobil berhasil diperbarui.');
    }

    public function destroy(CarType $carType)
    {
        $carType->delete();
        return redirect()->route('admin.car-types.index')->with('success', 'Jenis Mobil berhasil dihapus.');
    }
}
