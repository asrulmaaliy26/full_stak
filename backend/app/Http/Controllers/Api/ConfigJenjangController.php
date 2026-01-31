<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfigJenjangController extends Controller
{
    public function levels()
    {
        return response()->json([
            'MI' => [
                'color' => 'emerald',
                'name' => 'MI AL Hidayah',
                'bg' => 'bg-emerald-600',
                'text' => 'text-emerald-600',
                'type' => 'Madrasah Ibtidaiyah'
            ],
            'SMPT' => [
                'color' => 'sky',
                'name' => 'SMPT AL Hidayah',
                'bg' => 'bg-sky-600',
                'text' => 'text-sky-600',
                'type' => 'Sekolah Menengah Pertama'
            ],
            'MA' => [
                'color' => 'islamic-green',
                'name' => 'MA AL Hidayah',
                'bg' => 'bg-islamic-green-600',
                'text' => 'text-islamic-green-600',
                'type' => 'Sekolah Menengah Atas'
            ],
            'KAMPUS' => [
                'color' => 'indigo',
                'name' => 'STAI AL Hidayah',
                'bg' => 'bg-indigo-600',
                'text' => 'text-indigo-600',
                'type' => 'Sekolah Tinggi Agama Islam'
            ],
            'UMUM' => [
                'color' => 'slate',
                'name' => 'Yayasan AL Mannan',
                'bg' => 'bg-slate-900',
                'text' => 'text-slate-900',
                'type' => 'Pusat Yayasan'
            ]
        ]);
    }
}
