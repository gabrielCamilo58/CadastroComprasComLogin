@extends('pages.layout')

@section('navegacao')

    <h1>Detalhes do pedido n°: {{$pedido->numero}}</h1>
@endsection

@section('conteudo')

    <h3>Detalhes do pedido n°: {{$pedido->numero}}</h3>

    <ul>
        <li><strong>Total do pedido R$</strong> {{$total}}</li>
        <li><strong>Data em que foi feito: </strong> {{$pedido->data}}</li>
        <li><strong>Status: </strong>{{$pedido->status}}</li>
    </ul>
    <h3>Detalhes dos produtos:</h1>
    @foreach ($pedidoProdutos as $produto)
        
    <ul>
        <li><strong>Produto:</strong> {{$produto->name}}</li>
        <li><strong>Preço: </strong> {{$produto->price}}</li>
        <li><strong>Status: </strong>{{$pedido->status}}</li>
    </ul>
@endforeach
        
@endsection