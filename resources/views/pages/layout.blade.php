<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/06e9485227.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <div class="card">
        <div class="card-header">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ route('create_pedido') }}">Home</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('index_produto') }}">Produtos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('index_usuario') }}">usuarios</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('index_pedido') }}">Pedidos</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('listarPedididosPagos')}}" class="nav-link">Pedidos
                                    Pagos</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('listarPedididosCancelados')}}" class="nav-link">Pedidos
                                    Cancelados</a>
                            </li>

                        </ul>

                    </div>
                </div>
            </nav>
        </div>
        @yield('navegacao')
    </div>
    <div class="card-body">
        @yield('conteudo')
    </div>
    </div>

</body>

</html>
