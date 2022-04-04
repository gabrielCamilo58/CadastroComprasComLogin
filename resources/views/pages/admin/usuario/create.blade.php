@extends('pages.layout')

@section('navegacao')
<h1>Cadastrar novo usuario</h1>
@endsection

@section('conteudo')
    <form action="{{route('store_usuario')}}" method="POST">
       @include('pages.usuario._partials.form')
    </form>
@endsection