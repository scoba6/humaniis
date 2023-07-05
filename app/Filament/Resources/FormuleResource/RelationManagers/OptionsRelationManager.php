<?php

namespace App\Filament\Resources\FormuleResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class OptionsRelationManager extends RelationManager
{
    protected static string $relationship = 'options';

    protected static ?string $recordTitleAttribute = 'libopt';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('libopt')->label('LIBELLE')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                TextInput::make('agemin')->label('AGE MIN'),
                TextInput::make('agemax')->label('AGE MAX'),
                TextInput::make('mntxaf')->label('MOTANT XAF'),
                TextInput::make('mnteur')->label('MOTANT EUR'),
                Select::make('sexfrm')->label('SEXE')->required()->options(['1' => 'HOMME', '2' => 'FEMME'])->columnSpanFull(),
                Textarea::make('dtlopt')->label('DETAILS OPTION')->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('libopt')->label('LIBELLE'),
                TextColumn::make('agemin')->label('AGE MIN'),
                TextColumn::make('agemax')->label('AGE MAX'),
                TextColumn::make('mntxaf')->label('MOTANT XAF')->money('XAF'),
                TextColumn::make('mnteur')->label('MOTANT EUR')->money('EUR'),
               // TextColumn::make('dtlopt')->label('DETAILS OPTION')->columnSpanFull()
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
