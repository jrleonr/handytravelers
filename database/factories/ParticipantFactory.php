<?php

$factory->define(Handytravelers\Components\Homes\Models\Participant::class, function (Faker\Generator $faker) {
    return [
        'invitation_id' => function(){
            return factory(Handytravelers\Components\Homes\Models\Invitation::class)->create()->id;
        },
        'user_id'=> function(){
            return factory(Handytravelers\Components\Users\Models\User::class)->create()->id;
        },
        'last_read' => $faker->dateTimeBetween('-5 days', 'now')
    ];
});
