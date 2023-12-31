<?php

namespace App\Filament\Resources\MembreResource\RelationManagers;

use Closure;
use Filament\Forms;
use Filament\Tables;
use App\Models\Membre;
use App\Models\Option;
use Livewire\Livewire;
use App\Models\Humpargen;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class CotisationsRelationManager extends RelationManager
{
    protected static string $relationship = 'cotisations';

    protected static ?string $recordTitleAttribute = 'mntcot';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                DateTimePicker::make('datcot')->label('DATE DE COTISATION')->displayFormat('d/m/Y')->maxDate(now())->required(),
                DateTimePicker::make('datval')->label('DATE DE VALIDITE')->displayFormat('d/m/Y')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function (RelationManager $livewire, \Filament\Forms\Set $set) {
                        $mem = $livewire->ownerRecord->id; //Membre
                        $opt = $livewire->ownerRecord->option_id; //Option
                        $coti = Option::find($opt)?->mntxaf; //Montant de la coti
                        $fra = Humpargen::find(1)->tauval; //Montant des frais d'adhésion
                        //dd($fra);

                        $rht_opt =  Membre::find($mem)?->optmem; //Rachat optique
                        if ($rht_opt) {
                            $coti_opt = Option::find($opt)?->mntopx; //Montant du rachat optique
                            $coti = $coti + $coti_opt; //Cotisation de l'option + le rachat optique
                        }

                        $rht_dnt =  Membre::find($mem)?->denmem; //Rachat dentisterie
                        if ($rht_dnt) {
                            $coti_dnt = Option::find($opt)?->mntdnx; //Montant du rachat de la dentisterie
                            $coti = $coti + $coti_dnt; //Cotisation de l'option + le rachat optique
                        }

                        //TPS
                        $tps = round($coti * 9.5) / 100;

                        //CSS
                        $css = round($coti * 1) / 100;


                        $frs_adh = Membre::find($mem)?->framem; //Frais
                        if (!$frs_adh) {
                            $adh = 5000; //Cotisation de l'option + frais d'adhésion
                        }


                        $ttc = $coti + $tps + $css + $adh;
                        $set('mntcot', $coti);
                        $set('mnttps', round($tps));
                        $set('mntcss', $css);
                        $set('mntadh', $adh);
                        $set('mntttc', round($ttc));
                    }),

                Fieldset::make('DETAILS DE LA COTISATION')
                    ->schema([
                        TextInput::make('mntcot')->disabled()->label('MOTANT HT'),
                        TextInput::make('mnttps')->disabled()->label('TPS'),
                        TextInput::make('mntcss')->disabled()->label('CSS'),
                        TextInput::make('mntadh')->disabled()->label('ADH'),
                        TextInput::make('mntttc')->disabled()->label('MONTANT TTC')->columnSpanFull()
                    ])->columns(4),



                Textarea::make('detcot')->label('COMMENTAIRES')->columnSpan('full'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('datcot')->sortable()->label('DATE')->dateTime('d/m/Y'),
                Tables\Columns\TextColumn::make('datval')->sortable()->label('VALIDITE')->dateTime('d/m/Y'),
                Tables\Columns\TextColumn::make('mntttc')->label('MONTANT')->money('XAF'),
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
