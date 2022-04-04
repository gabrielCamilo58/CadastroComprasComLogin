@extends('pages.layout')

@section('navegacao')
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
            </tr>
        </thead>

        <tbody>
            @foreach ($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->numero }}</td>
                    <td>{{ $pedido->total }}</td>
                    <td>{{ date('d/m/Y', strtotime($pedido->data)) }}</td>
                    <td>{{ $pedido->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
