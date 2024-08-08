<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

namespace Database\Factories;

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\App\Models\Article::class, function (Faker $faker) {
    $title = $faker->text(70);
    $description = $faker->text(200);
    $lang = $faker->randomElement(['pl', 'en']);

    $seo = \App\Models\Seo::create([
        'url' => '/'.Str::slug($title),
        'title' => $title,
        'description' => $description,
        'tags' => $faker->text(20),
        'lang' => $lang,
    ]);

    return [
        'seo_id' => $seo->id,
        'title' => $title,
        'lead' => $description,
        'lang' => $lang,
        'active' => $faker->boolean,
    ];
});
