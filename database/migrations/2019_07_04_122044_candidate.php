<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Candidate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->unique();
            $table->integer('party_id')->unsigned();
            $table->integer('office_id')->unsigned();
            $table->integer('constituency_id')->nullable()->unsigned();
            $table->integer('state_id')->nullable()->unsigned();
            $table->timestamps();
        });

        Schema::table('candidates', function($table){
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('party_id')->references('id')->on('parties')->onDelete('restrict');
            $table->foreign('office_id')->references('id')->on('offices')->onDelete('restrict');
            $table->foreign('constituency_id')->references('id')->on('constituencies')->onDelete('restrict');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidates');
    }
}
