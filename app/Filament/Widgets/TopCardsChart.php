<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Card;

class TopCardsChart extends ChartWidget
{
    protected ?string $heading = 'Top 5 des cartes les plus scannées';

    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'sm:col-span-2';

    protected function getData(): array
    {
        $topCards = Card::select('id', 'card_number', 'collection', 'clicks')
            ->orderBy('clicks', 'desc')
            ->limit(5)
            ->get();

        $labels = $topCards->map(function($card) {
            $label = $card->card_number ? $card->card_number : 'Carte #' . $card->id;
            return $label . ' (' . Card::COLLECTIONS[$card->collection] ?? $card->collection . ')';
        })->toArray();

        $data = $topCards->pluck('clicks')->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Nombre de scans',
                    'data' => $data,
                    'backgroundColor' => [
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(255, 159, 64, 0.6)',
                        'rgba(255, 99, 132, 0.6)',
                    ],
                    'borderColor' => [
                        'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                    ],
                    'borderWidth' => 1
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
