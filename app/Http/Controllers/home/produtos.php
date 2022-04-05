<?php
namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use Illuminate\Http\Request;

class produtos extends Controller
{
    protected $produto;
    public function __construct(Produto $produto)
    {
        $this->produto = $produto;
    }

    public function index()
    {
        session_start();
        $produtos = $this->produto->paginate(20);
        return view('pages.home.index', compact('produtos'));
    }

    public function search(Request $request)
    {
        $filtro = $request->filtro;
        $produtos = $this->produto->where('name', 'LIKE', "%{$filtro}%")->paginate(20);
        
        return view('pages.home.index', compact('produtos', 'filtro'));

    }
}