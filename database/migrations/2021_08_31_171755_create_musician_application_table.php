<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMusicianApplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('musician_application', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('musician_id')->unsigned();
            $table->foreign('musician_id')->references('id')->on('musicians');
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
        Schema::dropIfExists('musician_application');
    }
}
