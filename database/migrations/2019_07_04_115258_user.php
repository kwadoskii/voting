<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class User extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vin', 12)->unique();
            $table->string('first_name');
            $table->string('mid_name')->nullable();
            $table->string('last_name');
            $table->string('phone')->nullable();
            $table->string('gender');
            $table->date('DOB');
            $table->string('address', 200);
            $table->integer('constituency_id');
            $table->integer('lga_id');
            $table->integer('state_id');
            $table->string('email', 150)->nullable();
            $table->string('password');
            $table->boolean('isvoted')->default(false);
            $table->timestamps();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
