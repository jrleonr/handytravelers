<?php

$factory->define(Handytravelers\Components\Offers\Models\Home::class, function (Faker\Generator $faker) {

    return [
        'summary' => $faker->text,
        'rules' => $faker->text,        
        'interaction' => $faker->text,
        'accommodation' => $faker->text,
        'getting_around' => $faker->text,
        'other' => $faker->text,
        'type' => $faker->randomElement(['male','female', 'couple', 'group', 'family']),
        'place_id' => function(){
            return factory(Handytravelers\Components\Places\Models\Place::class)->create()->id;
        }
    ];
});
