<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('entertainments', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama Hiburan (misal: Gambus El-Corona)
            $table->string('type'); // Jenis (misal: Musik, Tausiyah)
            $table->string('time'); // Waktu (misal: 09:00 - 12:00 WIB)
            $table->string('image')->nullable(); // Foto/Poster
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entertainments');
    }
};
