<?php

namespace App\Filament\Resources\Facilities\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;

class FacilityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\TextInput::make('name')->required(),
                \Filament\Forms\Components\Select::make('jenjang')
                    ->options(\App\Support\Jenjang::options())
                    ->required()
                    ->live()
                    ->native(false),
                \Filament\Forms\Components\Select::make('fakultas')
                    ->label('Fakultas')
                    ->options([
                        'Ushuluddin' => 'Ushuluddin',
                        'Tarbiyah' => 'Tarbiyah',
                    ])
                    ->visible(fn (Get $get) => $get('jenjang') === 'KAMPUS')
                    ->live()
                    ->native(false)
                    ->nullable(),
                \Filament\Forms\Components\Select::make('jurusan')
                    ->label('Jurusan')
                    ->options(fn (Get $get) => match ($get('fakultas')) {
                        'Ushuluddin' => [
                            'Studi Islam' => 'Studi Islam',
                            'Ilmu Al-Quran dan Tafsir' => 'Ilmu Al-Quran dan Tafsir',
                        ],
                        'Tarbiyah' => [
                            'Manajemen Pendidikan Islam' => 'Manajemen Pendidikan Islam',
                        ],
                        default => [],
                    })
                    ->visible(fn (Get $get) => $get('jenjang') === 'KAMPUS' && filled($get('fakultas')))
                    ->native(false)
                    ->nullable(),
                \Filament\Forms\Components\Select::make('type')->required()
                    ->options([
                        'ekstra' => 'ekstra',
                        'fasilitas' => 'fasilitas',
                    ])->required(),
                \Filament\Forms\Components\FileUpload::make('imageUrl')
                    ->image()
                    ->disk('public')
                    ->directory('facilities')
                    ->visibility('public')
                    ->imageEditor()
                    ->required()
                    ->label('Facility Image')
                    ->getUploadedFileNameForStorageUsing(
                        fn ($file) => (string) str($file->getClientOriginalName())
                            ->prepend(now()->timestamp . '_')
                    ),
                \Filament\Forms\Components\Textarea::make('description')->required()->rows(5),
            ]);
    }
}
