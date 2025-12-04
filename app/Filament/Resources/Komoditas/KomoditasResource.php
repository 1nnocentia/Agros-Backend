<?php

namespace App\Filament\Resources\Komoditas;

use App\Filament\Resources\Komoditas\Pages\CreateKomoditas;
use App\Filament\Resources\Komoditas\Pages\EditKomoditas;
use App\Filament\Resources\Komoditas\Pages\ListKomoditas;
use App\Filament\Resources\Komoditas\Schemas\KomoditasForm;
use App\Filament\Resources\Komoditas\Tables\KomoditasTable;
use App\Models\Komoditas;
use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class KomoditasResource extends Resource
{
    protected static ?string $model = Komoditas::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Komoditas';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('komoditas_name')
                    ->label('Nama Komoditas')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('komoditas_name')
                    ->label('Nama Komoditas')
                    ->searchable()
                    ->sortable(),
            ]);
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
            'index' => ListKomoditas::route('/'),
            'create' => CreateKomoditas::route('/create'),
            'edit' => EditKomoditas::route('/{record}/edit'),
        ];
    }
}
