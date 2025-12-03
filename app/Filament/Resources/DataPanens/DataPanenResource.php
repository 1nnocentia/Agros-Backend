<?php

namespace App\Filament\Resources\DataPanens;

use App\Filament\Resources\DataPanens\Pages\CreateDataPanen;
use App\Filament\Resources\DataPanens\Pages\EditDataPanen;
use App\Filament\Resources\DataPanens\Pages\ListDataPanens;
use App\Filament\Resources\DataPanens\Schemas\DataPanenForm;
use App\Filament\Resources\DataPanens\Tables\DataPanensTable;
use App\Models\DataPanen;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DataPanenResource extends Resource
{
    protected static ?string $model = DataPanen::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'DataPanen';

    public static function form(Schema $schema): Schema
    {
        return DataPanenForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DataPanensTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDataPanens::route('/'),
            'create' => CreateDataPanen::route('/create'),
            'edit' => EditDataPanen::route('/{record}/edit'),
        ];
    }
}
