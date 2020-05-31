<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'block_id' => rand(1, 100),
        'pic' => $faker->imageUrl(200, 200),
        'title' => $faker->word,
        'content' => $faker->text,
        'author_pic' => $faker->imageUrl(200, 200),
        'author_name' => $faker->name,
    ];
});
