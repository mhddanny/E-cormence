<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->bigIncrements('kd_produk');
            $table->unsignedBigInteger('kd_kategori');
            $table->foreign('kd_kategori')->references('kd_kategori')->on('categories')->onDelete('cascade');
            $table->string('kode');
            $table->string('name');
            $table->integer('price');
            $table->integer('weight');
            $table->text('description')->nullable();
            $table->integer('status');
            $table->string('slug');
            $table->string('image',255)->nullable();
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
        Schema::dropIfExists('produks');
    }
}
