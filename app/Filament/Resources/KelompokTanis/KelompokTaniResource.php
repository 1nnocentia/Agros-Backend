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
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;

class KelompokTaniResource extends Resource
{
    protected static ?string $model = KelompokTani::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Kelompok Tani';
    
    protected static ?string $modelLabel = 'Kelompok Tani';
    
    protected static ?string $pluralModelLabel = 'Kelompok Tani';

    protected static ?string $recordTitleAttribute = 'kelompok_tani';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('kelompok_tani')
                    ->label('Nama Kelompok Tani')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kelompok_tani')
                    ->label('Nama Kelompok Tani')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('petani_count')
                    ->counts('users')
                    ->numeric()
                    ->default(0)
                    ->label('Jumlah Anggota')
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
            'index' => ListKelompokTanis::route('/'),
            'create' => CreateKelompokTani::route('/create'),
            'edit' => EditKelompokTani::route('/{record}/edit'),
        ];
    }
}
