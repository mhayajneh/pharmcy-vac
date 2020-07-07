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
      if ( !Schema::hasTable('users') ) {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->integer('type')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('number')->nullable();
            $table->string('location')->nullable();
            $table->string('area')->nullable();
            $table->string('city')->nullable();
            $table->string('cv_path')->nullable();
            $table->string('letter')->nullable();
            $table->string('image')->nullable();
            $table->string('manager')->nullable();
            $table->string('students')->nullable();
            $table->string('university')->nullable();
            $table->string('university_number')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
      }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      //Schema::dropIfExists('users');
    }
}
