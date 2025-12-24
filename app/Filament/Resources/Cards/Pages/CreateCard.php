<?php

namespace App\Filament\Resources\Cards\Pages;

use App\Filament\Resources\Cards\CardResource;
use Filament\Resources\Pages\CreateRecord;
use App\Services\ShortCodeGenerator;

class CreateCard extends CreateRecord
{
    protected static string $resource = CardResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Générer le code court
        $shortCodeGenerator = app(ShortCodeGenerator::class);
        $shortCode = $shortCodeGenerator->generate();

        $data['short_code'] = $shortCode;
        $data['target_url'] = "https://hozanagame.com/card/{$shortCode}";

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
