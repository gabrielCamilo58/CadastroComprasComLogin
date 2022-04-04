@extends('pages.layout')

@section('navegacao')
<h1>Editar dados do produto: {{$produto->name}}</h1>

@endsection

@section('conteudo')
    <form action="{{route('update_produto', $produto->id)}}" method="POST">
        @method('PUT')
       @include('pages.admin.produtos._partials.form')
    </form>
@endsection