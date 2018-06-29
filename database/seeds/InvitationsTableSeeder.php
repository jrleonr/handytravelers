<?php

use Illuminate\Database\Seeder;

class InvitationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Handytravelers\Components\Homes\Models\Invitation::class, 2)->create();
        factory(Handytravelers\Components\Homes\Models\Message::class, 2)->create();
        factory(Handytravelers\Components\Homes\Models\Participant::class, 2)->create();

    }
}
