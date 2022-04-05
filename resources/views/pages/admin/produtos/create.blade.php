@extends('pages.layout')

@section('navegacao')
<h1>Cadastrar novo Produto</h1>
@endsection

@section('conteudo')
    @include('pages.includes.alerts')
    <form action="{{route('store_produto')}}" method="POST" enctype="multipart/form-data">
       @include('pages.admin.produtos._partials.form')
    </form>
@endsection