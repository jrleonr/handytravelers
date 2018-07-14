<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('username');
            $table->string('facebook_id')->nullable()->unique();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->text('about')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender');
            
            $table->string('locale')->nullable();
            $table->string('timezone')->nullable();
            $table->boolean('admin')->default(0);


            $table->integer('home_id')->unsigned()->nullable()->index();
            $table->integer('place_id')->unsigned()->index()->nullable();

            $table->string('stripe_id')->nullable();
            $table->string('card_brand')->nullable();
            $table->string('card_last_four')->nullable();
            $table->timestamp('trial_ends_at')->nullable();
            

            $table->foreign('home_id')->references('id')->on('homes');
            $table->foreign('place_id')->references('id')->on('places');
            $table->rememberToken();
            $table->boolean('verified')->default(true);
            $table->string('token')->nullable()->default(null);
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
        Schema::dropIfExists('users');
    }
}
