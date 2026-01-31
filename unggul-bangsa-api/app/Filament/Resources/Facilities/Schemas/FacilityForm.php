<?php

namespace App\Filament\Resources\Facilities\Schemas;

use Filament\Schemas\Schema;

class FacilityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\TextInput::make('name')->required(),
                \Filament\Forms\Components\Select::make('jenjang')
                    ->options([
                        'KAMPUS' => 'Kampus',
                        'MA' => 'MA',
                        'SMPT' => 'SMPT',
                        'MI' => 'MI',
                    ])->required(),
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
