<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRescuersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rescuers', function (Blueprint $table) {
            $table->id();
            $table->string('rescuer_Fname');
            $table->string('rescuer_Lname');
            $table->integer('rescuer_Age');
            $table->string('rescuer_Address');
            $table->biginteger('rescuer_Contact');
            $table->string('rescuer_Email');
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
        Schema::dropIfExists('rescuers');
    }
}
