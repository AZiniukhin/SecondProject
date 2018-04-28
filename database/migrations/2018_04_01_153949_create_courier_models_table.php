<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourierModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courier_models', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('TelBot');
            $table->string('Company')->nullable();
            $table->string('Name')->nullable();
            $table->string('Surname')->nullable();
            $table->string('Telephone')->nullable();
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
        Schema::dropIfExists('courier_models');
    }
}
