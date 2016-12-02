<?php

use Illuminate\Database\Seeder;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Using factory
        // Creates 60 restaurants in the database
        // Overwrite latitude and longitude for a random location in Montreal (approx.)
        factory(App\Restaurant::class, 60)->create([
            'latitude' => mt_rand(45000000, 46000000)/1000000,
            'longitude' => mt_rand(-74000000,-73000000)/1000000,
        ]);
    }
}
