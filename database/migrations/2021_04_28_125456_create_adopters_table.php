<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdoptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adopters', function (Blueprint $table) {
            $table->id();
            $table->string('adopter_Fname');
            $table->string('adopter_Lname');
            $table->string('adopter_Address');
            $table->integer('adopter_Contact');
            $table->string('adopter_Email');
            $table->integer('user_id');

            $table->unsignedBigInteger('animal_ID')->nullable();
            $table->foreign('animal_ID')->references('id')->on('animals');
            
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
        Schema::dropIfExists('adopters');
    }
}
