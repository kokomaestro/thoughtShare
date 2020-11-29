<?php

namespace Database\Factories;

use App\Models\Thought;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThoughtFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Thought::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "user_id" => $this->factoryForModel(App\User::class),
            "body" => $this->faker->sentence
        ];
    }
}
