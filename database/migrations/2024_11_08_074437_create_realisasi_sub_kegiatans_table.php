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
        Schema::create('realisasi_sub_kegiatans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('sub_kegiatan_id')->references('id')->on('sub_kegiatans')->onDelete('cascade');
            $table->foreignUuid('indikator_id')->references('id')->on('indikator_sub_kegiatans')->onDelete('cascade');
            $table->foreignUuid('satuan_id')->references('id')->on('satuans')->onDelete('cascade');
            $table->string('indikator');
            $table->string('anggaran');
            $table->integer('target')->default(0);
            $table->integer('tw_1_anggaran')->default(0);
            $table->integer('tw_2_anggaran')->default(0);
            $table->integer('tw_3_anggaran')->default(0);
            $table->integer('tw_4_anggaran')->default(0);
            $table->integer('tw_1_fisik')->default(0);
            $table->integer('tw_2_fisik')->default(0);
            $table->integer('tw_3_fisik')->default(0);
            $table->integer('tw_4_fisik')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realisasi_sub_kegiatans');
    }
};
