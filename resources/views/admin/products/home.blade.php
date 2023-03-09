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
            <h2 class="tittle"><i class="fa-solid fa-boxes-stacked"></i>Productos</h2>
        </div>
        <div class="inside">

            <div class="btns mtop16">
                <a href="{{url('/admin/product/add')}}" class="btn btn-primary"><i class="fa-solid fa-square-plus"></i> Agregar producto</a>
            </div>
            <table class="table table-striped mtop16">
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
                        <tr @if($p->status=="0") class="table-danger" @endif>
                            <td width="50px">{{ $p->id }}</td>
                            <td width="64px">
                                <a data-fancybox="gallery" href="{{url('/uploads/'.$p->file_path.'/'.$p->image)}}" >
                                    <img src="{{url('/uploads/'.$p->file_path.'/t_'.$p->image)}}" width="64px">
                                </a>
                            </td>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->cat->name }}</td>
                            <td>{{ $p->price }}</td>
                            <td><div class="opts">
                                <a href="{{ url('/admin/product/'.$p->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa-solid fa-user-pen"></i></a>
                                <a href="{{ url('/admin/product/'.$p->id.'/delete') }}" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa-solid fa-trash"></i></a>
                            </div></td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="6">{!! $products->links('pagination::bootstrap-4', ['class' => 'pagination-links']) !!}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection