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
        Schema::create('detail_diagnosa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diagnosa_id')->nullable()->constrained('diagnosa')->nullOnDelete();
            $table->foreignId('gejala_id')->nullable()->constrained('gejala')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_diagnosa');
    }
};
