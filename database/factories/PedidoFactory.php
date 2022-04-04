<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

class PedidoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
    
        return [
              'clients_id' => Client::factory()->create(),
              'produtos_id' => Produto::factory()->create(),
              'total' => $this->faker->randomFloat(10, 5, 9999),
              'numero' => $this->faker->numberBetween(1,999),
              'qtd' => $this->faker->numberBetween(1,999),
              'data' => $this->faker->date(),

        ];
    }
}
