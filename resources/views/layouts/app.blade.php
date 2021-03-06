<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marketplace</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>

@auth
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
    <a class="navbar-brand" href="{{route('home')}}">Marketplace</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item  @if(request()->is('admin/orders*')) active @endif">
                <a class="nav-link" href="{{route('admin.orders.my')}}">
                    Meus Pedidos
                <i class="fa fa-bell"></i>
                </a>
            </li>
            <li class="nav-item  @if(request()->is('admin/lojas*')) active @endif">
                <a class="nav-link" href="{{route('admin.lojas.index')}}">Loja</a>
            </li>
            <li class="nav-item  @if(request()->is('admin/produtos*')) active @endif">
                <a class="nav-link" href="{{route('admin.produtos.index')}}">Produtos</a>
            </li>
            <li class="nav-item  @if(request()->is('admin/categorias*')) active @endif">
                <a class="nav-link" href="{{route('admin.categorias.index')}}">Categorias</a>
            </li>
        </ul>
        <div class="my-2 my-lg-0">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="{{route('admin.notifications.index')}}" class="nav-link">
                        <i class="fa fa-bell"></i>
                        <span class="badge badge-danger">{{auth()->user()->unreadNotifications->count()}}</span>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#" onclick="event.preventDefault(); document.querySelector('form.logout').submit(); ">Sair</a>
                    <form action="{{route('logout')}}" class="logout" method="post" display="none">
                        @csrf
                    </form>
                </li>
                <li class="nav-item">
                    <span class="nav-link">{{auth()->user()->name}}</span>
                </li>
            </ul>
        </div>
    </div>
</nav>
@endauth

<div class="container">
    @include('flash::message')

    @yield('content')
</div>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="{{asset('js/app.js')}}"></script>

</body>
</html>
