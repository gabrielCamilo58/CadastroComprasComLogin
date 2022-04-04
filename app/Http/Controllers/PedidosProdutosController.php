<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePedidos;
use App\Http\services\ServicePedido;
use App\Models\Client;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\returnSelf;

class PedidosProdutosController extends Controller
{
    private $produto, $usuario, $pedido, $emissao, $service;
    public function __construct(Pedido $pedido, Produto $produto, User $usuario)
    {
        $this->produto = $produto;
        $this->usuario = $usuario;
        $this->pedido = $pedido;
    }
    public function index()
    {
        $pedidos = $this->pedido->where('status', 'Em aberto')->paginate(20);
        return view('pages.admin.pedidos.index', compact('pedidos'));
    }
    public function listarPedidosPagos()
    {
        $pedidos = $this->pedido->where('status', 'Pago')->paginate(20);
        return view('pages.admin.pedidos.pedidosPagos', compact('pedidos'));
    }
    public function listarPedidosCancelados()
    {
        $pedidos = $this->pedido->where('status', 'Cancelado')->paginate(20);
        return view('pages.admin.pedidos.pedidosCancelados', compact('pedidos'));
    }

    public function create()
    {
        $produtos = $this->produto->paginate(20);
        return view('pages.home.index', compact('produtos'));
    }

    public function  update($id, $status)
    {
        if(!$pedido = $this->pedido->find($id)) return redirect()->back();
        
        if($status === 'Pago') $pedido->status = 'Pago';

        if($status === 'Cancelado') $pedido->status = 'Cancelado';
        $pedido->save();
    
        return redirect()->route('index_pedido');
    }

    public function delete($id)
    {
        if(!$pedido = $this->pedido->find($id)) return redirect()->back();

        $pedido->delete();

        return redirect()->route('index_pedido');
    }

    public function show($idPedido)
    {
        if(!$pedido = $this->pedido->find($idPedido)) return redirect()->back();
        if(!$usuario = $this->usuario->find($pedido->clients_id)) return redirect()->back();
        if(!$produto = $this->produto->find($pedido->produtos_id)) return redirect()->back();

        return view('pages.admin.pedidos.show', compact('pedido', 'usuario', 'produto'));
    }

    public function produtosPedidos($id)
    {
        if(!$usuario = $this->usuario->find($id)) return redirect()->back();

        $pedidos = $this->pedido->where('clients_id', $id)->paginate(20);
        return view('pages.admin.usuario.pedidos', compact('pedidos'));
    }

    public function search(Request $request)
    {
        $filtro = $request->filtro;
        $pedidos = $this->pedido->where('numero', 'LIKE', "%{$filtro}%")->paginate(20);
        
        return view('pages.admin.pedidos.index', compact('pedidos', 'filtro'));

    }
    
}
