<?php

namespace App\Filament\Resources\Journals\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\BadgeColumn;

class JournalsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                TextColumn::make('author')
                    ->label('Penulis')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->sortable(),

                TextColumn::make('jenjang')
                    ->label('Jenjang')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'TK' => 'info',
                        'MI' => 'success',
                        'SMPT' => 'warning',
                        'MA' => 'danger',
                        'KAMPUS' => 'primary',
                        'UMUM' => 'gray',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('score')
                    ->label('Nilai')
                    ->sortable()
                    ->suffix(' / 100'),

                IconColumn::make('is_best')
                    ->label('Terbaik')
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-star')
                    ->trueColor('warning')
                    ->falseColor('gray')
                    ->sortable(),

                TextColumn::make('date')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            ])
            ->defaultSort('date', 'desc');
    }
}
