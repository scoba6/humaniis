<?php

namespace App\Filament\Widgets;

use Filament\Widgets\BarChartWidget;

class Cotisation extends BarChartWidget
{
    protected static ?string $heading = 'Cotisations mensuelles';
    //protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Montant de cotisations mensuelles',
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
                    'backgroundColor' =>[
                        'rgba(35, 99, 132, 0.2)',
                        'rgba(126, 159, 64, 0.2)',
                        'rgba(134, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)',
                        'rgba(890, 102, 255, 0.2)',
                        'rgba(876, 203, 207, 0.2)',
                        'rgba(654, 102, 255, 0.2)',
                        'rgba(129, 203, 207, 0.2)',
                        'rgba(120, 203, 207, 0.2)',
                    ],
                    'borderWidth' => 1
                ],
            ],
            'labels' => ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }
}
