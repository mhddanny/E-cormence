<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukAttributeValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_attribute_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('kd_produk');
            $table->foreign('kd_produk')->references('kd_produk')->on('produks')->onDelete('cascade');
            $table->foreignId('atribute_id')->constrained('atributes');
            $table->text('text_value')->nullable();
            $table->boolean('boolean_vale')->nullable();
            $table->integer('integer_value')->nullable();
            $table->decimal('float_value')->nullable();
            $table->datetime('datetime_valur')->nullable();
            $table->date('date_value')->nullable(); 
            $table->text('json_value')->nullable();
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
        Schema::dropIfExists('produk_attribute_values');
    }
}
