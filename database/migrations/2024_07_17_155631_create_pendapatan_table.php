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
        Schema::create('pendapatan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_klasifikasi');
            $table->string('item_pendapatan');
            $table->date('tgl_pendapatan');
            $table->integer('tagihan');
            $table->integer('retur');
            $table->integer('penerimaan');
            $table->integer('kekurangan');
            $table->integer('kelebihan');
            $table->string('keterangan');
            $table->integer('user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendapatan');
    }
};
