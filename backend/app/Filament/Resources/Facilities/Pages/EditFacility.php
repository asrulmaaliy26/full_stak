<?php

namespace App\Filament\Resources\Facilities\Pages;

use App\Filament\Resources\Facilities\FacilityResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFacility extends EditRecord
{
    protected static string $resource = FacilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Convert full URL to relative path for the form
        if (isset($data['imageUrl']) && str_starts_with($data['imageUrl'], url('storage/'))) {
            $data['imageUrl'] = str_replace(url('storage/'), '', $data['imageUrl']);
        }
        
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Convert relative path back to full URL before saving
        if (isset($data['imageUrl']) && !str_starts_with($data['imageUrl'], 'http')) {
            $data['imageUrl'] = url('storage/' . $data['imageUrl']);
        }
        
        return $data;
    }
}
