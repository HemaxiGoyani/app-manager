<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWallpaperMusicianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallpaper_musician', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('wallpaper_id')->unsigned();
            $table->foreign('wallpaper_id')->references('id')->on('wallpapers');
            $table->bigInteger('musician_id')->unsigned();
            $table->foreign('musician_id')->references('id')->on('musicians');
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
        Schema::dropIfExists('wallpaper_musician');
    }
}
