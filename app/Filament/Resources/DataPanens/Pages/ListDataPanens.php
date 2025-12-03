<?php

namespace App\Filament\Resources\DataPanens\Pages;

use App\Filament\Resources\DataPanens\DataPanenResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDataPanens extends ListRecords
{
    protected static string $resource = DataPanenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
