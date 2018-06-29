<?php

$factory->define(Handytravelers\Components\Homes\Models\Request::class, function (Faker\Generator $faker) {
    return [
        'uuid' => $faker->uuid,
        'check_in' => $faker->dateTimeInInterval('now','+ 2 days'),
        'check_out' => $faker->dateTimeInInterval('+ 2 days', '+ 5 days'),
        'people' => $faker->randomDigitNotNull(),
        'active' => 0,
        'body' => $faker->text,
        'place_id' => function(){
            return factory(Handytravelers\Components\Places\Models\Place::class)->create()->id;
        },
        'user_id'=> function(){
            return factory(Handytravelers\Components\Users\Models\User::class)->create()->id;
        },
    ];
});
