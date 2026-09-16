<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $fakultas = request()->get('fakultas');
        $jurusan = request()->get('jurusan');

        $newsQuery = \App\Models\News::orderBy('created_at', 'desc');
        $projectsQuery = \App\Models\Project::orderBy('created_at', 'desc');
        $journalsQuery = \App\Models\Journal::orderBy('created_at', 'desc');
        $facilitiesQuery = \App\Models\Facility::query();

        if ($fakultas) {
            $newsQuery->where('fakultas', $fakultas);
            $projectsQuery->where('fakultas', $fakultas);
            $journalsQuery->where('fakultas', $fakultas);
            $facilitiesQuery->where('fakultas', $fakultas);
        }
        if ($jurusan) {
            $newsQuery->where('jurusan', $jurusan);
            $projectsQuery->where('jurusan', $jurusan);
            $journalsQuery->where('jurusan', $jurusan);
            $facilitiesQuery->where('jurusan', $jurusan);
        }

        return response()->json([
            'stats' => [
                'IAT' => [
                    ['label' => 'Mahasiswa Aktif', 'value' => '350+'],
                    ['label' => 'Dosen Ahli & Mufassir', 'value' => '24'],
                    ['label' => 'Hafizh/Hafizhah 30 Juz', 'value' => '85%'],
                    ['label' => 'Alumni Berdaya Saing', 'value' => '1.200+'],
                ],
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
                'TPQ' => [
                    ['label' => 'Total Santri', 'value' => 500],
                    ['label' => 'Ustadz/Ustadzah', 'value' => 25],
                    ['label' => 'Ruang Kelas', 'value' => 10],
                ],
                'MADIN' => [
                    ['label' => 'Santri', 'value' => '100+'],
                    ['label' => 'Ustadz/ah', 'value' => 15],
                    ['label' => 'Gedung', 'value' => 1],
                    ['label' => 'Alumni', 'value' => '50+'],
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
                    'image' => '/gedungdepan.jpg',
                    'title' => 'Program Studi Ilmu Al-Qur\'an & Tafsir',
                    'subtitle' => 'Mencetak Mufassir Muda Berakhlak Qurani, Kritis, dan Berwawasan Global.'
                ],
                [
                    'image' => '/slide2.jpg',
                    'title' => 'Integrasi Turats & Sains Modern',
                    'subtitle' => 'Kajian Tafsir Klasik, Living Qur\'an, hingga Digital Quranic Studies.'
                ],
                [
                    'image' => '/slide1.jpg',
                    'title' => 'Program Unggulan Tahfidz & Sanad Qira\'at',
                    'subtitle' => 'Bimbingan Intensif Bersanad dengan Para Masyayikh & Ulama Al-Qur\'an.'
                ],
            ],
            'news' => $newsQuery->limit(3)->get(),
            'projects' => $projectsQuery->limit(3)->get(),
            'journals' => $journalsQuery->limit(3)->get(),
            'facilities' => $facilitiesQuery->limit(3)->get(),
        ]);
    }
}
