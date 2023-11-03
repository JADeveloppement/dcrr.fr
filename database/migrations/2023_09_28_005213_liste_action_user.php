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
        Schema::create('listeActionUsers', function (Blueprint $table) {
            $table->id();
            $table->integer('parentId');
            $table->integer('actionFrom');
            $table->string('nomprenom');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('telephone');
            $table->string('entreprise');
            $table->string('poste');
            $table->integer('newsletter');
            $table->integer('role');
            $table->integer('active');
            $table->timestamp('createdAt')->nullable();
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
