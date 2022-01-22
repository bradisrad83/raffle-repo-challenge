<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RaffleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'              => $this->faker->numerify('Raffle ###'),
            'number_of_winners' => $this->faker->randomDigitNotNull(),
        ];
    }
}
