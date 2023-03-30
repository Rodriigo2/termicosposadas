<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - {{Config::get('termicosposadas.name')}}</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="routeName" content="{{Route::currentRouteName()}}">
    <meta name="currency" content="{{Config::get('termicosposadas.currency')}}">
    <meta name="auth" content="{{ Auth::check() }}">

    @yield('custom_meta')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="{{url('/static/css/style.css?v='.time())}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;700&display=swap" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" /> --}}
<script src="https://kit.fontawesome.com/052346cdab.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
{{-- <script src="//cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script> --}}
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="{{url('/static/js/mdslider.js?v='.time())}}"></script>
<script src="{{url('/static/js/site.js?v='.time())}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script> --}}

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>

    <div class="loader" id= "loader">
        <div class="box">
            <div class="cart">
                <img src="{{url('/static/images/loading_cart.png')}}">
            </div>
            <div class="load">
                <div class="spinner-border text-secondary" role="status">
                    <span class="visually-hidden">Loading...</span>
                  </div>
            </div>
            
        </div>
    </div>

    <nav class="navbar navbar-expand-lg shadow">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ url('/static/images/banner.png') }}"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navigationMain" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navigationMain">
                <ul class="navbar-nav ms-auto"> <!-- Agrega la clase "ms-auto" aquí -->
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link"><i class="fa-solid fa-house"></i> <span>Inicio</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/store') }}" class="nav-link"><i class="fa-solid fa-store"></i> <span>Tienda</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link"><i class="fa-solid fa-id-card-clip"></i> <span>Sobre Nosotros</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link"><i class="fa-solid fa-address-book"></i> <span>Contactos</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/car') }}" class="nav-link"><i class="fa-solid fa-cart-shopping"></i> <span class="carnumber">0</span></a>
                    </li>
                    @if(Auth::guest())
                    <li class="nav-item link-acc">
                        <a href="{{ url('/login') }}" class="nav-link btn"><i class="fa-solid fa-door-open"></i> Ingresar</a>
                        <a href="{{ url('/register') }}" class="nav-link btn"><i class="fa-solid fa-user"></i> Crear Cuenta</a>
                    </li>
                    @else
                    <li class="nav-item link-acc link-user dropdown">
                        <a href="{{ url('/login') }}" class="nav-link btn dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @if(is_null(Auth::user()->avatar))
                             <img src="{{url('/static/images/default-avatar.png')}}">
                             @else 
                            <img src="{{url('/uploads_users/'.Auth::id().'/av_'.Auth::user()->avatar)}}" class="circle"> 
                             @endif Hola: {{ Auth::user()->name }}</a>
                            <ul class="dropdown-menu shadow">
                                @if (Auth::user()->role== "1")
                                <li>
                                    <a class="dropdown-item" href="{{ url('/admin') }}"><i class="fa-solid fa-chalkboard-user"></i> Administración</a>
                                </li>
                                {{-- <li><hr class="dropdown-divider"></li> --}}
                                @endif

                                <li>
                                    <a class="dropdown-item" href="{{ url('/account/favorites') }}"><i class="fa-solid fa-heart"></i> Favoritos</a>
                                </li>

                            <li>
                                <a class="dropdown-item" href="{{ url('/account/edit') }}"><i class="fa-solid fa-address-card"></i> Editar mi perfil</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('/logout') }}"><i class="fa-solid fa-right-from-bracket"></i> Salir</a>
                            </li>
                            </ul>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    

    @if (Session::has('message'))
    <div class="container">
        <div class="mtop16 alert alert-{{ Session::get('typealert') }}" style="display:none;">
        {{ Session::get('message') }}
        @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
            
        @endif
        <script>
            $('.alert').slideDown();
            setTimeout(function(){$('.alert').slideUp();},10000);
        </script>
        </div>
    </div>
    @endif
    <div class="wrapper">
        <div class="container">
        @yield('content')
    </div>
</div>
</body>
</html>