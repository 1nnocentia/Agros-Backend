<?php

namespace App\Filament\Resources\DataTanams\Pages;

use App\Filament\Resources\DataTanams\DataTanamResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDataTanams extends ListRecords
{
    protected static string $resource = DataTanamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
