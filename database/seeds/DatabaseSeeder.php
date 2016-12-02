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
        // Using factory
        // Creates 10 users
        factory(App\User::class, 10)->create();

        // $this->call(UsersTableSeeder::class);

        $this->call(RestaurantsTableSeeder::class);
    }
}
