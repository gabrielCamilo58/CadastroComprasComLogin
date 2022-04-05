@extends('pages.layout')

@section('navegacao')

<form action="{{ route('search_produto_home') }}" class="d-flex ml-4 mr-4 mt-2 mb-1 " method="POST">
    @csrf
    <input type="text" name="filtro" placeholder="Pesquisar por produto:" class="form-control">
    <button class="btn btn-outline-success">Pesquisar</button>
</form>

    <div class="d-flex justify-content-between">
        <h1>Produtos Home</h1>
        <div>
            @php
                if (!isset($produtosCliente)) {
                    if (isset($_SESSION['produtos'])) {
                        $produtosCliente = $_SESSION['produtos'];
                    }else $produtosCliente = null;
                }
            @endphp

            <form action="{{route('ver_carrinho', ['produtosCliente' => $produtosCliente])}}" method="POST">
                @method('GET')
                @if (isset($_SESSION['produtos']))
                    <p class="badge badge-secondary  mt-3" >{{ count($_SESSION['produtos']) }}</p>
                @endif
                <button type="submit" class="card-link btn btn-success"><i class="fa-solid fa-bag-shopping"></i></button>
            </form>
            
        </div>
    </div>
@endsection

@section('conteudo')
    <div class="row">
        @foreach ($produtos as $produto)
            <div class="card border-success ml-3 mb-3 col-md-12 col-sm-12 col-xs-12" style="max-width: 18rem;">
                <div>
                    <img class="card-img-top mt-3" src="{{ url("storage/{$produto->img}") }}" alt="Card image cap">
                </div>
                <div class="card-body">
                    <h5 class="card-title">Produto: {{ $produto->name }}</h5>
                    <p class="card-text">{{ $produto->description }}</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"></li>
                    <li class="list-group-item">Preço: R${{ $produto->price }}</li>
                </ul>
                <div class="card-body">
                    <form
                        action="{{ route('adicionar_produto_carrinho', ['id' => $produto->id, 'produtosCliente' => $produtosCliente]) }}"
                        method="POST">
                        @method('GET')
                        <p>Adicionar ao carrinho</p>
                        <button type="submit" class="card-link btn btn-success"><i
                                class="fa-solid fa-cart-arrow-down"></i></button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <div class="card-footer">
        @if (isset($filtro))
            {!! $produtos->appends($filtro)->links() !!}
        @else
            {!! $produtos->links() !!}
        @endif
    </div>
@endsection
