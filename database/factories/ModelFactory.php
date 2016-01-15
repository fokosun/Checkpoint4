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

$factory->define(Techademia\User::class, function (Faker\Generator $faker) {
    return [
        'fullname' => $faker->name,
        'username' => $faker->UserName,
        'occupation' => $faker->company,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Techademia\Video::class, function (Faker\Generator $faker) {
    return [
        'id' => 1,
        'title' => $faker->name,
        'description' => $faker->word,
        'url' => $faker->url,
        'user_id' => 1,
        'category_id' => 1,
    ];
});

$factory->define(Techademia\Category::class, function (Faker\Generator $faker) {
    return [
        'id' => 1,
        'title' => $faker->word
    ];
});
