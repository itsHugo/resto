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
        DB::table('restaurants')->insert([
            'name' => str_random(10),
            'address' => str_random(20),
            'min_price' => random_int(5,10),
            'max_price' => random_int(20, 50),
            'latitude' => random_int(30,40),
            'longitude' => random_int(30),
            'password' => bcrypt('secret'),
        ]);
    }
}
