<?php

namespace App\Filament\Resources\MembreResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class CotisationsRelationManager extends RelationManager
{
    protected static string $relationship = 'cotisations';

    protected static ?string $recordTitleAttribute = 'mntcot';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('mntcot')
                    ->required()
                    ->maxLength(255)
                    ->label('MONTANT')->columnSpan('full'),
                DateTimePicker::make('datcot')->label('DATE DE COTISATION')->displayFormat('d/m/Y')->maxDate(now())->required(),
                DateTimePicker::make('datval')->label('DATE DE VALIDITE')->displayFormat('d/m/Y')->required(),
                Textarea::make('detcot')->label('COMMENTAIRES')->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('datcot')->sortable()->label('DATE')->dateTime('d/m/Y'),
                Tables\Columns\TextColumn::make('datval')->sortable()->label('VALIDITE')->dateTime('d/m/Y'),
                Tables\Columns\TextColumn::make('mntcot')->label('MONTANT')->money('XAF'),
                Tables\Columns\TextColumn::make('detcot')->label('OBSERVATIONS'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }    
}
