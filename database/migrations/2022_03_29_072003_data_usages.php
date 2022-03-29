<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DataUsages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_usages', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang', 100);
            $table->dateTime('waktu_pakai');
            $table->dateTime('waktu_beres');
            $table->string('nama_pemakai', 100);
            $table->enum('status', ['SELESAI', 'BELUM_SELESAI']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_usages');
    }
}
