@extends('pages.layout')
<link rel="stylesheet" href="{{ asset('css/auth/registrar.css') }}">
@section('navegação')

    <h1>Login</h1>
   
@endsection

@section('conteudo')
@include('pages.includes.alerts')
    <div class="registration-form">
        <form action="{{route('login')}}" method="POST">
            @csrf
            <div class="form-icon">
                <span><i class=" mt-4 fa-solid fa-user"></i></span>
            </div>
            <div class="form-group">
                <input type="text" name="email" class="form-control item" id="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control item" id="password" placeholder="Senha">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-block create-account">Entrar</button>
                <a href="{{route('registrar')}}" class="btn btn-block create-account">Registar-se</a>
            </div>
        </form>

        <div class="social-media">
            <h5>Nos siga nas redes sociais</h5>
            <div class="social-icons">
                <a href="#"><i class="icon-social-facebook" title="Facebook"></i></a>
                <a href="#"><i class="icon-social-google" title="Google"></i></a>
                <a href="#"><i class="icon-social-twitter" title="Twitter"></i></a>
            </div>
        </div>
    </div>
@endsection


