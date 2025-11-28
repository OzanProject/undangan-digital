<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('event_settings', function (Blueprint $table) {
            $table->string('logo_path')->nullable()->after('child_photo');
        });
    }

    public function down()
    {
        Schema::table('event_settings', function (Blueprint $table) {
            $table->dropColumn('logo_path');
        });
    }
};
