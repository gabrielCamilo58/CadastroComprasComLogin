<?php
namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Produto;

class produtos extends Controller
{
    protected $produto;
    public function __construct(Produto $produto)
    {
        $this->produto = $produto;
    }

    public function index()
    {
        $produtos = $this->produto->paginate(20);
        return view('pages.home.index', compact('produtos'));
    }
}