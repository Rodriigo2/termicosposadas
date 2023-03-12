@extends('admin.master')

@section('title', 'Agregar Producto')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{url('/admin/products')}}"><i class="fa-solid fa-boxes-stacked"></i>Productos</a>
</li>
<li class="breadcrumb-item">
    <a href="{{url('/admin/product/add')}}"><i class="fa-solid fa-square-plus"></i> Agregar producto</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="tittle"><i class="fa-solid fa-square-plus"></i> Agregar producto</h2>
        </div>
        <div class="inside">
            {!! Form::open(['url' => '/admin/product/add', 'files' => true]) !!}
            <div class="row">
                <div class="col-md-4">
                    <label for="name">Nombre de producto:</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
                </div>
                <div class="col-md-3">
                    <label for="category">Categoría:</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                        {!! Form::select('category', $cats, 0, ['class' => 'form-select']) !!}
                </div>
                </div>

                <div class="col-md-4">
                    <label for="img">Imagen destacada:</label>
                    <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupFile01">Upload</label>
                    {!! Form::file('img', ['class' => 'form-control', 'id' => 'inputGroupFile01', 'accept'=>'image/*']) !!}
                </div>
                </div>

                <div class="row ">
                    <div class="col-md-3">
                        <label for="price">Precio:</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                            {!! form::number('price', null, ['class' => 'form-control', 'min'=>'0.00', 'step' => 'any']) !!}
                    </div>
                    </div>

                    <div class="col-md-3">
                        <label for="indiscount">¿En descuento?:</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                            {!! Form::select('indiscount', ['0' => 'No', '1' => 'Si'], 0, ['class' => 'form-select']) !!}
                    </div>
                    </div>

                    <div class="col-md-3">
                        <label for="discount">Descuento:</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                            {!! form::number('discount', 0.00, ['class' => 'form-control', 'min'=>'0.00', 'step' => 'any']) !!}
                        </div>
                </div>

            </div>

            <div class="row mtop16">
                <div class="col-md-3">
                    <label for="inventory">Inventario:</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                        {!! form::number('inventory', 0, ['class' => 'form-control', 'min'=>'0.00']) !!}
                </div>
                </div>

                <div class="col-md-3">
                    <label for="code">Código de sistema:</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                        {!! form::text('code', 0, ['class' => 'form-control']) !!}
                </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <label for="content">Descripción</label>
                    {!! Form::textarea('content', null,['class' => 'form-control', 'id' => 'editor']) !!}
                </div>
            </div>

            <div class="row ">
                <div>
                {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
            </div>
        </div>
        {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection