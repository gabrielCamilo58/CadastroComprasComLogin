<?php

namespace App\Http\Controllers;

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

    public function logar(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if(Hash::check($request->password, $user->password)){
                Auth::login($user);
            }else{
                return redirect()->back();
                //informar que a senha esta incorreta
            }
        }else{
            return redirect()->back();
            //informar que o usuario nao foi encontrado
        }
        return redirect()->route('index_produto');
    }
}
