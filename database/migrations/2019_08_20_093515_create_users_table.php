<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->text('address')->nullable();
            $table->string('phone');
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('imgname')->nullable();
            $table->string('preference')->nullable();
            $table->string('delivery_method')->nullable();
            $table->string('pizza_size')->nullable();
            $table->string('fav_com')->nullable();
            $table->tinyInteger('buffet')->nullable();
            $table->tinyInteger('isActive')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('code')->nullable();
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
