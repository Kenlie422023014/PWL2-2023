<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiPenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_penjualan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_products');
            $table->integer('jumlah_pembelian');
            $table->string('nama_kasir');
            $table->timestamp('tanggal_transaksi');
            $table->foreign('id_products')->references('id')->on('products')->onDelete('cascade'); // Foreign key
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
        Schema::dropIfExists('transaksi_penjualan');
    }
}
