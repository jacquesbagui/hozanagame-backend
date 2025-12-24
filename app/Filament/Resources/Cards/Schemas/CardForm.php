<?php

namespace App\Filament\Resources\Cards\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Actions\Action;
use App\Models\Card;
use Illuminate\Support\Str;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Components\Utilities\Get as SchemasGet;
use Filament\Schemas\Components\Utilities\Set as SchemasSet;

class CardForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informations principales')
                    ->description('Informations de base de la carte')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        Select::make('collection')
                            ->label('Collection')
                            ->options(Card::COLLECTIONS)
                            ->required()
                            ->columnSpan(1),

                        TextInput::make('card_number')
                            ->label('Numéro de carte')
                            ->maxLength(255)
                            ->columnSpan(1),

                        Textarea::make('description')
                            ->label('Description')
                            ->rows(3)
                            ->columnSpanFull()
                            ->helperText('Description de la carte qui sera visible par les utilisateurs'),

                        Toggle::make('active')
                            ->label('Carte active')
                            ->helperText('Désactiver pour masquer cette carte aux utilisateurs')
                            ->default(true)
                            ->required()
                            ->columnSpan(1),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Section::make('Identifiants et URLs')
                    ->description('Codes et URLs générés automatiquement')
                    ->icon('heroicon-o-link')
                    ->schema([
                        TextInput::make('short_code')
                            ->label('Code court')
                            ->helperText('Code unique pour accéder à la carte')
                            ->maxLength(255)
                            ->disabled()
                            ->dehydrated()
                            ->visible(fn ($record) => $record !== null)
                            ->columnSpan(1),

                        TextInput::make('target_url')
                            ->label('URL cible')
                            ->helperText('URL de redirection après scan de la carte')
                            ->maxLength(255)
                            ->disabled()
                            ->dehydrated()
                            ->visible(fn ($record) => $record !== null)
                            ->columnSpan(1),
                    ])
                    ->columns(2)
                    ->collapsible()
                    ->visible(fn ($record) => $record !== null),

                Section::make('Questions')
                    ->description('Définissez les questions associées à cette carte')
                    ->icon('heroicon-o-question-mark-circle')
                    ->schema([
                        Repeater::make('questions')
                            ->relationship()
                            ->schema([
                            Select::make('type')
                                ->label('Type de question')
                                ->options(\App\Models\Question::TYPES)
                                ->default('free')
                                ->required()
                                ->live()
                                ->afterStateUpdated(function (SchemasGet $get, SchemasSet $set, $state) {
                                    // Réinitialiser les valeurs selon le type de question
                                    if ($state === 'free') {
                                        $set('choices_text', null);
                                        $set('choices', null);
                                        $set('correct_choice', null);
                                    }
                                    elseif ($state === 'choice') {
                                        $set('answer', null);

                                        // Ajouter des options par défaut uniquement si nécessaire
                                        $currentChoices = $get('choices_text');
                                        if (empty($currentChoices)) {
                                            $set('choices_text', "Option 1\nOption 2");
                                            $set('choices', ['Option 1', 'Option 2']); // Important: définir les choix ici aussi
                                            $set('correct_choice', 0);
                                        }
                                    }
                                    elseif ($state === 'noAnswer') {
                                        $set('answer', null);
                                        $set('choices_text', null);
                                        $set('choices', null);
                                        $set('correct_choice', null);
                                    }
                                }),

                            Textarea::make('content')
                                ->label('Contenu de la question')
                                ->required()
                                ->rows(3)
                                ->columnSpanFull(),

                            Textarea::make('answer')
                                ->label('Réponse')
                                ->rows(2)
                                ->hidden(fn ($get) => $get('type') !== 'free')
                                ->required(fn ($get) => $get('type') === 'free')
                                ->columnSpanFull(),

                            // Champ pour stocker le texte des choix
                            Textarea::make('choices_text')
                                ->label('Choix (un par ligne)')
                                ->helperText('Entrez chaque choix sur une ligne différente.')
                                ->hidden(fn ($get) => $get('type') !== 'choice')
                                ->required(fn ($get) => $get('type') === 'choice')
                                ->default("Option 1\nOption 2")
                                ->rows(4)
                                ->columnSpanFull()
                                ->live()
                                ->afterStateUpdated(function (SchemasGet $get, SchemasSet $set, $state) {
                                    // Convertir le texte en tableau de choix et le stocker
                                    $choices = array_filter(
                                        array_map('trim', explode("\n", $state ?? '')),
                                        fn ($line) => !empty($line)
                                    );

                                    // Mettre à jour le champ 'choices' directement
                                    $set('choices', $choices);

                                    // Vérifier et ajuster correct_choice si nécessaire
                                    $correctChoice = (int) $get('correct_choice');
                                    if ($correctChoice >= count($choices)) {
                                        $set('correct_choice', 0);
                                    }
                                })
                                ->afterStateHydrated(function (SchemasSet $set, $state, $record) {
                                    // Si nous avons des choix dans la base de données, les convertir en texte
                                    if ($record && property_exists($record, 'choices') && is_array($record->choices)) {
                                        $set('choices_text', implode("\n", $record->choices));
                                    }
                                }),

                            // Champ caché pour stocker le tableau de choix
                            Hidden::make('choices')
                                ->default([])
                                // Toujours hydrater pour les questions de type choice
                                ->dehydrated(fn ($get) => $get('type') === 'choice'),

                            Select::make('correct_choice')
                                ->label('Réponse correcte')
                                ->options(function (SchemasGet $get) {
                                    $choicesText = $get('choices_text');

                                    if (empty($choicesText)) {
                                        return [0 => 'Option 1'];
                                    }

                                    $choices = array_filter(
                                        array_map('trim', explode("\n", $choicesText)),
                                        fn ($line) => !empty($line)
                                    );

                                    if (empty($choices)) {
                                        return [0 => 'Option 1'];
                                    }

                                    return array_combine(
                                        range(0, count($choices) - 1),
                                        $choices
                                    );
                                })
                                ->hidden(fn ($get) => $get('type') !== 'choice')
                                ->required(fn ($get) => $get('type') === 'choice')
                                ->live()
                                ->default(0),

                            Toggle::make('active')
                                ->label('Question active')
                                ->default(true),

                            // Placeholder de débogage (désactivé en production)
                            // Placeholder::make('debug_choices')
                            //     ->label('Informations de débogage')
                            //     ->content(function (SchemasGet $get) {
                            //         $choicesText = $get('choices_text');
                            //         $choices = $get('choices');
                            //         $correctChoice = $get('correct_choice');
                            //
                            //         if ($get('type') !== 'choice') {
                            //             return '';
                            //         }
                            //
                            //         $info = "Texte des choix: " . ($choicesText ? strlen($choicesText) . " caractères" : "vide") . "\n";
                            //         $info .= "Tableau de choix: " . (is_array($choices) ? count($choices) . " éléments" : "non défini") . "\n";
                            //         $info .= "Choix correct: " . (is_numeric($correctChoice) ? $correctChoice : "non défini");
                            //
                            //         return $info;
                            //     })
                            //     ->hidden(fn ($get) => $get('type') !== 'choice')
                            //     ->columnSpanFull(),
                        ])
                            ->itemLabel(fn (array $state): ?string => $state['content'] ? Str::limit($state['content'], 50) : null)
                            ->collapsible()
                            ->reorderableWithButtons()
                            ->addActionLabel('Ajouter une question')
                            ->defaultItems(0)
                            ->columnSpanFull()
                    ])
                    ->collapsible(),

                Section::make('Paramètres de sécurité')
                    ->description('Configuration des limites et codes de vérification')
                    ->icon('heroicon-o-shield-check')
                    ->schema([
                        TextInput::make('max_scans')
                            ->label('Nombre maximum de scans')
                            ->helperText('Limite du nombre de fois que cette carte peut être scannée')
                            ->numeric()
                            ->default(1000)
                            ->minValue(1)
                            ->required()
                            ->columnSpan(1),

                        TextInput::make('verification_code')
                            ->label('Code de vérification')
                            ->helperText('Code secondaire optionnel (ex: imprimé sur la carte physique)')
                            ->maxLength(255)
                            ->columnSpan(1),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Section::make('Statistiques et suivi')
                    ->description('Informations sur l\'utilisation de la carte')
                    ->icon('heroicon-o-chart-bar')
                    ->schema([
                        TextInput::make('current_scans')
                            ->label('Scans actuels')
                            ->helperText('Nombre de fois que la carte a été scannée')
                            ->numeric()
                            ->default(0)
                            ->disabled()
                            ->dehydrated()
                            ->columnSpan(1),

                        DateTimePicker::make('last_scanned_at')
                            ->label('Dernier scan')
                            ->helperText('Date et heure du dernier scan')
                            ->disabled()
                            ->dehydrated()
                            ->columnSpan(1),

                        Textarea::make('allowed_devices')
                            ->label('Appareils autorisés')
                            ->helperText('Liste des identifiants d\'appareils qui ont accédé à cette carte')
                            ->disabled()
                            ->dehydrated()
                            ->rows(3)
                            ->columnSpanFull(),

                        // Bouton pour réinitialiser les statistiques
                        Action::make('reset_stats')
                            ->label('Réinitialiser les statistiques')
                            ->icon('heroicon-o-arrow-path')
                            ->color('danger')
                            ->requiresConfirmation()
                            ->modalHeading('Réinitialiser les statistiques')
                            ->modalDescription('Êtes-vous sûr de vouloir réinitialiser toutes les statistiques de cette carte ? Cette action est irréversible.')
                            ->modalSubmitActionLabel('Réinitialiser')
                            ->action(function (Card $record) {
                                $record->current_scans = 0;
                                $record->last_scanned_at = null;
                                $record->allowed_devices = null;
                                $record->save();
                            })
                            ->visible(fn ($record) => $record !== null),
                    ])
                    ->columns(2)
                    ->collapsible()
                    ->visible(fn ($record) => $record !== null),
            ]);
    }
}
