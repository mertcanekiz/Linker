<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Link;
use Faker\Generator as Faker;

$factory->define(Link::class, function (Faker $faker) {
  return [
    'user_id' => function () {
      return factory('App\User')->create()->id;
    },
    'title' => $faker->sentence(3),
    'url' => $faker->url,
  ];
});
