<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

namespace Database\Factories;

use App\Models\FieldType;
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

$factory->define(\App\Models\Field::class, function (Faker $faker) {
    $pageIds = \App\Models\Page::with([])->pluck('id')->toArray();

    return [
        'page_id' => $faker->randomElement($pageIds),
        'type' => $faker->randomElement(FieldType::getValues()),
        'name' => $faker->randomElement(['text1', 'text2', 'text3', 'head1', 'head2']),
        'value' => $faker->text(250),
        'active' => $faker->boolean
    ];
});
