@extends('admin.master')

@section('title', 'Inventario Producto')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{url('/admin/products/1')}}"><i class="fa-solid fa-boxes-stacked"></i>Productos</a>
</li>
<li class="breadcrumb-item">
    <a href="{{url('/admin/product/'.$product->id.'/edit')}}"><i class="fa-solid fa-boxes-stacked"></i>{{ $product->name}}</a>
</li>
<li class="breadcrumb-item">
    <a href="{{url('/admin/product/'.$product->id.'/inventory')}}"><i class="fa-solid fa-box"></i> Inventario</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Columna #1 -->
        <div class="col-md-3">
    <div class="panel shadow">
        <div class="header">
            <h2 class="tittle"><i class="fa-solid fa-box"></i> Crear Inventario</h2>
        </div>
        <div class="inside">
            {!! Form::open(['url' => 'admin/product/'.$product->id.'/inventory']) !!}
            <label for="name">Nombre del inventario:</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>

                <label for="inventory" class="mtop16">Cantidad en inventario:</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                    {!! Form::number('inventory', 1, ['class' => 'form-control', 'min' => '1']) !!}
                </div>

                <label for="price" class="mtop16">Precio:</label>
                    <div class="input-group">
                        <div class="input-group-text">{{ config('termicosposadas.currency') }}</div>
                    {!! Form::number('price', 1.00, ['class' => 'form-control', 'min' => '1', 'step' => 'any']) !!}
                </div>

                <label for="limited" class="mtop16">Límite de inventario:</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                    {!! Form::select('limited', ['0' => 'Límitado', '1' => 'Sin límite'], 0, ['class' => 'form-select']) !!}
                </div>

                <label for="minimum" class="mtop16">Inventario mínimo:</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                    {!! Form::number('minimum', 1, ['class' => 'form-control', 'min' => '1']) !!}
                </div>

                {!! Form::submit('Guardar',['class' => 'btn btn-success mtop16']) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>
    </div>
</div>

</div>
@endsection