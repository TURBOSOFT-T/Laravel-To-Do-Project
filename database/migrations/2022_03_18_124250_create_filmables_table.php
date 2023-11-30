<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filmables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('film_id');
        
            $table->foreign('film_id')->references('id')->on('films');
            $table->morphs('filmable');
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
        Schema::dropIfExists('filmables');
    }
};
