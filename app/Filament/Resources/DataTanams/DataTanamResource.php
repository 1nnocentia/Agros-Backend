<?php

namespace App\Filament\Resources\DataTanams;

use App\Filament\Resources\DataTanams\Pages\CreateDataTanam;
use App\Filament\Resources\DataTanams\Pages\EditDataTanam;
use App\Filament\Resources\DataTanams\Pages\ListDataTanams;
use App\Filament\Resources\DataTanams\Schemas\DataTanamForm;
use App\Filament\Resources\DataTanams\Tables\DataTanamsTable;
use App\Models\DataTanam;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DataTanamResource extends Resource
{
    protected static ?string $model = DataTanam::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'DataTanam';

    public static function form(Schema $schema): Schema
    {
        return DataTanamForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DataTanamsTable::configure($table);
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
            'index' => ListDataTanams::route('/'),
            'create' => CreateDataTanam::route('/create'),
            'edit' => EditDataTanam::route('/{record}/edit'),
        ];
    }
}
