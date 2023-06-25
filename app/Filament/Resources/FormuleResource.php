<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Formule;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\FormuleResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\FormuleResource\RelationManagers;

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
                TextInput::make('libfrm')->required()->label('FORMULE')->columnSpan('full'),
                Textarea::make('comfrm')->required()->label('DETAILS FORMULE')->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('libfrm')->sortable()->label('FORMULE'),
                TextColumn::make('comfrm')->sortable()->label('DETAILS'),
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
            RelationManagers\OptionsRelationManager::class,
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
