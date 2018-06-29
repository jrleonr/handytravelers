<?php

$factory->define(Handytravelers\Components\Homes\Models\Invitation::class, function (Faker\Generator $faker) {

    return [
        'uuid' => $faker->uuid,
        'status' => $faker->randomElement(['accepted', 'declined', 'pending']),
        'request_id' => function() {
            return factory(Handytravelers\Components\Homes\Models\Request::class)->create()->id;
        },
        'sent_by' => function(){
            return factory(Handytravelers\Components\Users\Models\User::class)->create()->id;
        }
    ];
});
