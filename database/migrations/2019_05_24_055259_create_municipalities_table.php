<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMunicipalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipalities', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('district_id');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->string('name');
            $table->text('area')->nullable();
            $table->string('population')->nullable();
            $table->string('total_ward')->nullable();
            $table->string('image')->nullable();
            $table->enum('type',['Metropolitan','Sub-metropolitan','Municipality','VDC']);
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
        Schema::dropIfExists('municipalities');
    }
}
