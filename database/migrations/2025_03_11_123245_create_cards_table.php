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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->enum('collection', ['MIMES', 'WORSHIP', 'QUIZ', 'GAGE'])
            ->comment('Type de jeu Hozana');
            $table->string('card_number')->nullable()
                ->comment('Numéro de la carte (optionnel)');
            $table->string('short_code')->unique()
                ->comment('Code court pour le QR code');
            $table->string('target_url')
                ->comment('URL de redirection');
            $table->text('description')->nullable()
                ->comment('Description ou instruction du jeu');
            $table->boolean('active')->default(true)
                ->comment('Statut actif/inactif de la carte');
            $table->unsignedInteger('clicks')->default(0)
                ->comment('Nombre de scans du QR code');
            $table->timestamps();

            // Index
            $table->index('collection');
            $table->index('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
