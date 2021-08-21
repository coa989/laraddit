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
            'user_id' => $this->faker->numberBetween(1, 100),
            'image_path' => 'https://thumbs.dreamstime.com/b/european-shorthair-tricolor-cat-close-up-european-shorthair-tricolor-cat-128908945.jpg',
            'title' => $this->faker->sentence($nbWords = 3),
            'slug' => $this->faker->slug,
            'approved' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'thumbnail' => 'https://lh3.googleusercontent.com/proxy/VT-LKGbs9OpdIqyq978nIjQ2vQW54lyBfhlkytVLFfN4VweqSh6PSSsnu0h2YuxorZ-N-Bk_zq1pXPL8o8a_fkj280lagH74xXdBY50FAH_iIf4DWUWJ2xqup8caJGR3Fg',
            'medium_image_path' => 'https://i.pinimg.com/564x/b7/82/bb/b782bba13025a4780505ee90d5b95767.jpg',
        ];
    }
}
