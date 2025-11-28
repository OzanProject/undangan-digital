<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('event_settings', function (Blueprint $table) {
            $table->string('audio_path')->nullable()->after('hero_image');
        });
    }

    public function down()
    {
        Schema::table('event_settings', function (Blueprint $table) {
            $table->dropColumn('audio_path');
        });
    }
};
