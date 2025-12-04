<?php

namespace App\Filament\Resources\Komoditas\Pages;

use App\Filament\Resources\Komoditas\KomoditasResource;
use Filament\Resources\Pages\CreateRecord;

class CreateKomoditas extends CreateRecord
{
    protected static string $resource = KomoditasResource::class;
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
