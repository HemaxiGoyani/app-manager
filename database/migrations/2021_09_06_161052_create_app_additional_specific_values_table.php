<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppAdditionalSpecificValuesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_additional_specific_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('app_fk')->unsigned();
            $table->bigInteger('attribute_fk')->unsigned();
            $table->text('value');
            $table->string('uuid');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('app_fk')->references('id')->on('applications');
            $table->foreign('attribute_fk')->references('id')->on('additional_specific_attributes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('app_additional_specific_values');
    }
}
