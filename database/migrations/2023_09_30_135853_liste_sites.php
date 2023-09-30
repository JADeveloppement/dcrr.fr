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
        Schema::create('listeSites', function (Blueprint $table) {
            $table->id();
            $table->string('code_client');
            $table->string('nom_client');
            $table->string('nom_site');
            $table->string('code_site');
            $table->integer('marque');
            $table->string('date_mise_en_service');
            $table->integer('fluide_frigorigène');
            $table->string('designation_equipement');
            $table->string('conforme');
            $table->integer('proprietaire');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
        //
    }
};
