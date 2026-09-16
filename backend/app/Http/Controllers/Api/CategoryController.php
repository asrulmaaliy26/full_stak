<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $jurusan = request()->get('jurusan');

        if ($jurusan && strtoupper($jurusan) === 'IAT') {
            return response()->json([
                'project_categories' => [
                    'Semua',
                    'Pengabdian Masyarakat',
                    'Riset Living Qur\'an',
                    'Digital Quranic Studies',
                    'Filologi & Manuskrip',
                    'Desa Binaan Al-Qur\'an'
                ],
                'journal_categories' => [
                    'Semua',
                    'Studi Al-Qur\'an',
                    'Metodologi Tafsir',
                    'Qira\'at & Rasm',
                    'Hermeneutika',
                    'Tafsir Nusantara',
                    'Skripsi Terbaik'
                ],
                'news_categories' => [
                    'Semua',
                    'Kajian Tafsir',
                    'Seminar & Konferensi',
                    'Tahfidz & Halaqah',
                    'Akademik & Pengumuman',
                    'Prestasi Mahasiswa'
                ]
            ]);
        }

        return response()->json([
            'project_categories' => [
                'Semua',
                'Sains & Teknologi',
                'Sosial & Budaya',
                'Keagamaan',
                'Seni & Kreativitas',
                'Kewirausahaan'
            ],
            'journal_categories' => [
                'Semua',
                'Tafsir & Hadis',
                'Sains Terapan',
                'Ekonomi Syariah',
                'Pendidikan',
                'Sosial Humaniora'
            ],
            'news_categories' => [
                'Semua', 'Prestasi', 'Kegiatan', 'Akademik', 'Pengumuman'
            ]
        ]);
    }
}
