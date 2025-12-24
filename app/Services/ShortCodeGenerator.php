<?php

namespace App\Services;

use App\Models\Card;

class ShortCodeGenerator
{
    /**
     * Génère un code court unique pour les cartes
     * 
     * @param int $length Longueur du code
     * @return string
     */
    public function generate(int $length = 6): string
    {
        $chars = 'abcdefghjkmnpqrstuvwxyz23456789';
        $shortCode = '';
        $isUnique = false;
        
        while (!$isUnique) {
            $shortCode = '';
            
            for ($i = 0; $i < $length; $i++) {
                $shortCode .= $chars[rand(0, strlen($chars) - 1)];
            }
            
            // Vérifier que le code n'existe pas déjà
            $existingCard = Card::where('short_code', $shortCode)->exists();
            $isUnique = !$existingCard;
        }
        
        return $shortCode;
    }
}