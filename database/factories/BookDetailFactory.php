<?php

namespace Database\Factories;

use App\Models\BookDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BookDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'writters'  => $this->faker->text(300),
            'Publisher_id' => $this->faker->numberBetween(1,3),
            'publication_date' => $this->faker->date('y-m-d','now'),
            'publication_place' => $this->faker->text(100),
            'edition' => $this->faker->numberBetween(1,6),
            'edit_version' => $this->faker->numberBetween(1,3),
            'number_of_pages' => $this->faker->numberBetween(100,600),
            'Translation' => $this->faker->text(300),
            'Translator' => $this->faker->text(300),
            'resources' => $this->faker->text(300),
            'book_id' => $this->faker->numberBetween(1,6),
        ];
    }
}
