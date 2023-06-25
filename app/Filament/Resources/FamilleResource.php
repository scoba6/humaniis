<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FamilleResource\Pages;
use App\Filament\Resources\FamilleResource\RelationManagers;
use App\Models\Famille;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FamilleResource extends Resource
{
    protected static ?string $model = Famille::class;

 
    protected ?string $maxContentWidth = 'full';
    protected static ?string $navigationGroup = 'ADHESIONS';
    protected static ?string $navigationLabel ='Familles';
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?int $navigationSort = 1;
    protected static ?string $recordTitleAttribute = 'nomfam';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nomfam')->required()->label('NOM DE FAMILLE')->columnSpan('full'),
                Forms\Components\TextInput::make('matfam')->required()->label('MATRICULE FAMILLE')->prefix('HUMFAM-'),
                Forms\Components\TextInput::make('adrfam')->required()->label('ADRESSE'),
                Forms\Components\TextInput::make('vilfam')->required()->label('VILLE'),
                Forms\Components\TextInput::make('payfam')->required()->label('PAYS'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nomfam')->label('NOM DE FAMILLE')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('matfam')->label('MATRICULE FAMILLE')->sortable(),
                Tables\Columns\TextColumn::make('adrfam')->label('ADRESSE')->sortable(),
                Tables\Columns\TextColumn::make('vilfam')->label('VILLE')->sortable(),
                Tables\Columns\TextColumn::make('payfam')->label('PAYS')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageFamilles::route('/'),
        ];
    }    
}
