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
            $table->bigIncrements('id');
            $table->string('firstName')->nullable();
            $table->string('lastName')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->char('estado',1)->default('A'); //A = Activo , I = Inactivo
            $table->string('usuarioCreacion',100)->nullable();
            $table->string('usuarioModificacion',100)->nullable();
            $table->rememberToken();
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
