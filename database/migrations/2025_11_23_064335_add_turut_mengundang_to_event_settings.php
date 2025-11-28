<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('event_settings', function (Blueprint $table) {
            // Kolom teks panjang (Nullable)
            $table->text('turut_mengundang')->nullable()->after('parent_names');
        });
    }

    public function down()
    {
        Schema::table('event_settings', function (Blueprint $table) {
            $table->dropColumn('turut_mengundang');
        });
    }
};
