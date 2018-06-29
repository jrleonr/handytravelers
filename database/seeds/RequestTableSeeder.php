<?php

use Illuminate\Database\Seeder;

class RequestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Handytravelers\Components\Homes\Models\Request::class, 2)->create();
    }
}
