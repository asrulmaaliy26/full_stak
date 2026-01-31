<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Irigasi IoT MA',
                'category' => 'Sains & Teknologi',
                'description' => 'Sistem irigasi otomatis berbasis IoT untuk pertanian sekolah.',
                'author' => 'Tim MA',
                'date' => '2024-05-01',
                'imageUrl' => 'https://images.unsplash.com/photo-1518770660439-4636190af475',
                'jenjang' => 'MA',
                'documents' => [
                    [
                        'type' => 'proposal',
                        'format' => 'pdf',
                        'title' => 'Proposal Proyek Irigasi IoT',
                        'url' => 'https://example.com/storage/projects/irigasi-iot/proposal.pdf'
                    ],
                    [
                        'type' => 'report',
                        'format' => 'pdf',
                        'title' => 'Laporan Akhir Proyek',
                        'url' => 'https://example.com/storage/projects/irigasi-iot/laporan-akhir.pdf'
                    ]
                ]
            ],
            [
                'title' => 'Irigasi IoT MI',
                'category' => 'Sains & Teknologi',
                'description' => 'Pengenalan sistem irigasi otomatis sederhana untuk siswa MI.',
                'author' => 'Tim MI',
                'date' => '2024-05-01',
                'imageUrl' => 'https://images.unsplash.com/photo-1518770660439-4636190af475',
                'jenjang' => 'MI',
                'documents' => [
                    [
                        'type' => 'proposal',
                        'format' => 'pdf',
                        'title' => 'Proposal Proyek Irigasi IoT',
                        'url' => 'https://example.com/storage/projects/irigasi-iot/proposal.pdf'
                    ]
                ]
            ],
            [
                'title' => 'Robot Pembersih Masjid',
                'category' => 'Sains & Teknologi',
                'description' => 'Robot otomatis untuk membersihkan lantai masjid sekolah.',
                'author' => 'Ekstrakurikuler Robotik MA',
                'date' => '2024-04-01',
                'imageUrl' => 'https://images.unsplash.com/photo-1581091012184-5c7c41c6e0c6',
                'jenjang' => 'MA',
            ],
            [
                'title' => 'Aplikasi Hafalan Qur’an',
                'category' => 'Keagamaan',
                'description' => 'Aplikasi mobile untuk monitoring hafalan Al-Qur’an santri.',
                'author' => 'Tim Riset Kampus',
                'date' => '2024-04-01',
                'imageUrl' => 'https://images.unsplash.com/photo-1509021436665-8f07dbf5bf1d',
                'jenjang' => 'KAMPUS',
            ],
            [
                'title' => 'Komposter Digital Sekolah',
                'category' => 'Lingkungan',
                'description' => 'Pengolahan sampah organik sekolah berbasis sensor.',
                'author' => 'Tim MTs',
                'date' => '2024-03-01',
                'imageUrl' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b',
                'jenjang' => 'SMPT',
            ],
            [
                'title' => 'Website Profil Sekolah',
                'category' => 'Teknologi Informasi',
                'description' => 'Pengembangan website profil sekolah berbasis React & Laravel.',
                'author' => 'Tim IT MA',
                'date' => '2024-03-01',
                'imageUrl' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085',
                'jenjang' => 'MA',
            ],
            [
                'title' => 'Media Pembelajaran Interaktif MI',
                'category' => 'Pendidikan',
                'description' => 'Media pembelajaran berbasis animasi untuk siswa MI.',
                'author' => 'Guru MI',
                'date' => '2024-02-01',
                'imageUrl' => 'https://images.unsplash.com/photo-1513258496099-48168024aec0',
                'jenjang' => 'MI',
            ],
            [
                'title' => 'Sistem Absensi QR Code',
                'category' => 'Teknologi Informasi',
                'description' => 'Sistem absensi santri menggunakan QR Code dan dashboard web.',
                'author' => 'Tim MA',
                'date' => '2024-02-01',
                'imageUrl' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c',
                'jenjang' => 'MA',
            ],
        ];

        foreach ($projects as $item) {
            Project::create($item);
        }
    }
}
