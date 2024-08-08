<?php

namespace Database\Factories;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PageFactory extends Factory {

    protected $model = Page::class;

    public function definition()
    {
        $name = $this->faker->name;
        $description = $this->faker->text(200);
        $lang = $this->faker->randomElement(['pl', 'en']);

        return [
            'url' => '/'.Str::slug($name),
            'title' => $name,
            'description' => $description,
            'tags' => $this->faker->text(20),
            'lang' => $lang,
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Page $page) {

        });
    }
}
