<?php

namespace Database\Factories;

use App\Models\LikeComment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LikeComment>
 */
class LikeCommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LikeComment::class;

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
