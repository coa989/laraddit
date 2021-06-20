<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'user_id' => 5,
            'image_url' => 'https://img-9gag-fun.9cache.com/photo/aEpOoqK_700bwp.webp',
            'slug' => $this->faker->slug(),
            'approved' => true
        ];
    }
}
