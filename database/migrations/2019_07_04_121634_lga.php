<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Lga extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lgas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('state_id')->unsigned();
            $table->integer('constituency_id')->nullable()->unsigned();
            $table->timestamps();
        });

        Schema::table('lgas', function ($table) {
            $table->foreign('state_id')->references('id')->on('states')->onDelete('restrict');
            $table->foreign('constituency_id')->references('id')->on('constituencies')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lgas');
    }
}
