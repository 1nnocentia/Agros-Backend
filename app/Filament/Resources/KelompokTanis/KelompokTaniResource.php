<?php

namespace App\Filament\Resources\KelompokTanis;

use App\Filament\Resources\KelompokTanis\Pages\ListKelompokTanis;
use App\Filament\Resources\KelompokTanis\Pages\CreateKelompokTani;
use App\Filament\Resources\KelompokTanis\Pages\EditKelompokTani;
use App\Filament\Resources\KelompokTanis\RelationManagers;
use App\Models\KelompokTani;
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
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;
use Filament\Actions\ViewAction;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use App\Filament\Resources\KelompokTanis\RelationManagers\UsersRelationManager;

class KelompokTaniResource extends Resource
{
    protected static ?string $model = KelompokTani::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    // protected static ?string $recordTitleAttribute = 'kelompok_tani';
    
    protected static ?string $navigationLabel = 'Kelompok Tani';
    
    protected static string|UnitEnum|null $navigationGroup = 'User Management';
    
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kelompok_tani')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('KelompokTani')
            ->columns([
                TextColumn::make('kelompok_tani')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('users_count')
                    ->counts('users')
                    ->label('Jumlah Anggota')
                    ->sortable()
                    ->alignCenter(),
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
            ]);
    }

    public static function getRelations(): array
    {
        return [
            UsersRelationManager::class,
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
