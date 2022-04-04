@extends('pages.layout')

@section('navegacao')

    <h1>Detalhes do pedido n°: {{$pedido->numero}}</h1>
@endsection

@section('conteudo')

    <h3>Detalhes do pedido n°: {{$pedido->numero}}</h3>

    <ul>
        <li><strong>Total do pedido R$</strong> {{$pedido->total}}</li>
        <li><strong>Data em que foi feito: </strong> {{$pedido->data}}</li>
        <li><strong>Status: </strong>{{$pedido->status}}</li>
    </ul>
        <h3>Dados do Produto:</h1>
    <ul>
        <li><strong>Nome do produto: </strong>{{$produto->name}}</li>
        <li><strong>Preço do produto: </strong>{{$produto->price}}</li>
    </ul>

        <h3>Dados do usuario:</h1>
    <ul>
        <li><strong>Nome do usuario: </strong>{{$usuario->name}}</li>
        <li><strong>Email: </strong>{{$usuario->email}}</li>
        <li><strong>CPF: </strong>{{$usuario->cpf}}</li>
    </ul>
        
@endsection