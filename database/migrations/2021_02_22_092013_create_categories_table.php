<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('kd_kategori');
            $table->string('kategori',255);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('slug');
            $table->enum('tipe',['Fashion Pria', 'Fashion Wanita'])->nullable();
            $table->string('gambar_kategori',255)->nullable();
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
        Schema::dropIfExists('categories');
    }
}
