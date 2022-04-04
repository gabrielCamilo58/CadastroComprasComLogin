@extends('pages.layout')

@section('navegacao')
    <form action="{{ route('index_pedido') }}" class="form form-inline ml-2" method="POST">
        @csrf
        <select class="form-select form-control" aria-label="Default select example" name="select">
            <option selected>Ordenar pedido por</option>
            <option value="id">Mais recente</option>
            <option value="numero">Numero do pedido</option>
            <option value="data">data do pedido</option>
        </select>
        <button class="btn btn-outline-success">Ordenar</button>
    </form>
    <h1>Pedidos</h1>
@endsection

@section('conteudo')
    <table class="table table-condesed">
        <thead>
            <tr>
                <th>Pedido n°</th>
                <th>Total do pedido</th>
                <th>Data do Pedido</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->numero }}</td>
                    <td>{{ $pedido->total }}</td>
                    <td>{{ date('d/m/Y', strtotime($pedido->data)) }}</td>
                    <td>{{ $pedido->status }}</td>
                    <td>

                        <form action="{{ route('delete_pedido', $pedido->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('show_pedido', $pedido->id) }}" class="btn btn-info">ver</a>
                            <a href="{{ route('update_pedido', [$pedido->id, 'Cancelado']) }}"
                                class="btn btn-info">Cancelar Pedido</a>
                            <button type="submit" class="btn btn-danger">Deletar</button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="card-footer">
        @if (isset($filtro))
            {!! $pedidos->appends($filtro)->links() !!}
        @else
            {!! $pedidos->links() !!}
        @endif
    </div>
@endsection
