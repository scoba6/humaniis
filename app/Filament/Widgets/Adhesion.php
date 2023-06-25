<?php

namespace App\Filament\Widgets;

use Filament\Widgets\LineChartWidget;

class Adhesion extends LineChartWidget
{
    //protected static ?string $heading = 'Chart';
    protected static ?string $heading = 'Adhésions mensuelles';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        return [
            
            'datasets' => [
                [
                    'label' => 'ADHESIONS',
                    'data' => [4344, 5676, 6798, 7890, 8987, 9388, 10343, 10524, 13664, 14345, 15753],
                ],
            ],
            'labels' => ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jui', 'Jul', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }
}
