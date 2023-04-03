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
    <div class="items mtop32">
    <div class="row">
        <div class="col-md-9">
            <div class="panel">
                <div class="header">
                    <h2 class="tittle"><i class="fa-solid fa-store"></i> Carrito de compras</h2>
                </div>
            <div class="inside">
            <table class="table table-striped align-middle table-hover">
                <thead>
                    <tr>
                        <td></td>
                        <td width= "80"></td>
                        <td><strong>Producto</strong></td>
                        <td width="160"><strong>Cantidad</strong></td>
                        <td width="100"><strong>Subtotal</strong></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>
                                <a href="{{url('/cart/item/'.$item->id.'/delete')}}" class="btn-delete"><i class="fa-solid fa-trash"></i></a>
                            </td>
                            <td>
                                <img src="{{url('/uploads/'.$item->getProduct->file_path.'/t_'.$item->getProduct->image)}}" class="img-fluid rounded">
                            </td>
                            <td>
                                <a href="{{url('/product/'.$item->getProduct->id.'/t_'.$item->getProduct->slug)}}">
                                    {{$item->label_item}}
                                </a>
                            </td>
                            <td>
                                <div class="form_quantity">
                                {!! Form::open(['url' => '/cart/item/'.$item->id.'/update']) !!}
                                {!! Form::number('quantity', $item->quantity, ['min' => '1', 'class' => 'form-control']) !!}
                                <button type="submit"><i class="fa-solid fa-floppy-disk"></i></button>
                                {!! Form::close() !!}
                                </div>
                            </td>
                            <td>
                                <strong>{{ config('termicosposadas.currency').' '.$item->total}}</strong>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>
</div>
</div>
    @endif
    </div>
</div>

@stop