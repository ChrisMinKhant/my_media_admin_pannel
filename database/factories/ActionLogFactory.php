<?php

namespace Database\Factories;

use App\Models\ActionLog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ActionLog>
 */
class ActionLogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ActionLog::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 21),
            'post_id' => $this->faker->numberBetween(1, 20),
            'like' => $this->faker->boolean(),
            'comment' => $this->faker->sentence(10),
        ];
    }
}
