<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        'name' => $this->faker->text(50),
        'family' => $this->faker->text(50),
        'age' => $this->faker->numberBetween(3,68),
        'education' => $this->faker->text(50),
        'job' => $this->faker->text(50),
        'biography' => $this->faker->text(2000),
        'Favorits-reading' => $this->faker->text(50),
        'user_id' => $this->faker->numberBetween(1,8)
        ];
    }
}
