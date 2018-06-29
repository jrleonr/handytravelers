<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homes', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['male','female', 'couple', 'group', 'family'])->index()->nullable();
            $table->text('summary')->nullable();
            $table->text('rules')->nullable();
            $table->text('interaction')->nullable();
            $table->text('accommodation')->nullable();
            $table->text('getting_around')->nullable();
            $table->text('other')->nullable();
            $table->integer('place_id')->unsigned()->index()->nullable();
            $table->foreign('place_id')->references('id')->on('places');
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
        Schema::dropIfExists('homes');
    }
}
