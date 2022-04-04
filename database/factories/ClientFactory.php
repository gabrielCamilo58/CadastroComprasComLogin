<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $min = 11111111111111;
        $max = 99999999999999;
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'cpf' => $this->faker->unique()->numberBetween($min, $max),
        ];
    }
}
