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
        Schema::create('tasques', function (Blueprint $table) {
            $table->id();
            $table->string('descripcio');
            $table->date('data_creacio');
            $table->date('data_finalitzacio')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('prioritat_id')->constrained('prioritats');
            $table->foreignId('estat_id')->constrained('estats');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tascas');
    }
};
