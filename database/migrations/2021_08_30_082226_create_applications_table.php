<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('version_count')->nullable();
            $table->string('version')->nullable();
            $table->bigInteger('account_fk')->unsigned();
            $table->string('package')->nullable();
            $table->string('notification_app_id')->nullable();
            $table->text('notification_server_key')->nullable();
            $table->string('update_title')->nullable();
            $table->text('update_message')->nullable();
            $table->boolean('status')->default(true);
            $table->string('uuid');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('account_fk')->references('id')->on('accounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('applications');
    }
}
