<?php

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
            $table->increments('id');
            $table->string('fullname')->nullable();
            $table->string('username')->nullable()->unique();
            $table->string('occupation')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('password', 60)->nullable();
            $table->bigInteger('facebookID')->default(0);
            $table->bigInteger('twitterID')->default(0);
            $table->bigInteger('githubID')->default(0);
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
        Schema::drop('users');
    }
}
