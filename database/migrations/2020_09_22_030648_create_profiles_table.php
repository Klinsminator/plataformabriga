<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('state');
            $table->integer('age');
            $table->string('gender');
            $table->boolean('prev_diagnostic');
            $table->boolean('prev_treatment');
            $table->text('commentary');
            $table->integer('applicant_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('recommendation_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
