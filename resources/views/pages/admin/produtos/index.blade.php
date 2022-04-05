@extends('pages.layout')

@section('navegacao')
    <div class="d-flex justify-content-start">
        <form action="{{ route('search_produto') }}" class="d-flex" method="POST">
            @csrf
            <input type="text" name="filtro" placeholder="Pesquisar por produto:" class="form-control">
            <button class="btn btn-outline-success">Pesquisar</button>
        </form>
        <form action="{{ route('index_produto') }}" class="form form-inline ml-2" method="POST">
            @csrf
            <select class="form-select form-control" aria-label="Default select example" name="select">
                <option selected>Ordenar produto por</option>
                <option value="name">Nome</option>
                <option value="preco">Preço</option>
            </select>
            <button class="btn btn-outline-success">Ordenar</button>
        </form>
    </div>

    <a href="{{ route('create_produto') }}" class="btn btn-dark ml-2 mt-2 mb-2">Adicionar Produto</a>

    <h1>Produtos Admin</h1>
@endsection

@section('conteudo')
    <div class="row">
        @foreach ($produtos as $produto)
            <div class="card border-success ml-3 mb-3 col-md-12 col-sm-12 col-xs-12" style="max-width: 18rem;">
                <img class="card-img-top mt-3" src="{{ url("storage/{$produto->img}") }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Produto: {{ $produto->name }}</h5>
                    <p class="card-text">{{ $produto->description }}</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"></li>
                    <li class="list-group-item">Preço: R${{ $produto->price }}</li>
                </ul>
                <div class="card-body">
                    <form action="{{ route('delete_produto', $produto->id) }}" method="POST"
                        onsubmit=" return confirm('tem certeza que deseja deletar o produto: {{ $produto->name }}') ">
                        @csrf
                        @method('DELETE')

                        <a href="{{ route('edit_produto', $produto->id) }}" class="btn btn-info"><i
                                class="fa-solid fa-pen-to-square"></i></a>

                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
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
