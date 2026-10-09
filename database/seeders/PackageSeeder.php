<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            ['name' => 'Pas Foto & Foto Formal', 'duration_minutes' => 15,  'price' => 35000],
            ['name' => 'Self Photo',             'duration_minutes' => 30,  'price' => 75000],
            ['name' => 'Foto Wisuda',            'duration_minutes' => 45,  'price' => 150000],
            ['name' => 'Foto Keluarga',          'duration_minutes' => 60,  'price' => 250000],
            ['name' => 'Foto Produk UMKM',       'duration_minutes' => 90,  'price' => 300000],
            ['name' => 'Prewedding Studio',      'duration_minutes' => 120, 'price' => 750000],
        ];

        foreach ($packages as $data) {
            Package::updateOrCreate(
                ['name' => $data['name']],
                $data + ['is_active' => true]
            );
        }
    }
}