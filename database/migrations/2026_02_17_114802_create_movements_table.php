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
        Schema::create('movements', function (Blueprint $table) {
            $table->id();
            // Relie le mouvement à un produit (si on supprime le produit, l'historique part aussi)
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            
            // Quantité qui a bougé (ex: 10 ou -5)
            $table->integer('quantity'); 
            
            // Type de mouvement : 'Entrée' (Achat/Stock) ou 'Sortie' (Vente/Perte)
            $table->string('type'); 
            
            // Optionnel : Pour savoir pourquoi (ex: "Vente client", "Réception fournisseur")
            $table->string('comment')->nullable(); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movements');
    }
};
