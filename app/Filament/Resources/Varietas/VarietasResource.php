<?php

namespace App\Filament\Resources\Varietas;

use App\Filament\Resources\Varietas\Pages\CreateVarietas;
use App\Filament\Resources\Varietas\Pages\EditVarietas;
use App\Filament\Resources\Varietas\Pages\ListVarietas;
use App\Filament\Resources\Varietas\Schemas\VarietasForm;
use App\Filament\Resources\Varietas\Tables\VarietasTable;
use App\Models\Varietas;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Grouping\Group;
use Illuminate\Database\Eloquent\Builder;

class VarietasResource extends Resource
{
    protected static ?string $model = Varietas::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'varietas_name';
    
    protected static ?string $navigationLabel = 'Varietas';
    
    protected static string|UnitEnum|null $navigationGroup = 'Master Data';
    
    protected static ?int $navigationSort = 4;
    
    protected static ?string $modelLabel = 'Varietas';
    
    protected static ?string $pluralModelLabel = 'Varietas';

    public static function form(Schema $schema): Schema
    {
        return VarietasForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('varietas_name')
                    ->label('Nama Varietas')
                    ->searchable()
                    ->sortable(),
                // TextColumn::make('komoditas.komoditas_name')
                //     ->label('Komoditas')
                //     ->searchable()
                //     ->sortable()
                //     ->toggleable(),
            ])
            ->groups([
                Group::make('komoditas.komoditas_name')
                    ->label('Komoditas')
                    ->collapsible(),
            ])
            ->defaultGroup('komoditas.komoditas_name');
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
