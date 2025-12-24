<?php

namespace App\Filament\Resources\Cards\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\Action;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TernaryFilter;
use App\Models\Card;


class CardsTable
{
    public static function configure(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('collection')
                ->label('Collection')
                ->badge()
                ->formatStateUsing(fn (string $state): string => Card::COLLECTIONS[$state] ?? $state)
                ->sortable(),

            TextColumn::make('card_number')
                ->label('N° de carte')
                ->searchable()
                ->sortable(),

            TextColumn::make('short_code')
                ->label('Code court')
                ->searchable()
                ->sortable()
                ->copyable(),

            TextColumn::make('clicks')
                ->label('Scans')
                ->sortable(),

            TextColumn::make('current_scans')
                ->label('Scans actuels')
                ->sortable(),

            TextColumn::make('max_scans')
                ->label('Limite de scans')
                ->sortable(),

            IconColumn::make('active')
                ->label('Active')
                ->boolean()
                ->sortable(),

            TextColumn::make('last_scanned_at')
                ->label('Dernier scan')
                ->dateTime()
                ->sortable(),

            TextColumn::make('created_at')
                ->label('Créée le')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),

            TextColumn::make('updated_at')
                ->label('Mise à jour')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])
        ->filters([
            SelectFilter::make('collection')
                ->label('Collection')
                ->options(Card::COLLECTIONS),

            TernaryFilter::make('active')
                ->label('Active')
                ->placeholder('Toutes les cartes')
                ->trueLabel('Cartes actives uniquement')
                ->falseLabel('Cartes inactives uniquement'),

            Filter::make('has_been_scanned')
                ->label('A été scannée')
                ->query(fn (Builder $query): Builder => $query->whereNotNull('last_scanned_at')),

            Filter::make('reaching_scan_limit')
                ->label('Proche de la limite de scans')
                ->query(fn (Builder $query): Builder => $query->whereRaw('current_scans >= (max_scans * 0.8)')),
        ])
        ->actions([
            ViewAction::make(),
            EditAction::make(),
            // Nouvelle action pour réinitialiser les stats
            Action::make('reset_stats')
                ->label('Réinitialiser')
                ->icon('heroicon-o-arrow-path')
                ->color('danger')
                ->requiresConfirmation()
                ->action(function (Card $record) {
                    $record->current_scans = 0;
                    $record->last_scanned_at = null;
                    $record->allowed_devices = null;
                    $record->save();
                }),
        ])
        ->bulkActions([
            BulkActionGroup::make([
                DeleteBulkAction::make(),
                BulkAction::make('activate')
                    ->label('Activer')
                    ->icon('heroicon-o-check-circle')
                    ->requiresConfirmation()
                    ->action(fn (Collection $records) => $records->each->update(['active' => true])),
                BulkAction::make('deactivate')
                    ->label('Désactiver')
                    ->icon('heroicon-o-x-circle')
                    ->requiresConfirmation()
                    ->action(fn (Collection $records) => $records->each->update(['active' => false])),
                // Nouvelle action groupée
                BulkAction::make('reset_stats_bulk')
                    ->label('Réinitialiser les stats')
                    ->icon('heroicon-o-arrow-path')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(fn (Collection $records) => $records->each(function ($record) {
                        $record->current_scans = 0;
                        $record->last_scanned_at = null;
                        $record->allowed_devices = null;
                        $record->save();
                    })),
            ]),
        ]);
    }
}
