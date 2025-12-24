<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Card;

class StatsOverview extends BaseWidget
{

    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total des cartes', Card::count())
                ->description('Nombre total de cartes dans le système')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),
                
            Stat::make('Total des scans', Card::sum('clicks'))
                ->description('Nombre total de scans QR')
                ->descriptionIcon('heroicon-m-qr-code')
                ->color('success'),
                
            Stat::make('Cartes actives', Card::where('active', true)->count())
                ->description('Cartes actuellement actives')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('info'),
        ];
    }
}
