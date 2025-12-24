<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardController;

Route::prefix('api')->group(function () {
    // Route pour récupérer une carte par son code court
    Route::get('/cards/{shortCode}', [CardController::class, 'getByShortCode']);

    // Route de vérification de santé
    Route::get('/health', function() {
        return response()->json([
            'status' => 'ok',
            'environment' => app()->environment(),
            'timestamp' => now()->toIso8601String()
        ]);
    });
});

Route::get('/', function () {
    return view('homepage');
});

Route::get('/games', function () {
    return view('games.index');
});

Route::get('/game/quiz', function () {
    return view('games.quiz');
});

Route::get('/game/mime', function () {
    return view('games.mime');
});

Route::get('/game/worship', function () {
    return view('games.worship');
});

Route::get('/about', function () {
    return view('about.index');
});


// Route pour afficher une carte par son code court
Route::get('/card/{shortCode}', [CardController::class, 'show'])->name('card.show');

// Redirection pour compatibilité (si nécessaire)
Route::get('/cards/{shortCode}', function ($shortCode) {
    return redirect()->route('card.show', ['shortCode' => $shortCode]);
});
