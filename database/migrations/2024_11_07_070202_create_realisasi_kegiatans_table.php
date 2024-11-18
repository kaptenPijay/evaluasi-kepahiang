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
        Schema::create('realisasi_kegiatans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('indikator');
            $table->foreignUuid('kegiatan_id')->references('id')->on('kegiatans')->onDelete('cascade');
            $table->foreignUuid('indikator_id')->references('id')->on('indikator_kegiatans')->onDelete('cascade');
            $table->foreignUuid('satuan_id')->references('id')->on('satuans')->onDelete('cascade');
            $table->integer('target')->default(0);
            $table->integer('tw_1')->default(0);
            $table->integer('tw_2')->default(0);
            $table->integer('tw_3')->default(0);
            $table->integer('tw_4')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realisasi_kegiatans');
    }
};
