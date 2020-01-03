<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\StartingDay;
use Faker\Generator as Faker;

$factory->define(StartingDay::class, function (Faker $faker) {
  $unixTimestap = '1609372800'; // = 2019-12-31 00:00:00+00:00 in ISO 8601
    return [
      'date' => date_create()->format('Y-m-d'),
      'shift' => ['prva', 'druga'][rand(0,1)]
    ];
});
