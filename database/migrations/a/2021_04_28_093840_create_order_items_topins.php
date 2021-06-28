<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTopins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items_topins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tId');
            $table->string('pId');
            $table->string('pSize');
            $table->string('pFcream');
            $table->string('pSkim');
            $table->string('pSoy');
            $table->string('pAlmond');
            $table->string('pOat');
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
        Schema::dropIfExists('order_items_topins');
    }
}
