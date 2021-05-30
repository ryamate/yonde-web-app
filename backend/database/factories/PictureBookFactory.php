<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PictureBook;
use App\User;
use Faker\Generator as Faker;

$factory->define(PictureBook::class, function (Faker $faker) {
    return [
        'google_books_id' => $faker->text(50),
        'isbn_13' => $faker->text(13),
        'title' => $faker->text(50),
        'authors' => $faker->text(50),
        'published_date' => $faker->text(50),
        'thumbnail_url' => $faker->url,
        'five_star_rating' => $faker->randomDigit() . "\n",
        'read_status' => $faker->randomDigit() . "\n",
        'review' => $faker->text(500),
        'user_id' => function () {
            return factory(User::class);
        }
    ];
});
