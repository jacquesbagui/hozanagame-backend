<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CardController extends Controller
{
    /**
     * Récupérer une carte par son code court (API)
     *
     * @param string $shortCode
     * @return JsonResponse
     */
    public function getByShortCode(string $shortCode): JsonResponse
    {
        try {
            // Trouver la carte avec le code court
            $card = Card::where('short_code', $shortCode)
                ->where('active', true)
                ->with(['questions' => function ($query) {
                    $query->where('active', true);
                }])
                ->first();

            if (!$card) {
                return response()->json([
                    'error' => 'Carte non trouvée',
                    'message' => 'Cette carte n\'existe pas ou a été désactivée'
                ], 404);
            }

            // Incrémenter le compteur de clics
            $card->incrementClicks();

            // Sélectionner une question aléatoire si disponible
            $randomQuestion = null;
            if ($card->questions->count() > 0) {
                $randomQuestion = $card->questions->random();
            }

            // Formater la réponse
            $response = $this->formatResponse($card, $randomQuestion);

            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erreur serveur',
                'message' => 'Une erreur est survenue lors du traitement de votre requête',
                'details' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Affiche les détails d'une carte Hozana à partir de son code court (Web)
     *
     * @param string $shortCode
     * @return View
     */
    public function show(Request $request, string $shortCode): View
    {
        try {
            $card = Card::where('short_code', $shortCode)
                ->where('active', true)
                ->with(['questions' => function ($query) {
                    $query->where('active', true);
                }])
                ->first();

            if (!$card) {
                // Si la carte n'existe pas ou est inactive
                return view('cards.error', [
                    'message' => 'Cette carte n\'existe pas ou a été désactivée',
                    'code' => $shortCode
                ]);
            }

            // Gestion des appareils
            $deviceId = $request->cookie('device_id') ?? Str::uuid()->toString();
            $allowedDevices = json_decode($card->allowed_devices) ?? [];

            /*if (count($allowedDevices) >= 3 && !in_array($deviceId, $allowedDevices)) {
                return view('cards.error', [
                    'message' => 'Cette carte a atteint son nombre maximum d\'appareils',
                    'code' => $shortCode
                ]);
            }*/
            
            // Si nouveau appareil, l'ajouter à la liste
            if (!in_array($deviceId, $allowedDevices)) {
                $allowedDevices[] = $deviceId;
                $card->allowed_devices = json_encode($allowedDevices);
            }

            // Incrémenter le compteur de clics
            $card->incrementClicks();

            // Sélectionner une question aléatoire si disponible
            $randomQuestion = null;
            if ($card->questions->count() > 0) {
                $randomQuestion = $card->questions->random();
            }

            $cardData = $this->formatResponse($card, $randomQuestion);

            // Mettre à jour les statistiques
            $card->current_scans++;
            $card->last_scanned_at = now();
            $card->save();
            
            // Créer un cookie pour l'identification de l'appareil
            Cookie::queue('device_id', $deviceId, 60 * 24 * 30); // 30 jours
            
            // Déterminer le template en fonction du type de jeu
            $template = match ($cardData['gameType']) {
                'QUIZ' => 'cards.quiz',
                'WORSHIP' => 'cards.worship',
                'MIMES' => 'cards.mime',
                'GAGE' => 'cards.gage',
                default => 'cards.generic'
            };
            
            return view($template, [
                'card' => $cardData,
            ]);
            
        } catch (\Exception $e) {
            // En cas d'erreur
            return view('cards.error', [
                'message' => 'Une erreur est survenue lors du chargement de cette carte: ' . ($e->getMessage()),
                'code' => $shortCode
            ]);
        }
    }

    /**
     * Formater la réponse avec la carte et la question
     *
     * @param Card $card
     * @param Question|null $question
     * @return array
     */
    protected function formatResponse(Card $card, ?Question $question = null): array
    {
        $baseResponse = [
            'gameType' => $card->collection,
            'description' => $card->description
        ];

        if ($question) {
            switch ($question->type) {
                case 'choice':
                    return [
                        ...$baseResponse,
                        'question' => [
                            'type' => 'choice',
                            'content' => $question->content,
                            'choices' => $question->choices,
                            'correctChoice' => $question->correct_choice
                        ]
                    ];
                case 'free':
                    return [
                        ...$baseResponse,
                        'question' => [
                            'type' => 'free',
                            'content' => $question->content,
                            'answer' => $question->answer
                        ]
                    ];
                case 'noAnswer':
                    return [
                        ...$baseResponse,
                        'question' => [
                            'type' => 'noAnswer',
                            'content' => $question->content
                        ]
                    ];
            }
        }

        return $baseResponse;
    }
}