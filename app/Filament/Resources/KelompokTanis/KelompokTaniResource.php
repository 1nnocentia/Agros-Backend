<?php

namespace App\Filament\Resources\KelompokTanis;

use App\Filament\Resources\KelompokTanis\Pages\CreateKelompokTani;
use App\Filament\Resources\KelompokTanis\Pages\EditKelompokTani;
use App\Filament\Resources\KelompokTanis\Pages\ListKelompokTanis;
use App\Filament\Resources\KelompokTanis\Schemas\KelompokTaniForm;
use App\Filament\Resources\KelompokTanis\Tables\KelompokTanisTable;
use App\Models\KelompokTani;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class KelompokTaniResource extends Resource
{
    protected static ?string $model = KelompokTani::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'KelompokTani';

    public static function form(Schema $schema): Schema
    {
        return KelompokTaniForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KelompokTanisTable::configure($table);
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
            'index' => ListKelompokTanis::route('/'),
            'create' => CreateKelompokTani::route('/create'),
            'edit' => EditKelompokTani::route('/{record}/edit'),
        ];
    }
}
