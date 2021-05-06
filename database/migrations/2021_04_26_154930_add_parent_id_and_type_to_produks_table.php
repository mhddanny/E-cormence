<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParentIdAndTypeToProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id')->after('kd_produk')->nullable();
            $table->string('type')->after('kode');
            $table->integer('length')->after('weight')->nullable();
            $table->integer('width')->after('length')->nullable();
            $table->integer('height')->after('width')->nullable();
            
            $table->foreign('parent_id')->references('kd_produk')->on('produks');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->dropForeign('produks_parent_id_foreign');
            $table->dropColumn('parent_id');
            $table->dropColumn('type');
            $table->dropColumn('length');
            $table->dropColumn('width');
            $table->dropColumn('height');
        });
    }
}
