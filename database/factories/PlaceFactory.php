<?php

$factory->define(Handytravelers\Components\Places\Models\Place::class, function (Faker\Generator $faker) {

    $places = Handytravelers\Components\Places\Models\Place::select('id')->where('type', 'country')->get()->pluck('id')->toArray();

    return [
        'place_id' => $faker->uuid,
        'name' => $faker->city,  
        'slug' => $faker->slug,  
        'description' => $faker->text,  
        'parent_id' => $faker->randomElement($places),
        'lat' => $faker->latitude,  
        'lng' => $faker->longitude,  
        'type' => $faker->randomElement(['city']),
        'depth' => 2 
    ];
});
