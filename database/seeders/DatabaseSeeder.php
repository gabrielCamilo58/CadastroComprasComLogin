<?php

namespace Database\Seeders;

use App\Models\Client; 
use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Pedido::factory(50)->create();
        Produto::factory(50)->create();

        $produtos = Produto::all();
        Pedido::all()->each(function ($pedido) use($produtos){
            $pedido->produtos()->attach($produtos, ['qtd' => 1]);
        });
        // \App\Models\User::factory(10)->create();
    }
}
