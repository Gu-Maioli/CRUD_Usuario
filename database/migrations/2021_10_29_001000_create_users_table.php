<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->string('nome')->nullable(false);
            $table->date('data_nascimento')->nullable();
            $table->string('cpf', 14)->nullable(false);
            $table->string('email', 50)->nullable();
            $table->integer('logradouro_id')->unsigned();
            $table->foreign('logradouro_id')->references('id')->on('logradouros');

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
        Schema::dropIfExists('users');
    }
}
