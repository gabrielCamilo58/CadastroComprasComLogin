<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUsuario;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistrarController extends Controller
{
    public function index()
    {
        return view('pages.auth.cadastro');
    }
    public function store(StoreUpdateUsuario $request)
    {
        $data = $request->except('_token');
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        Auth::login($user);
        return redirect()->route('home');
    }
}
