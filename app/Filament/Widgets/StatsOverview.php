<?php

namespace App\Filament\Widgets;

use App\Models\Famille;
use App\Models\Formule;
use App\Models\Membre;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $frm = Formule::all()->count();
        $fam = Famille::all()->count();
        $mem = Membre::all()->count();
        return [
            Card::make('FORMULES', $frm)
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Card::make('FAMILLES', $fam)
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->chart([17, 16, 14, 15, 14, 13, 12])
                ->color('success'),
            Card::make('AYANT DROITS',  $mem)
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([15, 4, 10, 2, 12, 4, 12])
                ->color('success'),
        ];
    }
}
