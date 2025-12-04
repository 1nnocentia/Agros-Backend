<?php

namespace App\Filament\Resources\Komoditas;

use App\Filament\Resources\Komoditas\Pages\ManageKomoditas;
use App\Models\Komoditas;
use BackedEnum;
use UnitEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class KomoditasResource extends Resource
{
    protected static ?string $model = Komoditas::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    
    protected static ?string $navigationLabel = 'Komoditas';
    
    protected static string|UnitEnum|null $navigationGroup = 'Master Data';
    
    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'Komoditas';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('komoditas_name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Komoditas')
            ->columns([
                TextColumn::make('komoditas_name')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageKomoditas::route('/'),
        ];
    }
}
