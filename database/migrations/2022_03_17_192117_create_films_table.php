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
       // Schema::disableForeignKeyConstraints();
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->year('year');
            $table->text('description');

      // $table->unsignedBigInteger('category_id')->nullable();
        //$table->foreign('category_id')->references('id') ->on('categories') ->onDelete('restrict')->onUpdate('restrict');
        
      //$table->unsignedBigInteger('actor_id')->nullable();
       // $table->foreign('actor_id')->references('id') ->on('actors') ->onDelete('restrict')->onUpdate('restrict');
        
        $table->timestamps();

        $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('films');
    }
};
