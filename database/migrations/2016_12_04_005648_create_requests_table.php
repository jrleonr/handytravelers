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
            $table->enum('status',['accepted','declined','pending','cancelled'])->index();
            //type couch or volunteer
            $table->date('check_in')->index();
            $table->date('check_out')->index();
            $table->tinyInteger('people')->unsigned();
            $table->text('body');
            $table->boolean('active')->default(0);
            $table->integer('place_id')->unsigned()->index();

            $table->integer('user_id')->unsigned()->index();
            $table->integer('sent_by')->unsigned();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('sent_by')->references('id')->on('users');

            $table->foreign('place_id')->references('id')->on('places');
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
