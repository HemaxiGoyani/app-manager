<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMusicLyricsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('music_lyrics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('music_fk')->unsigned();
            $table->bigInteger('language_fk')->unsigned();
            $table->text('lyrics');
            $table->string('uuid');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('music_fk')->references('id')->on('music_records');
            $table->foreign('language_fk')->references('id')->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('music_lyrics');
    }
}
