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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('email');
            $table->string('telephone')->nullable();
            $table->string('status');
            $table->string('devise');
            $table->string('montant');
            $table->string('transaction_id')->unique();
            $table->string('token');
            $table->string('dateDisponibilite')->nullable();
            $table->string('motif')->nullable();
            $table->string('methode')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Pack::class)->nullable();
            $table->foreignIdFor(\App\Models\Certif::class)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
