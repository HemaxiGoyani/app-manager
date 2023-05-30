<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMusicianVideosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('musician_videos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('musician_fk')->unsigned();
            $table->tinyInteger('order')->default(0);
            $table->string('uuid');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('musician_fk')->references('id')->on('musicians');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('musician_videos');
    }
}
