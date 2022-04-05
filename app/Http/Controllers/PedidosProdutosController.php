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
    private $produto, $usuario, $pedido;
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
        if(!$pedido = $this->pedido->find($id)) return redirect()->back()->with('message', 'Pedido não encontrado');
        
        if($status === 'Pago') $pedido->status = 'Pago';

        if($status === 'Cancelado') $pedido->status = 'Cancelado';
        $pedido->save();
    
        return redirect()->route('index_pedido');
    }

    public function delete($id)
    {
        if(!$pedido = $this->pedido->find($id)) return redirect()->back()->with('message', 'Pedido não encontrado');

        $pedido->delete();

        return redirect()->route('index_pedido');
    }

    public function show($idPedido)
    {
        if(!$pedido = $this->pedido->find($idPedido)) return redirect()->back()->with('message', 'Pedido não encontrado');
        if(!$usuario = $this->usuario->find($pedido->clients_id)) return redirect()->back()->with('message', 'Usuario não encontrado');
        if(!$produto = $this->produto->find($pedido->produtos_id)) return redirect()->back()->with('message', 'Produto não encontrado');

        return view('pages.admin.pedidos.show', compact('pedido', 'usuario', 'produto'));
    }

    public function produtosPedidos($id)
    {
        if(!$usuario = $this->usuario->find($id)) return redirect()->back()->with('message', 'Usuario não encontrado');

        $pedidos = $this->pedido->where('users_id', $id)->paginate(20);
        return view('pages.admin.usuario.pedidos', compact('pedidos'));
    }

    public function search(Request $request)
    {
        $filtro = $request->filtro;
        $pedidos = $this->pedido->where('numero', 'LIKE', "%{$filtro}%")->paginate(20);

        if ($request->posicao == 'pago') return view('pages.admin.pedidos.pedidosPagos', compact('pedidos', 'filtro'));

        if ($request->posicao == 'cancelado') return view('pages.admin.pedidos.pedidosCancelados', compact('pedidos', 'filtro'));

        return view('pages.admin.pedidos.index', compact('pedidos', 'filtro'));
    }
    public function order(Request $request)
    {
        //redireciona para a rota de pedidos pagos
        if ($request->posicao == 'pago'){
            if ($request->select == 'data'){
                $pedidos = $this->pedido->where('status', 'Pago')->orderBy('data', 'ASC')->paginate(20);
                return view('pages.admin.pedidos.pedidosPagos', compact('pedidos'));

            }

            if($request->select == 'numero'){
                $pedidos = $this->pedido->where('status', 'Pago')->orderBy('numero', 'ASC')->paginate(20);
                return view('pages.admin.pedidos.pedidosPagos', compact('pedidos'));

            }
            $pedidos = $this->pedido->where('status', 'Pago')->paginate(20);
            return view('pages.admin.pedidos.pedidosPagos', compact('pedidos'));
        } 

        //redireciona para a rota de pedidos cancelados
        if ($request->posicao == 'cancelado'){
            if ($request->select == 'data'){
                $pedidos = $this->pedido->where('status', 'Cancelado')->orderBy('data', 'ASC')->paginate(20);
                return view('pages.admin.pedidos.pedidosCancelados', compact('pedidos'));
            }

            if($request->select == 'numero'){
                $pedidos = $this->pedido->where('status', 'Cancelado')->orderBy('numero', 'ASC')->paginate(20);
                return view('pages.admin.pedidos.pedidosCancelados', compact('pedidos'));
            }

            $pedidos = $this->pedido->where('status', 'Cancelado')->paginate(20);
            return view('pages.admin.pedidos.pedidosCancelados', compact('pedidos'));
        } 

        //redireciona para a rota de pedidos
        if ($request->select == 'data'){
            $pedidos = $this->pedido->where('status', 'Em aberto')->orderBy('data', 'ASC')->paginate(20);
            return view('pages.admin.pedidos.index', compact('pedidos'));

        }

        if($request->select == 'numero'){
            $pedidos = $this->pedido->where('status', 'Em aberto')->orderBy('numero', 'ASC')->paginate(20);
            return view('pages.admin.pedidos.index', compact('pedidos'));
        }

        $pedidos = $this->pedido->where('status', 'Em aberto')->paginate(20);
        return view('pages.admin.pedidos.index', compact('pedidos'));
    }
    
}
