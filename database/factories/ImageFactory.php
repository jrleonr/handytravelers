<?php

$factory->define(Handytravelers\Components\Images\Models\Image::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,  
        'url' => $faker->image('storage/app/public/',150,150),  
        'main' => 0,
        'user_id' => function(){
            return factory(Handytravelers\Components\Users\Models\User::class)->create()->id;
        },
    ];
});
