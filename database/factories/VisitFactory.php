<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Visit;
use Faker\Generator as Faker;

$factory->define(Visit::class, function (Faker $faker) {
    return [
      'link_id' => function () {
        return factory('App\Link')->create()->id;
      },
      'user_agent' => $faker->userAgent
    ];
});
