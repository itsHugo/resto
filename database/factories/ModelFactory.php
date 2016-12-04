<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'postal_code' => $faker->postcode,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Restaurant::class, function (Faker\Generator $faker) {
   return [
       'user_id' => $faker->numberBetween(1,10),
       'name' => $faker->company,
       'street_address' => $faker->streetAddress,
       'city' => $faker->city,
       'province' => $faker->countryCode,
       'postal_code' => $faker->postcode,
       'genre' => $faker->word,
       'min_price' => $faker->numberBetween(2,10),
       'max_price' => $faker->numberBetween(20,50),
       'latitude' => mt_rand(45000000, 46000000)/1000000,
       'longitude' => mt_rand(-74000000,-73000000)/1000000,
   ];
});
