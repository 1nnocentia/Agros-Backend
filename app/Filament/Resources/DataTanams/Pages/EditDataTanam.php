<?php

namespace App\Filament\Resources\DataTanams\Pages;

use App\Filament\Resources\DataTanams\DataTanamResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDataTanam extends EditRecord
{
    protected static string $resource = DataTanamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
