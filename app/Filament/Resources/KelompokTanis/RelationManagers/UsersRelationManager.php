<?php

namespace App\Filament\Resources\KelompokTanis\RelationManagers;

use App\Models\User;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Set;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Actions;
use Filament\Actions\CreateAction;
use Filament\Actions\AssociateAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;


class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'users';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('name')
                    ->label('Nama')
                    ->required()
                    ->maxLength(255),
                
                TextInput::make('phone_number')
                    ->label('Nomor Telepon')
                    ->tel()
                    ->default(null),

                Toggle::make('wa_verified')
                    ->label('WA Verified')
                    ->required()
                    ->live()
                    ->afterStateUpdated(function ($set, $state) {
                        $set('wa_verified_at', $state ? now() : null);
                    }),

                DateTimePicker::make('wa_verified_at')
                    ->label('Tgl Verifikasi WA')
                    ->readOnly()
                    ->dehydrated()
                    ->hidden(),
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->default(null),
                
                Select::make('role_id')
                    ->label('Role')
                    ->relationship(name: 'role', titleAttribute: 'role_name')
                    ->preload()
                    ->required()
                    ->hidden(),
                TextInput::make('password')
                    ->password()
                    ->revealable()
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create')
                    ->visibleOn('create')
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state)),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                
                TextColumn::make('phone_number')
                    ->label('Nomor Telepon')
                    ->searchable(),
                
                IconColumn::make('wa_verified')
                    ->label('Verisikasi WA')
                    ->boolean(),

                TextColumn::make('wa_verified_at')
                    ->label('Tgl Verified')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
                AssociateAction::make(),
            ])
            ->actions([
                EditAction::make(),
                
                Action::make('resetPassword')
                    ->label('Reset Pass')
                    ->icon('heroicon-o-key')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->modalHeading('Reset Password User')
                    ->form([
                        TextInput::make('new_password')
                            ->label('Password Baru')
                            ->password()
                            ->revealable()
                            ->required()
                            ->minLength(8)
                            ->confirmed(),
                        TextInput::make('new_password_confirmation')
                            ->label('Konfirmasi Password')
                            ->password()
                            ->revealable()
                            ->required(),
                    ])
                    ->action(function (User $record, array $data) {
                        $record->update([
                            'password' => Hash::make($data['new_password']),
                        ]);

                        Notification::make()
                            ->title('Password Berhasil Direset')
                            ->success()
                            ->send();
                    }),

                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}