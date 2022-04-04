<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ['name', 'img', 'price', 'description', 'codBarras'];
    use HasFactory;

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'produtos_pedidos');
    }
}
