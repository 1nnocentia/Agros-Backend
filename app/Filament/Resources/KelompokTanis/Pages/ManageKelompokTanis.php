<?php

namespace App\Filament\Resources\KelompokTanis\Pages;

use App\Filament\Resources\KelompokTanis\KelompokTaniResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageKelompokTanis extends ManageRecords
{
    protected static string $resource = KelompokTaniResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
