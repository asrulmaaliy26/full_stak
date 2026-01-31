<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        return response()->json([
            'stats' => [
                'KAMPUS' => [
                    ['label' => 'Total Mahasiswa', 'value' => 2400],
                    ['label' => 'Dosen', 'value' => 150],
                    ['label' => 'Gedung', 'value' => 12],
                    ['label' => 'Alumni', 'value' => '10k+'],
                ],
                'MA' => [
                    ['label' => 'Total Siswa', 'value' => 111900],
                    ['label' => 'Guru', 'value' => 60],
                    ['label' => 'Ruang Kelas', 'value' => 24],
                ],
                'SMPT' => [
                    ['label' => 'Total Siswa', 'value' => 1200],
                    ['label' => 'Guru', 'value' => 80],
                    ['label' => 'Ruang Kelas', 'value' => 30],
                    ['label' => 'Alumni', 'value' => '5k+'],
                ],
                'MI' => [
                    ['label' => 'Total Siswa', 'value' => 11100],
                    ['label' => 'Guru', 'value' => 60],
                    ['label' => 'Ruang Kelas', 'value' => 24],
                ],
                'UMUM' => [
                    ['label' => 'Total Siswa', 'value' => 11100],
                    ['label' => 'Guru', 'value' => 60],
                    ['label' => 'Ruang Kelas', 'value' => 24],
                    ['label' => 'Alumni', 'value' => '10k+'],
                ],
            ],

            'slides' => [
                [
                    'image' => 'https://images.unsplash.com/photo-1546410531-bb4caa6b424d',
                    'title' => 'Membangun Generasi Qurani',
                    'subtitle' => 'Integrasi ilmu modern dengan Al-Quran.'
                ],
                [
                    'image' => 'https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9',
                    'title' => 'Pendidikan Berkualitas',
                    'subtitle' => 'Berdedikasi tinggi untuk masa depan gemilang.'
                ],
                [
                    'image' => 'https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9',
                    'title' => 'Inovasi Tanpa Batas',
                    'subtitle' => 'Riset dan teknologi dalam bingkai keislaman.'
                ],
            ],
            'news' => \App\Models\News::limit(3)->get(),
            'projects' => \App\Models\Project::limit(3)->get(),
            'journals' => \App\Models\Journal::limit(3)->get(),
            'facilities' => \App\Models\Facility::limit(3)->get(),
        ]);
    }
}
