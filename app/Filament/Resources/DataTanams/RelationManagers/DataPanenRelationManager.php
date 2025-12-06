<?php

namespace App\Filament\Resources\DataTanams\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Forms\Get;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Select;

class DataPanenRelationManager extends RelationManager
{
    protected static string $relationship = 'dataPanen';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('harvest_date')
                    ->label('Tanggal Panen')
                    ->required()
                    ->rules([
                        fn ($livewire): \Closure => function (string $attribute, $value, \Closure $fail) use ($livewire) {
                            $dataTanam = $livewire->getOwnerRecord();
                            if ($dataTanam && $value < $dataTanam->planting_date) {
                                $tglTanam = Carbon::parse($dataTanam->planting_date)->format('d-m-Y');
                                $fail("Tanggal panen tidak boleh sebelum tanggal tanam ({$tglTanam}).");
                            }
                        },
                    ]),
                TextInput::make('yield_weight')
                    ->label('Berat Hasil Panen (kg)')
                    ->required()
                    ->numeric(),
                Select::make('status_panen_id')
                    ->label('Status Panen')
                    ->relationship('statusPanen', 'name')
                    ->default(1) 
                    ->hiddenOn('create') 
                    ->visibleOn('edit') 
                    ->dehydrated(true) 
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('datapanen')
            ->columns([
                TextColumn::make('harvest_date')
                    ->label('Tanggal Panen')
                    ->date()
                    ->sortable(),
                TextColumn::make('yield_weight')
                    ->label('Berat Hasil Panen (kg)')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('statusPanen.status_panen')
                    ->numeric()
                    ->sortable(),
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
            ->headerActions([
                CreateAction::make(),
                AssociateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
