<?php

namespace App\Filament\Resources\Messages\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class MessagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('contact_info')
                    ->label('Kontak')
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('category')
                    ->label('Kategori')
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('type')
                    ->label('Tipe')
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('jenjang')
                    ->label('Jenjang')
                    ->badge()
                    ->color('success')
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->label('Diterima pada')
                    ->dateTime()
                    ->sortable(),
                \Filament\Tables\Columns\IconColumn::make('replied_at')
                    ->label('Sdh Dibalas')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                \Filament\Actions\ViewAction::make()
                    ->modal(),
                EditAction::make(),
                \Filament\Actions\Action::make('reply')
                    ->label('Balas Email')
                    ->icon('heroicon-o-envelope')
                    ->color('primary')
                    ->form([
                        \Filament\Forms\Components\TextInput::make('subject')
                            ->label('Subjek')
                            ->default(fn ($record) => 'Re: ' . $record->category)
                            ->required(),
                        \Filament\Forms\Components\Textarea::make('content')
                            ->label('Isi Balasan')
                            ->required()
                            ->rows(5),
                    ])
                    ->action(function ($record, array $data) {
                        try {
                            // Send Email
                            \Illuminate\Support\Facades\Mail::to($record->contact_info)
                                ->send(new \App\Mail\MessageReplyMail($data['subject'], $data['content'], $record->jenjang));

                            // Update Record
                            $record->update([
                                'reply_subject' => $data['subject'],
                                'reply_content' => $data['content'],
                                'replied_at' => now(),
                            ]);

                            // Show Notification including the last reply content
                            \Filament\Notifications\Notification::make()
                                ->title('Email Terkirim')
                                ->success()
                                ->body('Balasan terakhir: ' . \Illuminate\Support\Str::limit($data['content'], 100))
                                ->send();
                        } catch (\Exception $e) {
                            \Filament\Notifications\Notification::make()
                                ->title('Gagal mengirim email')
                                ->danger()
                                ->body($e->getMessage())
                                ->send();
                        }
                    })
                    ->visible(fn ($record) => filter_var($record->contact_info, FILTER_VALIDATE_EMAIL)),
                \Filament\Actions\Action::make('reply_wa')
                    ->label('Hubungi ke WA')
                    ->icon('heroicon-o-chat-bubble-left-ellipsis')
                    ->color('success')
                    ->url(function ($record) {
                        $phone = preg_replace('/[^0-9]/', '', $record->contact_info);
                        if (str_starts_with($phone, '0')) {
                            $phone = '62' . substr($phone, 1);
                        }
                        return 'https://wa.me/' . $phone;
                    })
                    ->openUrlInNewTab()
                    ->visible(fn ($record) => !filter_var($record->contact_info, FILTER_VALIDATE_EMAIL)),
            ])
            ->recordAction(\Filament\Actions\ViewAction::class)
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
