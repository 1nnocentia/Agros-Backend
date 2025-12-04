<?php

namespace App\Filament\Resources\Varietas;

use App\Filament\Resources\Varietas\Pages\CreateVarietas;
use App\Filament\Resources\Varietas\Pages\EditVarietas;
use App\Filament\Resources\Varietas\Pages\ListVarietas;
use App\Filament\Resources\Varietas\Schemas\VarietasForm;
use App\Filament\Resources\Varietas\Tables\VarietasTable;
use App\Models\Varietas;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class VarietasResource extends Resource
{
    protected static ?string $model = Varietas::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Varietas';

    public static function form(Schema $schema): Schema
    {
        return VarietasForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VarietasTable::configure($table);
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
            'index' => ListVarietas::route('/'),
            'create' => CreateVarietas::route('/create'),
            'edit' => EditVarietas::route('/{record}/edit'),
        ];
    }
}
