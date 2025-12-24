<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('card_id')
            ->constrained()
            ->onDelete('cascade')
            ->comment('ID de la carte associée');
            $table->text('content')
                ->comment('Contenu de la question');
            $table->enum('type', ['free', 'choice', 'noAnswer'])
                ->default('free')
                ->comment('Type de question: free (réponse libre), choice (choix multiples), noAnswer (sans réponse)');
            $table->text('answer')->nullable()
                ->comment('Réponse pour les questions de type free');
            $table->json('choices')->nullable()
                ->comment('Liste des choix possibles pour les questions de type choice');
            $table->integer('correct_choice')->nullable()
                ->comment('Index de la bonne réponse pour les questions à choix multiples');
            $table->boolean('active')->default(true)
                ->comment('Statut actif/inactif de la question');
            $table->timestamps();

            // Index
            $table->index('type');
            $table->index('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
