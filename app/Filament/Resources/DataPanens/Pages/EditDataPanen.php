<?php

namespace App\Filament\Resources\DataPanens\Pages;

use App\Filament\Resources\DataPanens\DataPanenResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDataPanen extends EditRecord
{
    protected static string $resource = DataPanenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
