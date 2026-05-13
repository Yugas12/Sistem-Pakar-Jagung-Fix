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
        Schema::create('aturan', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel penyakit
            $table->foreignId('penyakit_id')
                  ->constrained('penyakit')
                  ->cascadeOnDelete();

            // Relasi ke tabel gejala
            $table->foreignId('gejala_id')
                  ->constrained('gejala')
                  ->cascadeOnDelete();

            // Nilai keyakinan pakar
            $table->float('cf_pakar')->default(0);

            // Mencegah data aturan duplikat
            $table->unique(['penyakit_id', 'gejala_id']);

            // created_at dan updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aturan');
    }
};