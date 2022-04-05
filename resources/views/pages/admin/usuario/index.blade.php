@extends('pages.layout')

@section('navegacao')
<div class="d-flex justify-content-start ml-3 mt-2 mb-2">
    <form action="{{ route('search_usuario') }}" method="POST" class="d-flex ">
        @csrf
        <input type="text" name="filtro" placeholder="Pesquisar por cliente:" class="form-control">
        <button class="btn btn-outline-success">Pesquisar</button>
    </form>
    <form action="{{ route('index_usuario') }}" class="form form-inline ml-2" method="POST">
        @csrf
        <select class="form-select form-control" aria-label="Default select example" name="select">
            <option selected>Ordenar por</option>
            <option value="name">Nome</option>
            <option value="email">Email</option>
        </select>
        <button class="btn btn-outline-success">Ordenar</button>
    </form>
    
    <a href="{{ route('create_usuario') }}" class="btn btn-dark ml-2">Adicionar usuario</a>
</div>
    
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
