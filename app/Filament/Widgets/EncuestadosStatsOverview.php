<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Respuesta;

class EncuestadosStatsOverview extends BaseWidget
{ 
    protected function getCards(): array
    {
        return [
            Card::make('Total Encuestas', Respuesta::count())
                ->description('Número total de encuestas realizadas')
                ->descriptionIcon('heroicon-s-trending-up')
                ->color('primary'),
        ];
    }
}
