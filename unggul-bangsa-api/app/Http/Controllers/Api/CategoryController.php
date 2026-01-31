<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
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
