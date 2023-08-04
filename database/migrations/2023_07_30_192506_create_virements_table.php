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
        Schema::create('virements', function (Blueprint $table) {
            $table->id();

            $table->string("nom_beneficiaire")->nullable();
            $table->string("nom_banque")->nullable();
            $table->string("rib", 24)->nullable();
            $table->string("code_swift")->nullable();
            $table->text("adresse_agence")->nullable();
            $table->date("date");
            $table->float("montant", 16, 2);
            $table->text("description");

            $table->enum('status', ["Brouillon", "En cours", "Traité"])->default("Brouillon");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('virements');
    }
};
