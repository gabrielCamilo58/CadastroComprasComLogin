@extends('pages.layout')

@section('navegacao')

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a href="{{ route('create_usuario') }}" class="btn btn-dark ml-2">Adicionar usuario</a>
        <h1>Usuarios</h1>
    @endsection

    @section('conteudo')
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>CPF</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->cpf }}</td>
                        <td>
                            <form action="{{ route('delete_usuario', $usuario->id) }}" method="POST"
                                onsubmit=" return confirm('tem certeza que deseja excluir o usuario {{ $usuario->name }}?')">
                                @csrf
                                @method('DELETE')

                                <a href="{{ route('show_usuarioPedido', $usuario->id) }}" class="btn btn-info">Ver
                                    Pedidos</a>
                                <a href="{{ route('edit_usuario', $usuario->id) }}" class="btn btn-info">Editar</a>
                                <a href="{{ route('create_pedido', $usuario->id) }}" class="btn btn-success">Realizar
                                    Pedido</a>

                                <button type="submit" class="btn btn-danger">Deletar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="card-footer">
            @if (isset($filtro))
                {!! $usuarios->appends($filtro)->links() !!}
            @else
                {!! $usuarios->links() !!}
            @endif
        </div>
    @endsection
