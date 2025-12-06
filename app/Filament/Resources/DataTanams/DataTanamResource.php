<?php

namespace App\Filament\Resources\DataTanams;

use App\Filament\Resources\DataTanams\Pages\CreateDataTanam;
use App\Filament\Resources\DataTanams\Pages\EditDataTanam;
use App\Filament\Resources\DataTanams\Pages\ListDataTanams;
use App\Filament\Resources\DataTanams\Schemas\DataTanamForm;
use App\Filament\Resources\DataTanams\Tables\DataTanamsTable;
use App\Models\DataTanam;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Grouping\Group;
use App\Filament\Resources\DataTanams\RelationManagers\DataPanenRelationManager;

class DataTanamResource extends Resource
{
    protected static ?string $model = DataTanam::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'DataTanam';
    
    protected static ?string $navigationLabel = 'Data Tanam';
    
    protected static string|UnitEnum|null $navigationGroup = 'Master Data';
    
    protected static ?int $navigationSort = 5;

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
                TextColumn::make('lahan.user.name') 
                    ->label('Nama Petani')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('varietas.komoditas.komoditas_name')
                    ->label('Komoditas')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('varietas.varietas_name')
                    ->label('Varietas')
                    ->searchable(),
                TextColumn::make('planting_date')
                    ->label('Tanggal Tanam')
                    ->date()
                    ->sortable(),
                TextColumn::make('statusTanam.status_tanam')
                    ->label('Status')
                    ->badge()
                    ->sortable(),
            ])
            ->filters([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            DataPanenRelationManager::class,
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
