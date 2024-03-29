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

        <!-- Columna #2 -->
        <div class="col-md-9">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="tittle"><i class="fa-solid fa-box"></i> Inventarios</h2>
                </div>
                <div class="inside">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Nombre</td>
                                <td>Existencias</td>
                                <td>Mínimo</td>
                                <td>Precio</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product->getInventory as $inventory)
                                <tr>
                                    <td>{{ $inventory->id }}</td>
                                    <td>{{ $inventory->name }}</td>
                                    <td>
                                        @if ($inventory->limited == "1")
                                        Ilimitada
                                        @else
                                        {{ $inventory->quantity }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($inventory->limited == "1")
                                        Ilimitada
                                        @else
                                        {{ $inventory->minimum }}
                                        @endif
                                    </td>
                                    <td>{{ config('termicosposadas.currency') }} {{ $inventory->price }}</td>
                                    <td width="160">
                                        <div class="opts">
                                            <a href="{{ url('/admin/product/inventory/'.$inventory->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Editar" class="edit">
                                                <i class="fa-solid fa-user-pen"></i>
                                            </a>

                                            <a href="" data-action="delete" data-path="admin/product/inventory" data-object="{{ $inventory->id }}" data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn-deleted delete">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </div>
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

</div>
@endsection