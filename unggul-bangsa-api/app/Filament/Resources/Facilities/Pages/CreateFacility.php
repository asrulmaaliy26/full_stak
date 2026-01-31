<?php

namespace App\Filament\Resources\Facilities\Pages;

use App\Filament\Resources\Facilities\FacilityResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFacility extends CreateRecord
{
    protected static string $resource = FacilityResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (isset($data['imageUrl']) && !str_starts_with($data['imageUrl'], 'http')) {
            $data['imageUrl'] = url('storage/' . $data['imageUrl']);
        }
        
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
