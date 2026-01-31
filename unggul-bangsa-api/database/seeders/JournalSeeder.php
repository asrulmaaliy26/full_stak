<?php

namespace Database\Seeders;

use App\Models\Journal;
use Illuminate\Database\Seeder;

class JournalSeeder extends Seeder
{
    public function run(): void
    {
        $journals = [
            [
                'title' => 'Zakat & Ekonomi Digital',
                'category' => 'Ekonomi Syariah',
                'abstract' => 'Studi efisiensi pengelolaan zakat via aplikasi.',
                'author' => 'Ahmad Mahasiswa',
                'mentor' => 'Dr. Zainal',
                'score' => 98,
                'date' => '2024-06-01',
                'is_best' => true,
                'jenjang' => 'KAMPUS',
            ],
            [
                'title' => 'Eksperimen Bio-Gas Sekolah',
                'category' => 'Sains Terapan',
                'abstract' => 'Pemanfaatan limbah kantin menjadi energi.',
                'author' => 'Siswa MA',
                'mentor' => 'Guru Kimia',
                'score' => 92,
                'date' => '2024-05-01',
                'is_best' => false,
                'jenjang' => 'MA',
            ],
            [
                'title' => 'AI untuk Prediksi Cuaca Lokal',
                'category' => 'Teknologi Informasi',
                'abstract' => 'Implementasi machine learning untuk prediksi cuaca.',
                'author' => 'Tim Riset Kampus',
                'mentor' => 'Dr. Fikri',
                'score' => 95,
                'date' => '2024-04-01',
                'is_best' => false,
                'jenjang' => 'KAMPUS',
            ],
            [
                'title' => 'Pengaruh Tahfidz terhadap Prestasi Akademik',
                'category' => 'Pendidikan Islam',
                'abstract' => 'Analisis korelasi hafalan Al-Qur’an dan nilai akademik.',
                'author' => 'Siswa MA',
                'mentor' => 'Ust. Hasan',
                'score' => 90,
                'date' => '2024-03-01',
                'is_best' => false,
                'jenjang' => 'MA',
            ],
        ];

        foreach ($journals as $item) {
            Journal::create($item);
        }
    }
}
