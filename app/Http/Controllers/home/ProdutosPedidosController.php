<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Http\services\ServicePedido;
use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Session\Middleware\StartSession;
use Symfony\Component\VarDumper\VarDumper;

class ProdutosPedidosController extends Controller
{
    protected $produto, $pedido;
    public function __construct(Produto $produto, Pedido $pedido)
    {
        $this->produto = $produto;
        $this->pedido = $pedido;
    }
    public function adicionarAoCarrinho(Request $request)
    {
        session_start();
        $produtos = $this->produto->paginate(20);
        if (isset($_SESSION['produtos'])) {
            $produtosCliente = $_SESSION['produtos'];
        } else {
            $produtosCliente = $request->produtosCliente;
        }

        //segunda vez que adiciono o produto entra nesse
        if (isset($produtosCliente)) {
            foreach ($produtosCliente as $index => $produtoCliente) {
                foreach ($produtoCliente as $idProduto) {
                    if ($idProduto === $request->id) {
                        $produtosCliente[$index]['qtd'] += 1;
                        $_SESSION['produtos'] = $produtosCliente;
                        return view('pages.Home.index', compact('produtos', 'produtosCliente'));
                    }
                    break;
                }
            }
        }

        //primeira vez que adiciono o produto entra nesse
        $produtosCliente[]['idProduto'] = $request->id;
        foreach ($produtosCliente as $index => $produtoCliente) {
            if (in_array($request->id, $produtoCliente)) {
                $produtosCliente[$index]['qtd'] = 1;
            }
        }
        $_SESSION['produtos'] = $produtosCliente;

        return view('pages.Home.index', compact('produtos', 'produtosCliente'));
    }
    public function verCarrinho(Request $request)
    {
        $produtos = [];
        $total = null;

        foreach ($request->produtosCliente as $index => $produtosCliente) {
            $produto = $this->produto->find($produtosCliente['idProduto']);
            $produtos[$index] = $produto;
            $produtos[$index]['qtd'] =  $produtosCliente['qtd'];
            $total += ($produto->price * $produtosCliente['qtd']);
        }

        return view('pages.home.carrinho', compact('produtos', 'total'));
    }

    public function salvarPedido(Request $request)
    {
        session_start();
        unset($_SESSION['produtos']);
        
        $data = $this->criarPedido($request->total);
        $pedido = $this->pedido->create($data);

        foreach ($request->produtos as $array) {
            $produto = $this->produto->find($array['id']);
            $pedido->produtos()->attach($produto, ['qtd' => $array['qtd']]);
        }
        $pedidoProdutos = $pedido->produtos()->get();
        $total = $request->total;
        return view('pages.Home.show', compact('pedidoProdutos', 'total', 'pedido'));
    }

    public function criarPedido($total): array
    {
        $data['numero'] = $this->pedido->criarNumeroPedido();
        $data['data'] =  date('Y-m-d');
        $data['total'] = $total;
        $data['status'] = 'Em aberto';
        $data['users_id'] = auth()->user()->id;

        return $data;
    }
    public function removerDoCarrinho(Request $request)
    {
        session_start();
        foreach ($_SESSION['produtos'] as $index => $produtos) {
            if ($produtos['idProduto'] === $request->id) {
                //unset($$_SESSION['produtos'][$index]);
                array_splice($_SESSION['produtos'], $index, 2);
            }
        }
        return redirect()->route('home');
    }
}
