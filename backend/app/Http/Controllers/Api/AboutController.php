<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    private function getData()
    {
        return [
            'UMUM' => [
                'history' => "Yayasan Unggul Bangsa didirikan pada tahun 1990 dengan cita-cita besar untuk membangun ekosistem pendidikan yang mengintegrasikan kecerdasan intelektual dengan nilai-nilai luhur Al-Qur'an.",
                'visi' => "Menjadi pusat keunggulan peradaban Islam di Indonesia melalui pendidikan terpadu yang berkualitas dan inklusif.",
                'misi' => [
                    "Mengelola lembaga pendidikan yang profesional dan akuntabel.",
                    "Menyediakan fasilitas modern.",
                    "Mencetak kader pemimpin berkarakter Qurani."
                ],
                'struktur' => [
                    'pimpinan' => "Ketua Dewan Pembina",
                    'nama' => "Prof. Dr. KH. Abdul Fattah",
                    'staff' => [
                        ['role' => "Sekretaris", 'name' => "Hj. Siti Aminah"],
                        ['role' => "Bendahara", 'name' => "H. Ridwan Hakim"]
                    ]
                ]
            ],
            'MA' => [ // Maps to SMA in request, updated to MA for consistency with system
                'history' => "SMA Unggul Bangsa didirikan sebagai sekolah model yang mengedepankan riset teknologi dan tahfidz Quran.",
                'visi' => "Terwujudnya cendekiawan muslim yang inovatif, kompetitif secara global, dan hafidz Quran.",
                'misi' => [
                    "Pembelajaran STEM berbasis nilai Islam.",
                    "Hafalan minimal 5 Juz.",
                    "Potensi kepemimpinan."
                ],
                'struktur' => [
                    'pimpinan' => "Kepala Sekolah",
                    'nama' => "Dr. Ahmad Wijaya, M.Pd",
                    'staff' => [
                        ['role' => "Wakasek Kurikulum", 'name' => "Ibu Siti Zulaikha"]
                    ]
                ]
            ],
            'MI' => [
                'history' => "MI Unggul Bangsa berfokus pada karakter dasar anak.",
                'visi' => "Membentuk anak sholeh yang cerdas.",
                'misi' => [
                    "Ibadah harian.",
                    "Baca tulis Quran."
                ],
                'struktur' => [
                    'pimpinan' => "Kepala Madrasah",
                    'nama' => "Hj. Mariam Ulfa",
                    'staff' => []
                ]
            ],
            'SMPT' => [
                'history' => "SMPT Unggul Bangsa adalah masa transisi krusial.",
                'visi' => "Unggul prestasi dan budi pekerti.",
                'misi' => [
                    "Bahasa Arab & Inggris.",
                    "Minat riset."
                ],
                'struktur' => [
                    'pimpinan' => "Kepala Sekolah",
                    'nama' => "Bpk. Suryadi, M.Pd",
                    'staff' => []
                ]
            ],
            'KAMPUS' => [
                'history' => "STAI Unggul Bangsa melahirkan intelektual muslim.",
                'visi' => "Pusat riset ekonomi syariah.",
                'misi' => [
                    "Pendidikan tinggi berkualitas.",
                    "Pengabdian masyarakat."
                ],
                'struktur' => [
                    'pimpinan' => "Ketua STAI",
                    'nama' => "Dr. Zainal Arifin",
                    'staff' => []
                ]
            ]
        ];
    }

    public function show($jenjang)
    {
        $data = $this->getData();
        $key = strtoupper($jenjang);

        // Normalize SMA request to MA if needed
        if ($key === 'SMA' && !isset($data['SMA']) && isset($data['MA'])) {
            $key = 'MA';
        }

        if (array_key_exists($key, $data)) {
            return response()->json(['data' => $data[$key]]);
        }

        return response()->json(['message' => 'Data not found'], 404);
    }
}
