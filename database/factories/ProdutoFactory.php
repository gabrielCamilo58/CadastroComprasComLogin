<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            
            'price' => $this->faker->randomFloat(5, 0, 9999),
            'codBarras' => $this->faker->numberBetween(5,99999),
        ];
    }
}
