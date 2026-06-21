<?php

namespace App\Filament\Resources\Messages\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;

class MessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\TextInput::make('name')
                    ->label('Nama Pengirim')
                    ->required()
                    ->maxLength(255),

                \Filament\Forms\Components\TextInput::make('contact_info')
                    ->label('Kontak (Email/HP)')
                    ->required()
                    ->maxLength(255),

                \Filament\Forms\Components\TextInput::make('category')
                    ->label('Kategori')
                    ->maxLength(255),

                \Filament\Forms\Components\TextInput::make('type')
                    ->label('Tipe Pesan')
                    ->maxLength(255),

                \Filament\Forms\Components\Select::make('jenjang')
                    ->label('Jenjang')
                    ->options(\App\Support\Jenjang::options())
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

                \Filament\Forms\Components\Textarea::make('message')
                    ->label('Isi Pesan')
                    ->required()
                    ->columnSpanFull(),

                \Filament\Schemas\Components\Section::make('Riwayat Balasan')
                    ->description('Detail balasan yang telah dikirim')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('reply_subject')
                            ->label('Subjek Balasan'),
                        \Filament\Forms\Components\DateTimePicker::make('replied_at')
                            ->label('Waktu Dibalas'),
                        \Filament\Forms\Components\Textarea::make('reply_content')
                            ->label('Isi Balasan')
                            ->columnSpanFull(),
                    ])
                    ->visible(fn ($record) => $record && $record->replied_at),
            ]);
    }
}
