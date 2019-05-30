<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wards', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('municipality_id');
            $table->foreign('municipality_id')->references('id')->on('municipalities')->onDelete('cascade');
            $table->string('name');
            $table->string('total_population')->nullable();
            $table->string('male')->nullable();
            $table->string('female')->nullable();
            $table->string('voter_male')->nullable();
            $table->string('voter_female')->nullable();
            $table->string('total_voter')->nullable();
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
        Schema::dropIfExists('wards');
    }
}
