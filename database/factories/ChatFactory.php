<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\{Chat, User};
use Illuminate\Support\Str;

$factory->define(App\Models\Chat::class, function (Faker $faker) {
    return [
        'subject' => $faker->sentence,
        'user_id' => User::all()->random()->id,
    ];
});
