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
        Schema::table('detail_diagnosa', function (Blueprint $table) {

            // Menyimpan nilai keyakinan user
            $table->double('cf_user')->default(0)->after('gejala_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_diagnosa', function (Blueprint $table) {

            // Menghapus kolom cf_user
            $table->dropColumn('cf_user');

        });
    }
};