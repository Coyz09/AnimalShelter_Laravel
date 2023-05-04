<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalInjuryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animal_injury', function ($table) {

            $table->BigInteger('animal_id')->unsigned();
            $table->foreign('animal_id')->references('id')->on('animals');
            $table->BigInteger('injury_id')->unsigned();
            $table->foreign('injury_id')->references('id')->on('injuries');
            
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animal_injury');
    }
}
