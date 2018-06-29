<?php

use Illuminate\Database\Seeder;

class HomesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Handytravelers\Components\Offers\Models\Home::class, 2)->create()->each(function ($home) {
            $home->place()->associate(factory(Handytravelers\Components\Places\Models\Place::class)->make());
        });
    }
}
