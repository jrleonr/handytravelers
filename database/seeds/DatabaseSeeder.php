<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PlacesTableSeeder::class);
        $this->call(HomesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(ImagesTableSeeder::class);
        $this->call(RequestTableSeeder::class);
        $this->call(InvitationsTableSeeder::class);

    }
}
