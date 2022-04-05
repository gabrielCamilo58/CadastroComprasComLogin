@extends('pages.layout')

@section('navegacao')
<h1>Cadastrar novo usuario</h1>
@endsection

@section('conteudo')
@include('pages.includes.alerts')
    <form action="{{route('store_usuario')}}" method="POST">
       @include('pages.admin.usuario._partials.form')
    </form>
@endsection