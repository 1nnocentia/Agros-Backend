<?php

namespace App\Filament\Resources\Varietas\Pages;

use App\Filament\Resources\Varietas\VarietasResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVarietas extends ListRecords
{
    protected static string $resource = VarietasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
