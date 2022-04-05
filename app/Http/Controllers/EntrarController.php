<?php

namespace App\Http\Controllers;

use App\Http\Requests\LogarRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EntrarController extends Controller
{
    public function index()
    {
        return view('pages.auth.login');
    }

    public function logar(LogarRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if(Hash::check($request->password, $user->password)){
                Auth::login($user);
            }else{
                return redirect()->back()->with('message', 'Senha incorreta'); 
            }
        }else{
            return redirect()->back()->with('message', 'Usuario não encontrado');
            //informar que o usuario nao foi encontrado
        }
        return redirect()->route('home');
    }
}
