<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_positions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pharmacy_id');
            $table->string('title')->nullable();
            $table->integer('is_visible')->nullable();
            $table->date('last_apply_date')->nullable();
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
        Schema::dropIfExists('training_positions');
    }
}
