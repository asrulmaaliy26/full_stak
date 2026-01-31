<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $news = [
            [
                'title' => 'Siswa MA Menangkan Olimpiade Sains Nasional',
                'excerpt' => 'Prestasi membanggakan kembali diraih oleh siswa MA...',
                'content' => 'Siswa Madrasah Aliyah Unggul Bangsa berhasil meraih juara Olimpiade Sains Nasional berkat kerja keras dan bimbingan intensif para guru.',
                'date' => '2024-05-24',
                'views' => 1250,
                'category' => 'Prestasi',
                'jenjang' => 'MA',
                'main_image' => 'https://images.unsplash.com/photo-1546410531-bb4caa6b424d',
                'gallery' => [
                    'https://images.unsplash.com/photo-1523580846011-d3a5bc25702b',
                    'https://images.unsplash.com/photo-1581092919534-1c6c7f0d6f47',
                ],
            ],
            [
                'title' => 'Lomba Mewarnai MI Unggul Bangsa',
                'excerpt' => 'Keceriaan santri MI dalam lomba mewarnai...',
                'content' => 'Kegiatan lomba mewarnai diikuti oleh seluruh santri MI sebagai sarana pengembangan kreativitas dan motorik halus.',
                'date' => '2024-05-10',
                'views' => 500,
                'category' => 'Kegiatan',
                'jenjang' => 'MI',
                'main_image' => 'https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9',
                'gallery' => [
                    'https://images.unsplash.com/photo-1588072432836-e10032774350',
                    'https://images.unsplash.com/photo-1516627145497-ae6968895b74',
                ],
            ],
            [
                'title' => 'Workshop AI untuk Guru MA',
                'excerpt' => 'Peningkatan kompetensi guru melalui workshop AI...',
                'content' => 'Workshop Artificial Intelligence dilaksanakan untuk meningkatkan kompetensi guru MA dalam pembelajaran berbasis teknologi.',
                'date' => '2024-05-05',
                'views' => 820,
                'category' => 'Pelatihan',
                'jenjang' => 'MA',
                'main_image' => 'https://images.unsplash.com/photo-1523580846011-d3a5bc25702b',
                'gallery' => [
                    'https://images.unsplash.com/photo-1519389950473-47ba0277781c',
                ],
            ],
            [
                'title' => 'Santri MTs Juara Tahfidz Se-Kabupaten',
                'excerpt' => 'Hafalan Al-Qur’an santri MTs tembus tingkat kabupaten...',
                'content' => 'Santri MTs Unggul Bangsa berhasil meraih juara dalam lomba Tahfidz Al-Qur’an tingkat kabupaten.',
                'date' => '2024-05-02',
                'views' => 940,
                'category' => 'Prestasi',
                'jenjang' => 'SMPT',
                'main_image' => 'https://images.unsplash.com/photo-1604882357278-7c5d2b8a52b8',
                'gallery' => [
                    'https://images.unsplash.com/photo-1517841905240-472988babdf9',
                    'https://images.unsplash.com/photo-1509062522246-3755977927d7',
                ],
            ],
            [
                'title' => 'Peringatan Isra Mi’raj Bersama Seluruh Jenjang',
                'excerpt' => 'Peringatan Isra Mi’raj berlangsung khidmat...',
                'content' => 'Seluruh civitas akademika mengikuti peringatan Isra Mi’raj dengan penuh khidmat dan nuansa keislaman.',
                'date' => '2024-04-28',
                'views' => 1500,
                'category' => 'Keagamaan',
                'jenjang' => 'UMUM',
                'main_image' => 'https://images.unsplash.com/photo-1544717305-2782549b5136',
                'gallery' => [
                    'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee',
                    'https://images.unsplash.com/photo-1529156069898-49953e39b3ac',
                ],
            ],
            [
                'title' => 'Ekstrakurikuler Robotik MA Raih Juara Regional',
                'excerpt' => 'Tim robotik MA menunjukkan inovasi luar biasa...',
                'content' => 'Tim robotik MA Unggul Bangsa berhasil meraih juara dalam kompetisi robotik tingkat regional.',
                'date' => '2024-04-20',
                'views' => 1100,
                'category' => 'Prestasi',
                'jenjang' => 'MA',
                'main_image' => 'https://images.unsplash.com/photo-1581092919534-1c6c7f0d6f47',
                'gallery' => [
                    'https://images.unsplash.com/photo-1581092334504-1c6c7f0d6f48',
                    'https://images.unsplash.com/photo-1531482615713-2afd69097998',
                ],
            ],
            [
                'title' => 'Outing Class MI ke Museum Sains',
                'excerpt' => 'Belajar sambil bermain di Museum Sains...',
                'content' => 'Kegiatan outing class MI bertujuan menumbuhkan rasa ingin tahu santri terhadap ilmu pengetahuan.',
                'date' => '2024-04-15',
                'views' => 430,
                'category' => 'Kegiatan',
                'jenjang' => 'MI',
                'main_image' => 'https://images.unsplash.com/photo-1588072432836-e10032774350',
                'gallery' => [
                    'https://images.unsplash.com/photo-1523050854058-8df90110c9f1',
                ],
            ],
            [
                'title' => 'Seminar Parenting Islami untuk Wali Santri',
                'excerpt' => 'Penguatan peran orang tua dalam pendidikan anak...',
                'content' => 'Seminar parenting islami membahas sinergi orang tua dan sekolah dalam mendidik generasi Qurani.',
                'date' => '2024-04-08',
                'views' => 670,
                'category' => 'Seminar',
                'jenjang' => 'UMUM',
                'main_image' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f',
                'gallery' => [
                    'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4',
                ],
            ],
        ];

        foreach ($news as $item) {
            News::create($item);
        }
    }
}
