<?php

namespace App\Filament\Resources\Journals\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;

class JournalForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                        // Judul
                        TextInput::make('title')
                            ->label('Judul Jurnal')
                            ->placeholder('Masukkan judul jurnal...')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        // Abstrak
                        Textarea::make('abstract')
                            ->label('Abstrak')
                            ->placeholder('Ringkasan atau abstrak jurnal...')
                            ->rows(4)
                            ->required()
                            ->columnSpanFull(),

                        // Kategori
                        Select::make('category')
                            ->label('Kategori')
                            ->options([
                                'Pendidikan' => 'Pendidikan',
                                'Sains' => 'Sains',
                                'Teknologi' => 'Teknologi',
                                'Sosial' => 'Sosial',
                                'Agama' => 'Agama',
                                'Bahasa' => 'Bahasa',
                                'Lainnya' => 'Lainnya',
                            ])
                            ->required()
                            ->native(false)
                            ->searchable(),

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

                        // Penulis
                        TextInput::make('author')
                            ->label('Penulis')
                            ->placeholder('Nama penulis...')
                            ->required()
                            ->maxLength(255),

                        // Pembimbing
                        TextInput::make('mentor')
                            ->label('Pembimbing')
                            ->placeholder('Nama pembimbing...')
                            ->required()
                            ->maxLength(255),

                        // Nilai/Score
                        TextInput::make('score')
                            ->label('Nilai')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(100)
                            ->required()
                            ->suffix('/ 100'),

                        // Tanggal
                        DatePicker::make('date')
                            ->label('Tanggal Publikasi')
                            ->default(now())
                            ->required(),

                        // Jurnal Terbaik
                        Toggle::make('is_best')
                            ->label('Jurnal Terbaik')
                            ->helperText('Tandai jika ini adalah jurnal terbaik')
                            ->default(false)
                            ->columnSpanFull(),

                        // Dokumen PDF
                        FileUpload::make('documentUrl')
                            ->label('Dokumen Jurnal (PDF)')
                            ->acceptedFileTypes(['application/pdf'])
                            ->disk('public')
                            ->directory('journals/documents')
                            ->visibility('public')
                            ->required()
                            ->maxSize(10240) // 10MB
                            ->deletable()
                            ->downloadable()
                            ->openable()
                            ->previewable(false)
                            ->columnSpanFull()
                            ->helperText('Upload file PDF jurnal (maksimal 10MB)'),
                    ]);
    }
}
