<?php

namespace App\Filament\Resources\Lahans;

use App\Filament\Resources\Lahans\Pages\CreateLahan;
use App\Filament\Resources\Lahans\Pages\EditLahan;
use App\Filament\Resources\Lahans\Pages\ListLahans;
use App\Filament\Resources\Lahans\Schemas\LahanForm;
use App\Filament\Resources\Lahans\Tables\LahansTable;
use App\Models\Lahan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class LahanResource extends Resource
{
    protected static ?string $model = Lahan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Lahan';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('user_id')
                    ->label('Owner')
                    ->relationship(name: 'user', titleAttribute: 'name')
                    ->preload()
                    ->required(),
                TextInput::make('land_area')
                    ->label('Luas Lahan (ha)')
                    ->numeric()
                    ->required(),
                // Lokasi
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Owner')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('land_area')
                    ->label('Luas Lahan (ha)')
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
            'index' => ListLahans::route('/'),
            'create' => CreateLahan::route('/create'),
            'edit' => EditLahan::route('/{record}/edit'),
        ];
    }
}
