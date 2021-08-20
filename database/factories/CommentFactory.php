<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 100),
            'commentable_id' => $this->faker->numberBetween(1, 500),
            'body' => $this->faker->sentence,
            'commentable_type' => $this->faker->randomElement(['App\Models\Post', 'App\Models\Definition']),
            'approved' => $this->faker->boolean,
            'created_at' => now(),
            'updated_at' => now(),
            'parent_id' => $this->faker->optional(0.2, null)->numberBetween(1, 5000)
        ];
    }
}
