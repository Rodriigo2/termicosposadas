@extends('emails.master')

@section('content')
<p>Hola: <strong>{{ $name }}</strong></p>
<p>Esta es tu nueva contraseña para ingresar a nuestra plataforma:</p>
<p><h2>{{ $password }}</h5></p>
<p>Para iniciar sesión haga clic en el sigueinte boton:</p>
<p><a href="{{ url('/login') }}" style="display: inline-block; background-color:#e6e6e6; color: #000000;padding: 12px; border-radius: 4px; text-decoration:none;">Resetear mi contraseña</a></p>
<p>Si el anterior botón no le funciona ingrese a esta url en su navegador:</p>
<p>{{ url('/login') }}</p>
@stop