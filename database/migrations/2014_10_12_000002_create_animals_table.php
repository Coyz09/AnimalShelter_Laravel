<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('animal_Name');
            $table->string('animal_Type');
            $table->string('animal_Breed');
            $table->integer('animal_Age');
            $table->string('animal_Rescueplace');
            $table->date('animal_Rescuedate');
            $table->string('adoption_Status');
            $table->string('animal_Image');

            $table->unsignedBigInteger('injury_ID')->nullable();
            $table->foreign('injury_ID')->references('id')->on('injuries');


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
        Schema::dropIfExists('animals');
    }
}
