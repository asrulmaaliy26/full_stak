<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    public function run(): void
    {
        $facilities = [
            [
                'name' => 'Lab Komputer MA',
                'type' => 'Ruang',
                'description' => 'Laboratorium modern untuk riset IT.',
                'imageUrl' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998',
                'jenjang' => 'MA',
            ],
            [
                'name' => 'Perpustakaan Digital',
                'type' => 'Ruang',
                'description' => 'Akses e-book dan jurnal akademik.',
                'imageUrl' => 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f',
                'jenjang' => 'KAMPUS',
            ],
            [
                'name' => 'Studio Multimedia',
                'type' => 'Ruang',
                'description' => 'Produksi konten dakwah dan edukasi digital.',
                'imageUrl' => 'https://images.unsplash.com/photo-1515378791036-0648a3ef77b2',
                'jenjang' => 'KAMPUS',
            ],
            [
                'name' => 'Lapangan Olahraga',
                'type' => 'Fasilitas Umum',
                'description' => 'Futsal, basket, dan olahraga sunnah.',
                'imageUrl' => 'https://images.unsplash.com/photo-1508609349937-5ec4ae374ebf',
                'jenjang' => 'MA',
            ],
            [
                'name' => 'Robotik MA',
                'type' => 'Ekstrakurikuler',
                'description' => 'Pengembangan teknologi robotika.',
                'imageUrl' => 'https://images.unsplash.com/photo-1561557944-6e7860d1a7eb',
                'jenjang' => 'MA',
            ],
        ];

        foreach ($facilities as $item) {
            Facility::create($item);
        }
    }
}
