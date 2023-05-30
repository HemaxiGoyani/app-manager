<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMusicAlbumBandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('music_album_band', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('album_id')->unsigned();
            $table->foreign('album_id')->references('id')->on('music_albums');
            $table->bigInteger('band_id')->unsigned();
            $table->foreign('band_id')->references('id')->on('music_bands');
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
        Schema::dropIfExists('music_album_band');
    }
}
