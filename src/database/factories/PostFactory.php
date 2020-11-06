<?php

namespace biscuit\package\database\factories;

use biscuit\package\model\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'identifier' => \Illuminate\Support\Str::random(10),
            'slug' => \Illuminate\Support\Str::slug($this->faker->sentence),
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
            'extra' => json_encode(['test' => 'value']),
        ];
    }
}