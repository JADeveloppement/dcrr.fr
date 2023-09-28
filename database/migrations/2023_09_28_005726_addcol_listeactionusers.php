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
        Schema::table('listeActionUsers', function (Blueprint $table) {
            $table->integer("actionFrom");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('listeActionUsers', function (Blueprint $table) {
            $table->dropColumn('actionFrom');
        });
    }
};
