<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed Car Types if they do not exist
        $types = [
            'Electric' => CarType::firstOrCreate(['name' => 'Electric']),
            'Sports Car' => CarType::firstOrCreate(['name' => 'Sports Car']),
            'SUV' => CarType::firstOrCreate(['name' => 'SUV']),
            'MPV' => CarType::firstOrCreate(['name' => 'MPV']),
            'Sedan' => CarType::firstOrCreate(['name' => 'Sedan']),
        ];

        // 2. Define the premium car list
        $carsData = [
            [
                'car_type_id' => $types['Electric']->id,
                'name' => 'Tesla Model S',
                'brand' => 'Tesla',
                'license_plate' => 'B 1011 ELT',
                'price_per_day' => 1500000.00,
                'year' => 2023,
                'description' => 'Mobil listrik premium dengan performa luar biasa, kemudi autopilot canggih, interior minimalis ultra-mewah, serta jangkauan baterai terjauh di kelasnya.',
                'status' => 'available',
                'image_url' => 'https://images.unsplash.com/photo-1617788138017-80ad40651399?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'car_type_id' => $types['Sports Car']->id,
                'name' => 'BMW M4 Coupe',
                'brand' => 'BMW',
                'license_plate' => 'B 444 MS',
                'price_per_day' => 2500000.00,
                'year' => 2022,
                'description' => 'Coupe performa tinggi legendaris dari divisi M BMW. Menawarkan tenaga mesin TwinPower Turbo, handling presisi ekstrim, serta siluet sporty yang menawan mata.',
                'status' => 'available',
                'image_url' => 'https://images.unsplash.com/photo-1555215695-3004980ad54e?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'car_type_id' => $types['SUV']->id,
                'name' => 'Range Rover Sport',
                'brand' => 'Land Rover',
                'license_plate' => 'B 999 RVR',
                'price_per_day' => 2200000.00,
                'year' => 2023,
                'description' => 'SUV mewah tangguh berkemampuan all-terrain superior. Kabin kedap udara super nyaman yang dilapisi kulit premium, sangat cocok untuk perjalanan bisnis maupun petualangan mewah.',
                'status' => 'available',
                'image_url' => 'https://images.unsplash.com/photo-1606016159991-dfe4f2746ad5?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'car_type_id' => $types['Sports Car']->id,
                'name' => 'Porsche 911 Carrera',
                'brand' => 'Porsche',
                'license_plate' => 'B 911 PSC',
                'price_per_day' => 3500000.00,
                'year' => 2022,
                'description' => 'Ikon mobil sport sejati. Sensasi berkendara murni dengan mesin belakang khas Porsche, akselerasi instan, interior berkelas, dan warisan performa tanpa tanding.',
                'status' => 'available',
                'image_url' => 'https://images.unsplash.com/photo-1614162692292-7ac56d7f7f1e?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'car_type_id' => $types['MPV']->id,
                'name' => 'Toyota Alphard VIP',
                'brand' => 'Toyota',
                'license_plate' => 'B 111 APH',
                'price_per_day' => 1200000.00,
                'year' => 2023,
                'description' => 'Standar kemewahan MPV keluarga dan eksekutif. Captain seat elektrik berbalut kulit murni, AC nanoe, double sunroof, serta tingkat kesenyapan kabin level tertinggi.',
                'status' => 'available',
                'image_url' => 'https://images.unsplash.com/photo-1619767886558-efdc259cde1a?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'car_type_id' => $types['SUV']->id,
                'name' => 'Mercedes-Benz G-Class G63',
                'brand' => 'Mercedes-Benz',
                'license_plate' => 'B 63 AMG',
                'price_per_day' => 4500000.00,
                'year' => 2021,
                'description' => 'Dikenal sebagai G-Wagon. Kombinasi brutal mesin V8 BiTurbo AMG dengan estetika boxy klasik militer yang memancarkan wibawa dan kemewahan mutlak di jalanan.',
                'status' => 'available',
                'image_url' => 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'car_type_id' => $types['Electric']->id,
                'name' => 'Hyundai Ioniq 5',
                'brand' => 'Hyundai',
                'license_plate' => 'B 2026 EV',
                'price_per_day' => 850000.00,
                'year' => 2023,
                'description' => 'Crossover listrik futuristik pemenang banyak penghargaan dunia. Menawarkan desain retro-modern parametrik pixel yang unik, pengisian daya ultra-cepat, dan kabin luas yang ramah lingkungan.',
                'status' => 'available',
                'image_url' => 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'car_type_id' => $types['Sedan']->id,
                'name' => 'Honda Civic Type R',
                'brand' => 'Honda',
                'license_plate' => 'B 300 CTR',
                'price_per_day' => 1800000.00,
                'year' => 2022,
                'description' => 'Sedan sport berjiwa balap sejati. Rekor putaran tercepat di berbagai sirkuit dunia, aerodinamika agresif, suspensi adaptif, dan kenyamanan berkendara harian dalam satu paket luar biasa.',
                'status' => 'available',
                'image_url' => 'https://images.unsplash.com/photo-1609521263047-f8f205293f24?auto=format&fit=crop&w=800&q=80',
            ],
        ];

        // 3. Insert and attach images
        foreach ($carsData as $carData) {
            $imageUrl = $carData['image_url'];
            unset($carData['image_url']);

            // Avoid duplicating license plates
            $car = Car::where('license_plate', $carData['license_plate'])->first();
            if (!$car) {
                $car = Car::create($carData);
                $this->command->info("Created car: {$car->name}");

                // Attach media from Unsplash URL
                try {
                    $car->addMediaFromUrl($imageUrl)
                        ->preservingOriginal()
                        ->toMediaCollection('cars');
                    $this->command->info("Successfully attached image for {$car->name}");
                } catch (\Exception $e) {
                    $this->command->warn("Warning: Could not download image for {$car->name}. Error: " . $e->getMessage());
                    Log::warning("Could not download image for {$car->name} in CarSeeder: " . $e->getMessage());
                }
            } else {
                $this->command->comment("Car {$car->name} with plate {$car->license_plate} already exists. Skipping.");
            }
        }
    }
}
