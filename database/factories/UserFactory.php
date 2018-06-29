<?php

$factory->define(Handytravelers\Components\Users\Models\User::class, function (Faker\Generator $faker) {

    return [
        'username' => $faker->uuid,
        'first_name' => $faker->name,
        'last_name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'about' => $faker->text,
        'date_of_birth' =>  Carbon\Carbon::now(),
        'gender' => $faker->randomElement(['male', 'female']),
        'remember_token' => str_random(10),
        'verified' => 1,
        'place_id' => function(){
            return factory(Handytravelers\Components\Places\Models\Place::class)->create()->id;
        },
        'home_id' => function(){
            return factory(Handytravelers\Components\Homes\Models\Home::class)->create()->id;
        },
    ];
});
