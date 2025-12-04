<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Models\User;
use BackedEnum;
use UnitEnum;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use App\Filament\Resources\Users\RelationManagers\LahanRelationManager;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Users';
    
    protected static string|UnitEnum|null $navigationGroup = 'User Management';
    
    protected static ?int $navigationSort = 1;
    
    protected static ?string $modelLabel = 'User';
    
    protected static ?string $pluralModelLabel = 'Users';

    protected static ?string $recordTitleAttribute = 'name';
    
    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                TextInput::make('phone_number')
                    ->maxLength(20)
                    ->placeholder('Contoh: 08123456789')
                    ->regex('/^08[1-9][0-9]{7,11}$/')
                    ->mask('9999-9999-99999')
                    ->stripCharacters(['-'])
                    ->rule('starts_with:08')
                    ->validationMessages([
                        'regex' => 'Nomor HP harus diawali 08 dan berisi angka saja.',
                        ])
                    ->unique(ignoreRecord: true),
                Select::make('role_id')
                    ->label('Role')
                    ->relationship(name: 'role', titleAttribute: 'role_name')
                    ->preload()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                TextColumn::make('phone_number')
                    ->label('No. HP')
                    ->searchable(),
                TextColumn::make('wa_verified')
                    ->label('WA Verified')
                    ->sortable()
                    ->formatStateUsing(fn (string $state): string => $state == 1 ? 'Sudah' : 'Belum')
                    ->color(fn (string $state): string => match ($state) {
                        '1' => 'success',
                        '0' => 'gray',
                        default => 'gray',
                    }),
                TextColumn::make('role.role_name')
                    ->label('Role')
                    ->badge()
                    ->sortable(),
                TextColumn::make('kelompokTani.kelompok_tani')
                    ->label('Kelompok Tani'),
                IconColumn::make('isActive')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('isActive')
                    ->label('Status')
                    ->placeholder('Semua')
                    ->trueLabel('Aktif')
                    ->falseLabel('Tidak Aktif'),
            ])
            ->actions([
                Action::make('toggle_status')
                    ->label(fn (User $record) => $record->isActive ? 'Nonaktifkan' : 'Aktifkan')
                    ->icon('heroicon-m-power')
                    ->color(fn (User $record) => $record->isActive ? 'danger' : 'success')
                    ->requiresConfirmation()
                    ->modalHeading('Ubah Status User')
                    ->modalDescription('Apakah Anda yakin ingin mengubah status keaktifan user ini?')
                    ->action(function (User $record) {
                        $record->update(['isActive' => !$record->isActive]);
                    }),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            LahanRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
