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
        Schema::table('wishes', function (Blueprint $table) {
            // Menambah kolom reply setelah kolom message
            $table->text('reply')->nullable()->after('message');
        });
    }

    public function down()
    {
        Schema::table('wishes', function (Blueprint $table) {
            $table->dropColumn('reply');
        });
    }
};
