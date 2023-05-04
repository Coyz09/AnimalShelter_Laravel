<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdopterAnimalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adopter_animal', function ($table) {

            $table->BigInteger('adopter_id')->unsigned();
            $table->foreign('adopter_id')->references('id')->on('adopters');
            $table->BigInteger('animal_id')->unsigned();
            $table->foreign('animal_id')->references('id')->on('animals');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adopter_animal');
    }
}
