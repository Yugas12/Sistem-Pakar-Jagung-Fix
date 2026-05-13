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
        Schema::table('diagnosa', function (Blueprint $table) {

            // Menyimpan hasil akhir Certainty Factor
            $table->double('cf_hasil')->default(0)->after('penyakit_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('diagnosa', function (Blueprint $table) {

            // Menghapus kolom cf_hasil
            $table->dropColumn('cf_hasil');

        });
    }
};