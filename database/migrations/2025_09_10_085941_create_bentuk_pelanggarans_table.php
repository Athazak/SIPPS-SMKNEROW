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
        Schema::create('bentuk_pelanggarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_id')->constrained('jenis_pelanggarans')->cascadeOnDelete();
            $table->string('bentuk');
            $table->integer('skor')->default(0);
            $table->string('sanksi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bentuk_pelanggarans');
    }
};
