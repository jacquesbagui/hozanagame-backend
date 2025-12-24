<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Card;
use Filament\Actions\Action;
use Illuminate\Support\Facades\DB;

class CollectionsList extends BaseWidget
{

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'sm:col-span-1';


    public function table(Table $table): Table
    {
        return $table
            ->query(
                Card::select('collection', DB::raw('count(*) as count'))
                    ->groupBy('collection')
            )
            ->modifyQueryUsing(function ($query) {
                $query->getQuery()->orders = [];
                $query->orderBy('collection');
            })
            ->defaultSort(null)
            ->columns([
                Tables\Columns\TextColumn::make('collection')
                    ->label('Collection')
                    ->formatStateUsing(fn (string $state): string => Card::COLLECTIONS[$state] ?? $state)
                    ->sortable(query: function ($query, string $direction) {
                        $query->getQuery()->orders = [];
                        return $query->orderBy('collection', $direction);
                    }),

                Tables\Columns\TextColumn::make('count')
                    ->label('Nombre de cartes')
                    ->sortable(query: function ($query, string $direction) {
                        $query->getQuery()->orders = [];
                        return $query->orderBy('count', $direction);
                    }),
            ])
            ->actions([
                Action::make('view')
                    ->label('Voir')
                    ->url(fn ($record) => route('filament.admin.resources.cards.index', [
                        'tableFilters[collection][value]' => $record->collection,
                    ]))
                    ->icon('heroicon-o-eye'),
            ]);
    }
}
