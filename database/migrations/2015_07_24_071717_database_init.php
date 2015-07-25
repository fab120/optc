<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DatabaseInit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function ($t) {
            $t->bigIncrements('id');
            $t->string('username');
            $t->boolean('tweet_remover_enabled')->default(true);
            $t->string('oauth_token');
            $t->string('oauth_token_secret');

            $t->timestamps();

            //$t->primary('id');
        });

        Schema::create('deletestats', function ($t) {
            $t->increments('id');
            $t->bigInteger('user_id')->unsigned();
            $t->date('data');
            $t->tinyInteger('count');
            $t->timestamps();

            $t->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deletestats', function ($t) {
            $t->dropForeign('deletestats_user_id_foreign');
        });

        Schema::drop('deletestats');
        Schema::drop('users');
    }
}
