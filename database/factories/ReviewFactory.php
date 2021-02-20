<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'review' => $this->faker->text(3000),
            'user_id' => $this->faker->numberBetween(3,8),
            'book_id' => $this->faker->numberBetween(3,8),

        ];
    }
}
