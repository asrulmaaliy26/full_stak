<?php

namespace App\Filament\Resources\News\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class NewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('title')->searchable()->sortable()->limit(50),
                \Filament\Tables\Columns\TextColumn::make('category')->sortable()->badge(),
                \Filament\Tables\Columns\ImageColumn::make('main_image')->label('Image'),
                \Filament\Tables\Columns\TextColumn::make('jenjang')->sortable()->badge()->color('success'),
                \Filament\Tables\Columns\TextColumn::make('views')->sortable()->numeric(),
                \Filament\Tables\Columns\TextColumn::make('date')->date('d M Y')->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->actionsPosition(\Filament\Tables\Enums\RecordActionsPosition::BeforeColumns)
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
