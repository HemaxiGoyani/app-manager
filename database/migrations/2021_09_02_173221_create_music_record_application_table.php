<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMusicRecordApplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('music_record_application', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('record_id')->unsigned();
            $table->foreign('record_id')->references('id')->on('music_records');
            $table->bigInteger('application_id')->unsigned();
            $table->foreign('application_id')->references('id')->on('applications');
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
        Schema::dropIfExists('music_record_application');
    }
}
