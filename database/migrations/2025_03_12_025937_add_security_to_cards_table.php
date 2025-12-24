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
        Schema::table('cards', function (Blueprint $table) {
            $table->integer('max_scans')->default(1000); // Nombre maximum de scans autorisés
            $table->integer('current_scans')->default(0); // Nombre actuel de scans
            $table->timestamp('last_scanned_at')->nullable(); // Dernier scan
            $table->json('allowed_devices')->nullable(); // IDs des appareils autorisés
            $table->string('verification_code')->nullable(); // Code secondaire de vérification
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cards', function (Blueprint $table) {
            $table->dropColumn([
                'max_scans',
                'current_scans',
                'last_scanned_at',
                'allowed_devices',
                'verification_code',
            ]);
        });
    }
};
