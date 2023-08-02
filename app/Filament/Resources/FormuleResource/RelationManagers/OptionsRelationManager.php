<?php

namespace App\Filament\Resources\FormuleResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\SexGrp;
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
                Select::make('sexgrp_id')->label('CATEGORIE')->required()->options(SexGrp::all()->pluck('libsxg', 'id'))->columnSpanFull(),
                Forms\Components\TextInput::make('libopt')->label('LIBELLE')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                TextInput::make('agemin')->label('AGE MIN'),
                TextInput::make('agemax')->label('AGE MAX'),
                TextInput::make('mntxaf')->label('MOTANT XAF'),
                TextInput::make('mnteur')->label('MOTANT EUR'),

                Forms\Components\Section::make('RACHAT OPTIQUE')
                ->schema([
                    TextInput::make('mntopx')->label('MOTANT XAF'),
                    TextInput::make('mntope')->label('MOTANT EUR'),
         
                ])->collapsible()
                  ->collapsed()
                  ->columns(2),
                
                Forms\Components\Section::make('RACHAT DENTISTERIE')
                  ->schema([
                    TextInput::make('mntdnx')->label('MOTANT XAF'),
                    TextInput::make('mntdne')->label('MOTANT EUR'),

                  ])->collapsible()
                    ->collapsed()
                    ->columns(2),

                
                Textarea::make('dtlopt')->label('DETAILS OPTION')->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('libopt')->label('LIBELLE'),
                TextColumn::make('agemin')->label('AGE MIN')->sortable(),
                TextColumn::make('agemax')->label('AGE MAX')->sortable(),
                TextColumn::make('sexgrp.libsxg')->label('CATEGORIE')->sortable(),

                TextColumn::make('mntxaf')->label('MOTANT XAF')->money('XAF'),
                TextColumn::make('mnteur')->label('MOTANT EUR')->money('eur'),

                TextColumn::make('mntopx')->label('RACHAT OPT.')->money('XAF'),
                TextColumn::make('mntdnx')->label('RACHAT DEN.')->money('XAF'),

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
