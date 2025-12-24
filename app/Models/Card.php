<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'collection',
        'card_number',
        'short_code',
        'target_url',
        'description',
        'active',
        'clicks',
        'max_scans',
        'current_scans',
        'last_scanned_at',
        'allowed_devices',
        'verification_code',
    ];

    protected $casts = [
        'active' => 'boolean',
        'clicks' => 'integer',
        'max_scans' => 'integer',
        'current_scans' => 'integer',
        'allowed_devices' => 'array',
        'last_scanned_at' => 'datetime',
    ];

    /**
     * Les types de collection disponibles
     */
    public const COLLECTIONS = [
        'MIMES' => 'Hozana MIMES',
        'WORSHIP' => 'Hozana WORSHIP',
        'QUIZ' => 'Hozana QUIZ',
        'GAGE' => 'Hozana GAGE',
    ];

    /**
     * Get the questions associated with the card.
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    /**
     * Increment le compteur de clics
     */
    public function incrementClicks(): void
    {
        $this->increment('clicks');
    }
}
