<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'card_id',
        'content',
        'type',
        'answer',
        'choices',
        'correct_choice',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
        'choices' => 'array',
        'correct_choice' => 'integer',
    ];

    /**
     * Les types de questions disponibles
     */
    public const TYPES = [
        'free' => 'Question avec réponse libre',
        'choice' => 'Question à choix multiples',
        'noAnswer' => 'Question sans réponse',
    ];

    /**
     * Get the card that owns the question.
     */
    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }

    /**
     * Determine if this is a free text question
     */
    public function isFreeTextQuestion(): bool
    {
        return $this->type === 'free';
    }

    /**
     * Determine if this is a multiple choice question
     */
    public function isMultipleChoiceQuestion(): bool
    {
        return $this->type === 'choice';
    }

    /**
     * Determine if this is a question without answer
     */
    public function isNoAnswerQuestion(): bool
    {
        return $this->type === 'noAnswer';
    }
}