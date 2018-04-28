<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYakitoryOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yakitory_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('TelBot')->nullable();
            $table->string('TelClient')->nullable();
            $table->string('Address')->nullable();
            $table->string('NumberOrder')->nullable();
            $table->string('Status')->default('wait');
            $table->string('TimeDelivery')->nullable();
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
        Schema::dropIfExists('yakitory_orders');
    }
}
