@extends('admin.master')

@section('title', 'Productos')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{url('/admin/products')}}"><i class="fa-solid fa-boxes-stacked"></i>Productos</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="tittle"><i class="fa-solid fa-boxes-stacked"></i> Productos</h2>
            <ul>
            @if(kvfj(Auth::user()->permissions, 'products_add'))
            <li>
                <a href="{{url('/admin/product/add')}}"><i class="fa-solid fa-square-plus"></i> Agregar producto</a>
            </li>
                @endif
                <li>
                    <a href="#"><i class="fa-solid fa-chevron-down"></i> Filtrar</a>
                    <ul class="shadow">
                        <li>
                            <a href="{{url('/admin/products/1')}}"><i class="fa-solid fa-earth-americas"></i> Públicos</a>
                        </li>
                        <li>
                            <a href="{{url('/admin/products/0')}}"><i class="fa-solid fa-eraser"></i> Borradores</a>
                        </li>
                        <li>
                            <a href="{{url('/admin/products/trash')}}"><i class="fa-regular fa-trash-can"></i> Papelera</a>
                        </li>
                        <li>
                            <a href="{{url('/admin/products/all')}}"><i class="fa-solid fa-list"></i> Todos</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" id="btn_search">
                        <i class="fa-solid fa-magnifying-glass"></i> Buscar
                    </a>
                </li> 
            </ul>
        </div>
        <div class="inside">

            <div class="form_search" id="form_search">
                {!! Form::open(['url' => '/admin/product/search']) !!}
                <div class="row">
                    <div class="col-md-4">
                        {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Ingrese sus búsqueda', 'required']) !!}
                    </div>
                    <div class="col-md-4">
                        {!! Form::select('filter', ['0' => 'Nombre del producto', '1' => 'Código'], 0, ['class' => 'form-select']) !!}
                    </div>
                    <div class="col-md-2">
                        {!! Form::select('status', ['0' => 'Borrador', '1' => 'Públicos'], 0, ['class' => 'form-select']) !!}
                    </div>
                    <div class="col-md-2">
                        {!! Form::submit('Buscar', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                            {!! Form::close() !!}
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td></td>
                        <td>Nombre</td>
                        <td>Categoría</td>
                        <td>Precio</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $p)
                        <tr>
                            <td width="50px">{{ $p->id }}</td>
                            <td width="64px">
                                <a data-fancybox="gallery" href="{{url('/uploads/'.$p->file_path.'/'.$p->image)}}" >
                                    <img src="{{url('/uploads/'.$p->file_path.'/t_'.$p->image)}}" width="64px">
                                </a>
                            </td>
                            <td>{{ $p->name }} @if($p->status=="0") <i class="fa-solid fa-eraser" data-toggle="tooltip" data-placement="top" title="Estado: Borrador"></i> @endif</td>
                            <td>
                                {{ $p->cat->name ?? 'Ninguna' }} <i class="fa-solid fa-angles-right"></i> {{$p->getSubCategory->name}}
                                </td>
                            <td>{{ $p->price }}</td>
                            <td><div class="opts">
                                @if(kvfj(Auth::user()->permissions, 'products_edit'))
                                <a href="{{ url('/admin/product/'.$p->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa-solid fa-user-pen"></i></a>
                                @endif
                                @if(kvfj(Auth::user()->permissions, 'products_delete'))
                                <a href="{{ url('/admin/product/'.$p->id.'/delete') }}" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa-solid fa-trash"></i></a>
                                @endif
                            </div></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection