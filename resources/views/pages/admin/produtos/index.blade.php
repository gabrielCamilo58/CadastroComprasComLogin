@extends('pages.layout')

@section('navegacao')
    <a href="{{ route('create_produto') }}" class="btn btn-dark ml-2">Adicionar Produto</a>

    <h1>Produtos</h1>
@endsection

@section('conteudo')
    <div class="row">
        @foreach ($produtos as $produto)
            <div class="card border-success ml-3 mb-3 col-md-12 col-sm-12 col-xs-12" style="max-width: 18rem;">
                <img class="card-img-top mt-3" src="{{url("storage/{$produto->img}")}}" alt="Card image cap">
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

                        <a href="{{ route('edit_produto', $produto->id) }}" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>

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
