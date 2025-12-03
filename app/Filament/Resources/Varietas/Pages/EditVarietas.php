<?php

namespace App\Filament\Resources\Varietas\Pages;

use App\Filament\Resources\Varietas\VarietasResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditVarietas extends EditRecord
{
    protected static string $resource = VarietasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
