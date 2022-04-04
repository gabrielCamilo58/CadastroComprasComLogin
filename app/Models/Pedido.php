<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pedido extends Model
{
    protected $fillable = ['users_id', 'total', 'data', 'status', 'numero'];
    use HasFactory;

    public function usuario()
    {
        return $this->BelongsTo(User::class);
    }

    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'produtos_pedidos');
    }

    public function criarNumeroPedido($num = 1): int
    {
        $data = date('Y-m-d');
        $pedidoData = $this->where('data', 'LIKE', "%{$data}%")->get();
        $pedidoNum = $this->where('numero', $num)->get();

        if((count($pedidoData) != false) && (count($pedidoNum) != false)){
            return $this->criarNumeroPedido($num += 1);
        }

        return $num;
    }
}
