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
        Schema::table('event_settings', function (Blueprint $table) {
            // Foto & Visual
            $table->string('hero_image')->nullable(); // Foto Background Utama
            $table->string('child_photo')->nullable(); // Foto Profil Anak
            
            // Info Rekening (Gift)
            $table->string('bank_name_1')->nullable(); // Misal: BCA
            $table->string('bank_acc_1')->nullable(); // No Rekening
            $table->string('bank_holder_1')->nullable(); // Atas Nama
            
            $table->string('bank_name_2')->nullable(); // Misal: DANA
            $table->string('bank_acc_2')->nullable(); 
            $table->string('bank_holder_2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_settings', function (Blueprint $table) {
            //
        });
    }
};
