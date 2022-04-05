<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateProduto;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\HttpCache\Store;

class ProdutosController extends Controller
{
    private $produto;
    public function __construct(Produto $produto)
    {
        $this->produto = $produto;
    }
    public function index(Request $request)
    {
        $produtos = $this->produto->orderBy('name', 'ASC')->paginate(20);

        if($request->select == 'preco'){
            $produtos = $this->produto->orderBy('price', 'ASC')->paginate(20);
        }

        return view('pages.admin.produtos.index', compact('produtos'));
    }
    public function create()
    {
        return view('pages.admin.produtos.create');
    }
    public function store(StoreUpdateProduto $request)
    {
        $data = $request->all();
        if($request->hasFile('img') && $request->img->isValid()){
            $data['img'] = $request->img->store("produto/{$data['name']}/{$data['codBarras']}");
        }
        $this->produto->create($data);

        return redirect()->route('index_produto');
    }
    public function edit($id)
    {
        if(!$produto = $this->produto->find($id)) return redirect()->back()->with('message', 'Produto não encontrado'); 
        
        return view('pages.admin.produtos.edit', compact('produto'));
    }

    public function update(StoreUpdateProduto $request ,$id)
    {
        if(!$produto = $this->produto->find($id)) return redirect()->back()->with('message', 'Produto não encontrado'); 

        $data = $request->all();
        if($request->hasFile('img') && $request->img->isValid()){
            if($produto->img) Storage::delete($produto->img);
            
            $data['img'] = $request->img->store("produto/{$data['name']}/{$data['codBarras']}");
        }

        $produto->update($data);

        return redirect()->route('index_produto');
    }
    public function delete($id)
    {
        if(!$produto = $this->produto->find($id)) return redirect()->back()->with('message', 'Produto não encontrado');

        if(Storage::exists($produto->img)){
            Storage::delete($produto->img);
        }

        $produto->delete();

        return redirect()->route('index_produto');
    }
    public function search(Request $request)
    {
        $filtro = $request->filtro;
        $produtos = $this->produto->where('name', 'LIKE', "%{$filtro}%")->paginate(20);
        
        return view('pages.admin.produtos.index', compact('produtos', 'filtro'));

    }
   
}
