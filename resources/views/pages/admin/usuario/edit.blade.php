@extends('pages.layout')

@section('navegacao')
<h1>Editar dados de usuario: {{$usuario->name}}</h1>
@endsection

@section('conteudo')
@include('pages.includes.alerts')
    <form action="{{route('update_usuario', $usuario->id)}}" method="POST">
       @include('pages.admin.usuario._partials.form')
    </form>
@endsection