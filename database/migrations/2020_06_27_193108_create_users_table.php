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
        // on user_type_id, this should match the tables name + _id
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->timestamp('last_sign_in');
            $table->string('names');
            $table->string('last_names');
            $table->integer('user_type_id');
            $table->string('email');
            $table->string('username');
            $table->string('password');
            /*
             * rememberme checkbox, cookies, etc
             * */
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
