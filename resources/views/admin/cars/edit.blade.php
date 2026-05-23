@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">Edit Mobil</div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="car_type_id" class="form-label">Jenis Mobil</label>
                        <select class="form-select" id="car_type_id" name="car_type_id" required>
                            <option value="">Pilih Jenis</option>
                            @foreach($carTypes as $type)
                                <option value="{{ $type->id }}" {{ old('car_type_id', $car->car_type_id) == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Mobil</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $car->name) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="brand" class="form-label">Brand / Merk</label>
                        <input type="text" class="form-control" id="brand" name="brand" value="{{ old('brand', $car->brand) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="license_plate" class="form-label">Plat Nomor</label>
                        <input type="text" class="form-control" id="license_plate" name="license_plate" value="{{ old('license_plate', $car->license_plate) }}" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="price_per_day" class="form-label">Harga per Hari (Rp)</label>
                            <input type="number" class="form-control" id="price_per_day" name="price_per_day" value="{{ old('price_per_day', (int)$car->price_per_day) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="year" class="form-label">Tahun</label>
                            <input type="number" class="form-control" id="year" name="year" value="{{ old('year', $car->year) }}" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $car->description) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="available" {{ old('status', $car->status) == 'available' ? 'selected' : '' }}>Tersedia</option>
                            <option value="rented" {{ old('status', $car->status) == 'rented' ? 'selected' : '' }}>Disewa</option>
                            <option value="maintenance" {{ old('status', $car->status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                        </select>
                    </div>
                    
                    @if($car->getFirstMediaUrl('cars'))
                        <div class="mb-3">
                            <label class="form-label">Foto Saat Ini</label><br>
                            <img src="{{ $car->getFirstMediaUrl('cars') }}" width="150" alt="Foto">
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="image" class="form-label">Ganti Foto Mobil (Opsional)</label>
                        <input class="form-control" type="file" id="image" name="image" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.cars.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
