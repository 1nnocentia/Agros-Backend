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
use Filament\Tables\Columns\TextColumn;

class DataTanamResource extends Resource
{
    protected static ?string $model = DataTanam::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'DataTanam';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('users.name')
                    ->label('Nama Petani')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('planting_date')
                    ->label('Tanggal Tanam')
                    ->date()
                    ->sortable(),
                TextColumn::make('statustanam.status_tanam')
                    ->label('Status Tanam')
                    ->searchable()
                    ->sortable(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            
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
