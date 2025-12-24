<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Card;
use Filament\Actions\Action;

class RecentCardsTable extends BaseWidget
{
    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = 'sm:col-span-2';

    public function table(Table $table): Table
    {
        return $table
        ->query(
            Card::query()
                ->latest()
                ->limit(5)
        )
        ->columns([
            Tables\Columns\TextColumn::make('card_number')
                ->label('Carte')
                ->description(fn (Card $record): string =>
                    $record->id ? 'ID: '.$record->id : ''),

            Tables\Columns\TextColumn::make('collection')
                ->label('Collection')
                ->badge()
                ->formatStateUsing(fn (string $state): string => Card::COLLECTIONS[$state] ?? $state),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Date d\'ajout')
                ->date()
                ->sortable(),

            Tables\Columns\IconColumn::make('active')
                ->label('Active')
                ->boolean(),
        ])
        ->actions([
            Action::make('view')
                ->label('Voir')
                ->url(fn (Card $record): string =>
                    route('filament.admin.resources.cards.view', ['record' => $record]))
                ->icon('heroicon-o-eye'),
        ]);
    }
}
