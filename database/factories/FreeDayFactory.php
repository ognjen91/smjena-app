<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FreeDay;
use Faker\Generator as Faker;

$factory->define(FreeDay::class, function (Faker $faker) {
  $unixTimestap = '1609372800'; // = 2019-12-31 00:00:00+00:00 in ISO 8601

    return [
        'date' => $faker->dateTimeBetween('now', '+2 years')->format('Y-m-d')
    ];
});
