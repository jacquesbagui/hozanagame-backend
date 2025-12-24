<?php

use App\Http\Controllers\CardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('api')->group(function () {
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
