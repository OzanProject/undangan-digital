<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('event_settings', function (Blueprint $table) {
            // Hapus kolom lama (jika ada)
            $table->dropColumn('turut_mengundang');
            
            // Tambah 2 kolom baru
            $table->text('turut_mengundang_ayah')->nullable()->after('parent_names');
            $table->text('turut_mengundang_ibu')->nullable()->after('turut_mengundang_ayah');
        });
    }

    public function down()
    {
        Schema::table('event_settings', function (Blueprint $table) {
            $table->dropColumn(['turut_mengundang_ayah', 'turut_mengundang_ibu']);
            $table->text('turut_mengundang')->nullable();
        });
    }
};
