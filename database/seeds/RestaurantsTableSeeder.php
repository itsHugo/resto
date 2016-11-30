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
        $i=0;
        while($i < 20){
            DB::table('restaurants')->insert([
                'user_id' => 1,
                'name' => str_random(10),
                'address' => str_random(20),
                'min_price' => random_int(5,10),
                'max_price' => random_int(20, 50),
                'latitude' => mt_rand(45000000, 46000000)/1000000,
                'longitude' => mt_rand(-74000000,-73000000)/1000000,
            ]);
            $i++;
        }
    }
}
