<?php

namespace App\Filament\Resources\News\Schemas;

use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Utilities\Get;

use Filament\Schemas\Schema;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                    // Judul
                    TextInput::make('title')
                        ->label('Judul Artikel')
                        ->placeholder('Judul yang menarik...')
                        ->required()
                        ->maxLength(255)
                        ->columnSpanFull(),

                    // Ringkasan
                    Textarea::make('excerpt')
                        ->label('Ringkasan Singkat')
                        ->placeholder('Ringkasan berita dalam 1-2 kalimat...')
                        ->rows(3)
                        ->required()
                        ->columnSpanFull(),

                    // Kategori
                    Select::make('category')
                        ->label('Kategori Konten')
                        ->options([
                            'Prestasi' => 'Prestasi',
                            'Kegiatan' => 'Kegiatan',
                            'Akademik' => 'Akademik',
                            'Pengumuman' => 'Pengumuman',
                            'Wisuda' => 'Wisuda',
                            'Seminar' => 'Seminar',
                            'Lainnya' => 'Lainnya',
                        ])
                        ->default('Kegiatan')
                        ->required()
                        ->live() // Agar re-render untuk field Level
                        ->native(false),

                    // Jenjang
                    Select::make('jenjang')
                        ->label('Jenjang Pendidikan')
                        ->options([
                            'TK' => 'TK',
                            'MI' => 'MI',
                            'SMPT' => 'SMPT',
                            'MA' => 'MA',
                            'KAMPUS' => 'Kampus / STAI',
                            'UMUM' => 'Umum',
                        ])
                        ->required()
                        ->native(false)
                        ->dehydrateStateUsing(fn ($state) => strtoupper($state)),

                    // Tingkat Prestasi (Kondisional: Hanya jika kategori == Prestasi)
                    Select::make('level')
                        ->label('Tingkat Prestasi')
                        ->options([
                            'Nasional' => 'Nasional',
                            'Internasional' => 'Internasional',
                            'Provinsi' => 'Provinsi',
                            'Kabupaten' => 'Kabupaten/Kota',
                            'Kecamatan' => 'Kecamatan',
                            'Sekolah' => 'Sekolah',
                        ])
                        ->prefixIcon('heroicon-o-trophy')
                        // Hanya tampil jika category === 'Prestasi'
                        ->visible(fn (Get $get) => $get('category') === 'Prestasi')
                        ->native(false)
                        ->columnSpanFull(),

                    // Tanggal
                    DatePicker::make('date')
                        ->label('Tanggal Publikasi')
                        ->default(now())
                        ->required()
                        ->columnSpanFull(),

                    // Gambar Utama
                    FileUpload::make('main_image')
                        ->label('Gambar Utama')
                        ->image()
                        ->disk('public')
                        ->directory('news/main')
                        ->visibility('public')
                        ->required()
                        ->maxSize(2048) // 2MB
                        ->deletable()
                        ->columnSpanFull(),

                    // Galeri Foto (Repeater/Multiple)
                    FileUpload::make('gallery')
                        ->label('Galeri Foto')
                        ->multiple()
                        ->image()
                        ->disk('public')
                        ->directory('news/gallery')
                        ->visibility('public')
                        ->maxSize(2048)
                        ->deletable()
                        ->reorderable()
                        ->appendFiles()
                        ->columnSpanFull(),

                    // Konten
                    RichEditor::make('content')
                        ->label('Konten Berita')
                        ->placeholder('Tulis isi berita secara detail...')
                        ->required()
                        ->columnSpanFull()
                        ->fileAttachmentsDisk('public')
                        ->fileAttachmentsDirectory('news/attachments')
                        ->fileAttachmentsVisibility('public'),
                ]);
    }
}
