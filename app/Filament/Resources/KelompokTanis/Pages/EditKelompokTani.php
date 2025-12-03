<?php

namespace App\Filament\Resources\KelompokTanis\Pages;

use App\Filament\Resources\KelompokTanis\KelompokTaniResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditKelompokTani extends EditRecord
{
    protected static string $resource = KelompokTaniResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
