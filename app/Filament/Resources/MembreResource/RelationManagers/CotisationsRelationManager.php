<?php

namespace App\Filament\Resources\MembreResource\RelationManagers;

use App\Models\Humpargen;
use Closure;
use Filament\Forms;
use Filament\Tables;
use App\Models\Membre;
use App\Models\Option;
use Livewire\Livewire;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Placeholder;
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
                DateTimePicker::make('datcot')->label('DATE DE COTISATION')->displayFormat('d/m/Y')->maxDate(now())->required(),
                DateTimePicker::make('datval')->label('DATE DE VALIDITE')->displayFormat('d/m/Y')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function (RelationManager $livewire, Closure $set) {
                        $mem = $livewire->ownerRecord->id; //Membre
                        $opt = $livewire->ownerRecord->option_id;//Option
                        $coti = Option::find($opt)?->mntxaf; //Montant de la coti

                        $frs_adh = Membre::find($mem)?->framem; //Frais
                        if (!$frs_adh){
                            $coti_fra = round(Humpargen::find(2)?->tauval); //Montant des frais d'adhésion
                            dd( $coti_fra );
                            $coti = $coti + $coti_fra; //Cotisation de l'option + frais d'adhésion
                        }

                        $rht_opt =  Membre::find($mem)?->optmem; //Rachat optique
                        if ($rht_opt){
                            $coti_opt = Option::find($opt)?->mntopx; //Montant du rachat optique
                            $coti = $coti + $coti_opt; //Cotisation de l'option + le rachat optique
                        }
                       
                        $rht_dnt =  Membre::find($mem)?->denmem; //Rachat dentisterie
                        if ($rht_dnt){
                            $coti_dnt = Option::find($opt)?->mntdnx; //Montant du rachat de la dentisterie
                            $coti = $coti + $coti_dnt; //Cotisation de l'option + le rachat optique
                        }

                        //TPS
                    
                        $set('mntcot', $coti);
                    }),

                Forms\Components\TextInput::make('mntcot')
                    ->required()
                    ->disabled()
                   // ->default(fn ($livewire) => $livewire->ownerRecord->option_id)
                    ->label('MONTANT')->columnSpan('full'),

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
