<?php

$factory->define(Handytravelers\Components\Homes\Models\Message::class, function (Faker\Generator $faker) {

    return [
        'body' => $faker->text,
        'invitation_id' => function(){
            return factory(Handytravelers\Components\Homes\Models\Invitation::class)->create()->id;
        },
        'user_id'=> function(){
            return factory(Handytravelers\Components\Users\Models\User::class)->create()->id;
        },
    ];
});
