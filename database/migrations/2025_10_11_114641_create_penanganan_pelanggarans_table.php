<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penanganan_pelanggarans', function (Blueprint $table) {
            $table->id();
            $table->enum('kategori', ['ringan', 'sedang', 'berat']);
            $table->integer('skor_min');
            $table->integer('skor_max');
            $table->string('tindak_lanjut');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penanganan_pelanggarans');
    }
};
