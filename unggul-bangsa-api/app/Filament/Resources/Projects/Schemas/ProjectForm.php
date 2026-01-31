<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Judul
                TextInput::make('title')
                    ->label('Judul Project')
                    ->placeholder('Masukkan judul project...')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                // Deskripsi
                Textarea::make('description')
                    ->label('Deskripsi')
                    ->placeholder('Deskripsi lengkap project...')
                    ->rows(5)
                    ->required()
                    ->columnSpanFull(),

                // Kategori
                Select::make('category')
                    ->label('Kategori')
                    ->options([
                        'Penelitian' => 'Penelitian',
                        'Pengabdian Masyarakat' => 'Pengabdian Masyarakat',
                        'Inovasi' => 'Inovasi',
                        'Teknologi' => 'Teknologi',
                        'Sosial' => 'Sosial',
                        'Pendidikan' => 'Pendidikan',
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

                // Penulis/Author
                TextInput::make('author')
                    ->label('Penulis/Tim')
                    ->placeholder('Nama penulis atau tim...')
                    ->required()
                    ->maxLength(255),

                // Tanggal
                DatePicker::make('date')
                    ->label('Tanggal Project')
                    ->default(now())
                    ->required(),

                // Gambar Project
                FileUpload::make('imageUrl')
                    ->label('Gambar Project')
                    ->image()
                    ->disk('public')
                    ->directory('projects/images')
                    ->visibility('public')
                    ->required()
                    ->maxSize(5120) // 5MB
                    ->deletable()
                    ->imageEditor()
                    ->columnSpanFull()
                    ->helperText('Upload gambar project (maksimal 5MB)'),

                // Dokumen Project (Repeater)
                Repeater::make('documents')
                    ->label('Dokumen Project')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul Dokumen')
                            ->placeholder('Contoh: Proposal Project')
                            ->required()
                            ->maxLength(255),

                        Select::make('type')
                            ->label('Tipe Dokumen')
                            ->options([
                                'document' => 'Document',
                                'proposal' => 'Proposal',
                                'report' => 'Report',
                                'presentation' => 'Presentation',
                            ])
                            ->default('document')
                            ->required()
                            ->native(false),

                        FileUpload::make('url')
                            ->label('File Dokumen')
                            ->acceptedFileTypes([
                                'application/pdf',
                                'application/msword',
                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                'application/vnd.ms-powerpoint',
                                'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                            ])
                            ->disk('public')
                            ->directory('projects/documents')
                            ->visibility('public')
                            ->required()
                            ->maxSize(10240) // 10MB
                            ->deletable()
                            ->downloadable()
                            ->openable()
                            ->previewable(false)
                            ->helperText('Upload file (PDF, Word, PowerPoint - max 10MB)')
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state) {
                                    // Auto-detect format dari file extension
                                    $extension = pathinfo($state, PATHINFO_EXTENSION);
                                    $set('format', $extension);
                                }
                            }),

                        TextInput::make('format')
                            ->label('Format')
                            ->placeholder('Auto-detected')
                            ->disabled()
                            ->dehydrated()
                            ->helperText('Format file akan terdeteksi otomatis'),
                    ])
                    ->columnSpanFull()
                    ->defaultItems(0)
                    ->addActionLabel('Tambah Dokumen')
                    ->reorderable()
                    ->collapsible()
                    ->itemLabel(fn (array $state): ?string => $state['title'] ?? 'Dokumen Baru')
                    ->helperText('Tambahkan dokumen pendukung project (proposal, laporan, dll)'),
            ]);
    }
}
