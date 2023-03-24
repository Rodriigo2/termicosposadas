@extends('admin.master')

@section('title', 'Categorías')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{url('/admin/categories/0')}}"><i class="fa-regular fa-folder-closed"></i>Categorías</a>
</li>
@if($cat->parent!="0")
<li class="breadcrumb-item">
    <a href="{{url('/admin/category/'.$cat->parent.'/subs')}}"><i class="fa-regular fa-folder-closed"></i> {{ $cat->getParent->name }}</a>
</li>
@endif
<li class="breadcrumb-item">
    <a href="{{url('/admin/category/'.$cat->id.'/edit')}}"><i class="fa-regular fa-folder-closed"></i> Editando {{ $cat->name }}</a>
</li>
@endsection


@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="tittle"><i class="fa-solid fa-user-pen"></i> Editar Categoría</h2>
                </div>
                <div class="inside">
                    {!! Form::open(['url' => '/admin/category/'.$cat->id.'/edit', 'files' => true]) !!}
                    <label for="name">Nombre:</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                    {!! Form::text('name', $cat->name, ['class' => 'form-control']) !!}
                </div>


            <label for="icon" class="mtop16">Ícono:</label>
            <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupFile01">Upload</label>
            {!! Form::file('icon', ['class' => 'form-control' ,'id' => 'inputGroupFile01', 'accept'=>'image/*']) !!}
            </div>

            <label for="order">Orden:</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                    {!! Form::number('order', $cat->order, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('Guardar',['class' => 'btn btn-success mtop16']) !!}
                    {!! Form::close() !!}
            </div>
        </div>

    </div>

    @if(!is_null($cat->icono))
        <div class="col-md-3">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="tittle"><i class="fa-solid fa-user-pen"></i> Icono actual</h2>
                </div>
                <div class="inside">
                    <img src="{{url ('/uploads/'.$cat->file_path.'/'.$cat->icono)}}" class="img-fluid">
            </div>
        </div>
        @endif
</div>
    
@endsection