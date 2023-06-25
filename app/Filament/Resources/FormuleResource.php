<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormuleResource\Pages;
use App\Filament\Resources\FormuleResource\RelationManagers;
use App\Models\Formule;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FormuleResource extends Resource
{
    protected static ?string $model = Formule::class;

    protected ?string $maxContentWidth = 'full';
    protected static ?string $navigationGroup = 'ADHESIONS';
    protected static ?string $navigationLabel ='Formules';
    protected static ?string $navigationIcon = 'heroicon-o-bookmark';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListFormules::route('/'),
            'create' => Pages\CreateFormule::route('/create'),
            'edit' => Pages\EditFormule::route('/{record}/edit'),
        ];
    }    
}
