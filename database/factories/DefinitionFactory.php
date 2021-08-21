<?php

namespace Database\Factories;

use App\Models\Definition;
use Illuminate\Database\Eloquent\Factories\Factory;

class DefinitionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Definition::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 100),
            'title' => $this->faker->sentence($nbWords = 3),
            'body' => $this->faker->sentence($nbWords = 15),
            'slug' => $this->faker->slug,
            'approved' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
