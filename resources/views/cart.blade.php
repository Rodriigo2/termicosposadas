@extends('master')

@section('title', 'Carrito de compra')


@section('content')

<div class="cart mtop32">
    <div class="container">
        @if (count(collect($items)) == "0")
        <div class="no_items shadow">
            <div class="inside">
            <p><img src="{{url('/static/images/empty-cart.png')}}"></p>
            <p>¡<Strong>Hola {{ Auth::user()->name }}</Strong>, ¡Mantén tus bebidas perfectas durante todo el día! Agrega nuestros vasos térmicos al carrito de compras ahora mismo.</p>

            <p>
                <a href="{{url('/store')}}">Ir a la tienda</a>
            </p>
            </div>
        </div>
    @else
    @endif
    </div>
</div>

@stop