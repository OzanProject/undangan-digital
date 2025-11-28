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
        Schema::create('event_settings', function (Blueprint $table) {
            $table->id();
            $table->string('child_name'); // Nama Anak
            $table->string('parent_names'); // Nama Orang Tua
            $table->dateTime('event_date'); // Tanggal Acara
            $table->string('location_name'); // Nama Gedung/Tempat
            $table->text('location_address'); // Alamat Lengkap
            $table->text('maps_iframe')->nullable(); // Link Embed Google Maps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_settings');
    }
};
