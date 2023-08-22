<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Commercial;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CommercialResource\Pages;
use App\Filament\Resources\CommercialResource\RelationManagers;

class CommercialResource extends Resource
{
    protected static ?string $model = Commercial::class;


    protected ?string $maxContentWidth = 'full';
    protected static ?string $navigationGroup = 'PARAMETRES';
    protected static ?string $navigationLabel = 'Commerciaux';
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?int $navigationSort = 3 ;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nomcom')->required()->label('NOM DU COMMERCIAL')->columnSpan('full'),
                TextInput::make('matcom')->disabled()->label('MATRICULE'),
                TextInput::make('taucom')->required()->label('TAUX DE COMMISSION'),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nomcom')->label('NOM DU COMMERCIAL')->searchable()->sortable(),
                TextColumn::make('matcom')->label('MATRICULE'),
                TextColumn::make('taucom')->label('TAUX DE COMMISSION'),
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
            'index' => Pages\ManageCommercials::route('/'),
        ];
    }    
}
