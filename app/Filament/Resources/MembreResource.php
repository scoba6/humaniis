<?php

namespace App\Filament\Resources;

use Closure;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use App\Models\Membre;
use App\Models\Option;
use App\Models\SexGrp;
use App\Models\Famille;
use App\Models\Formule;
use App\Models\Qualite;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\MembreResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MembreResource\RelationManagers;

class MembreResource extends Resource
{
    protected static ?string $model = Membre::class;

    protected ?string $maxContentWidth = 'full';
    protected static ?string $navigationGroup = 'ADHESIONS';
    protected static ?string $navigationLabel = 'Ayant droits';
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('fammile_id')->label('FAMILLE')->required()->options(Famille::all()->pluck('nomfam', 'id'))->columnSpan('full')->searchable(),
                TextInput::make('nommem')->required()->label('NOM PRENOM'), //->columnSpan('full'),
                Select::make('qualite_id')->label('QUALITE')->required()->options(Qualite::all()->pluck('libqlt', 'id')),
                DateTimePicker::make('datnai')->label('DATE DE NAISSANCE')->displayFormat('d/m/Y')->maxDate(now())->required()
                    ->reactive()
                    ->afterStateUpdated(function (Closure $set, $get) {
                        $dateOfBirth = $get('datnai');
                        $age = Carbon::now()->diffInYears($dateOfBirth);
                        $set('agemem', $age); 
                    }),
                TextInput::make('agemem')->label('AGE')->disabled(),
                Select::make('formule_id')->label('FORMULE')->required()->options(Formule::all()->pluck('libfrm', 'id')),
                Select::make('sexmem_id')->label('CATEGORIE')->required()->options(SexGrp::all()->pluck('libsxg', 'id')),
                Select::make('option_id')->label('OPTION')->required()->options(Option::all()->pluck('libopt', 'id')),
                TextInput::make('matmem')->label('MATRICULE')->disabled(),
                DateTimePicker::make('valfrm')->label('VALIDITE FORMULE')->displayFormat('d/m/Y')->maxDate(now())->required()->columnSpan('full'),
                Checkbox::make('Frais adhésion')->required(),
                Textarea::make('commem')->label('COMMENTAIRES')->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('famille.nomfam')->sortable()->label('FAMILLE')->searchable(),
                Tables\Columns\TextColumn::make('qualite.libqlt')->sortable()->label('QUALITE')->searchable(),
                Tables\Columns\TextColumn::make('formule.libfrm')->sortable()->label('FORMULE'),
                Tables\Columns\TextColumn::make('nommem')->sortable()->label('NOM PRENOM')->searchable(),
                Tables\Columns\TextColumn::make('matmem')->sortable()->label('MATRICULE'),
                Tables\Columns\TextColumn::make('datnai')->sortable()->label('DATE DE NAISSANCE')->datetime('d/m/Y'),
                Tables\Columns\TextColumn::make('agemem')->sortable()->label('AGE'),
                Tables\Columns\TextColumn::make('sexmem_id')->sortable()->label('SEXE'),
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
            RelationManagers\CotisationsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMembres::route('/'),
            'create' => Pages\CreateMembre::route('/create'),
            'edit' => Pages\EditMembre::route('/{record}/edit'),
        ];
    }
}
