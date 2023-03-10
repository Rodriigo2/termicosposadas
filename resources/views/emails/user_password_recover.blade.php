@extends('emails.master')

@section('content')
<p>Hola: <strong>{{ $name }}</strong></p>
<p>Este es un correo electrónico que le ayudara a reestablecer su cuenta en nuestro sitio.</p>
<p>Para continuar haga clic en el siguiente botón e ingrese el siguiente código: <h2>{{ $code }}</h5></p>
<p><a href="{{ url('/reset?email='.$email) }}" style="display: inline-block; background-color:#e6e6e6; color: #000000;padding: 12px; border-radius: 4px; text-decoration:none;">Resetear mi contraseña</a></p>
<p>Si el anterior botón no le funciona ingrese a esta url en su navegador:</p>
<p>{{ url('/reset?email='.$email) }}</p>
@stop