<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUsuario;
use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    private $usuario;
    public function __construct(User $usuario)
    {
        $this->usuario = $usuario;
    }
    public function index(Request $request)
    {
        $usuarios = $this->usuario->orderBy('name', 'ASC')->paginate(20);

        if($request->select === 'email') {
            $usuarios = $this->usuario->orderBy('email', 'ASC')->paginate(20);
        }
        
        return view('pages.admin.usuario.index', compact('usuarios')); //lembrar de mudar a primeira rota
    }
    public function create()
    {
        return view('pages.admin.usuario.create');
    }

    public function store(StoreUpdateUsuario $request)
    {
        
        $this->usuario->create($request->all());

        return redirect()->route('index_usuario');
    }

    public function edit($id)
    {
        
        if(!$usuario = $this->usuario->find($id)) return redirect()->back();

        return view('pages.admin.usuario.edit', compact('usuario'));
    }

    public function update(StoreUpdateUsuario $request, $id)
    {
        if(!$usuario = $this->usuario->find($id)) return redirect()->back();

        $usuario->update($request->all());

        return redirect()->route('index_usuario');
    }

    public function delete($id)
    {
        if(!$usuario = $this->usuario->find($id)) return redirect()->back();

        $usuario->delete();

        return redirect()->route('index_usuario');
    }
    public function search(Request $request)
    {
        $filtro = $request->filtro;
        $usuarios = $this->usuario->where('name', 'LIKE', "%{$filtro}%")->paginate(20);
        
        return view('pages.admin.usuario.index', compact('usuarios', 'filtro'));

    }
}
