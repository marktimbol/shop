<?php

use Carbon\Carbon;

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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'city'  => $faker->city,
        'state' => $faker->state,
        'country'   => $faker->country,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Item::class, function (Faker\Generator $faker) {
    return [
        'brand_id'  => factory(App\Brand::class)->create()->id,
        'name' => $faker->sentence,
        'slug'	=> $faker->slug,
        'price'	=> $faker->randomNumber(2)
    ];
});

$factory->define(App\Brand::class, function (Faker\Generator $faker) {
    return [
        'name'  => $faker->word,
        'slug'  => $faker->slug,
    ];
});

$factory->define(App\Order::class, function (Faker\Generator $faker) {
    return [
        'paid'  => false,
        'date'  => Carbon::now()
    ];
});
