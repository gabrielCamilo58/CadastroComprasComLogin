@extends('pages.layout')
@section('navegacao')
    <h1>Carrinho de compras</h1>
@endsection
@section('conteudo')


    <table class="table table-hover">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Quantidade</th>
            </tr>
        </thead>
        @if (isset($produtos))
            <tbody>
                @foreach ($produtos as $index => $produto)
                    <tr>
                        <td><img class=" mt-3" style="width: 150px; height: 140px"
                                src="{{ url("storage/{$produto['img']}") }}" alt="Card image cap"></td>
                        <td>{{ $produto['name'] }}</td>
                        <td>{{ $produto['price'] }}</td>
                        <td>{{ $produto['qtd'] }}</td>
                    </tr>
                    @php
                        $produtosTotais[$index]['id'] = $produto->id;
                        $produtosTotais[$index]['qtd'] = $produto->qtd;
                    @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr style="background-color: #16f09cf5">
                    <td colspan="2">Total:</td>
                    <td>{{ $total }}</td>
                    <td>
                        <form action="{{ route('store_pedido_produto', ['produtos' => $produtosTotais, 'total' => $total]) }}" method="POST">
                            @method('GET')
                            <button type="submit" class="btn btn-success">Finalizar Compra</button>
                        </form>
                </tr>
        @endif
    </table>

@endsection
