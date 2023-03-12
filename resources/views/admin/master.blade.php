<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - TermicosPosadas</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="routeName" content="{{Route::currentRouteName()}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <link rel="stylesheet" href="{{url('/static/css/admin.css?v='.time())}}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"
/>
    <script src="https://kit.fontawesome.com/052346cdab.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
<script src="//cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
<script src="{{url('/static/js/admin.js?v='.time())}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip()
    });
</script>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <div class="wrapper">
        <div class="col1">@include('admin.sidebar')</div>
        <div class="col2">
            <nav class="navbar navbar-expand-lg shadow">
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{ url('/admin') }}" class="nav-link">
                                <i class="fa-solid fa-house-chimney"></i> Dashboard</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="page">
                <div class="container-fluid">
                    <nav aria-label="breadcrumb shadow">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/admin')}}"><i class="fa-solid fa-house-chimney"></i> Dashboard</a></li>
                            @section('breadcrumb')
                            @show
                        </ol>
                    </nav>
                </div>
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
        @section('content')
        @show
            </div>
        </div>
    </div>

</body>
</html>