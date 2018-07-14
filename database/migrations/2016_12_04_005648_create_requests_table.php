<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid')->index();
            $table->string('status', 20)->index();
            $table->string('waiting_action', 10)->nullable();
            $table->date('check_in')->index();
            $table->date('check_out')->index();
            $table->tinyInteger('people')->unsigned();
            $table->text('body');
            $table->integer('place_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->integer('home_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('place_id')->references('id')->on('places');
            $table->foreign('home_id')->references('id')->on('homes');
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
        Schema::dropIfExists('requests');
    }
}
