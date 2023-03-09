@extends('admin.master')

@section('title', 'Categorías')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{url('/admin/categories')}}"><i class="fa-regular fa-folder-closed"></i>Categorías</a>
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
                    {!! Form::open(['url' => '/admin/category/'.$cat->id.'/edit']) !!}
                    <label for="name">Nombre:</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                    {!! Form::text('name', $cat->name, ['class' => 'form-control']) !!}
                </div>

                <label for="module" class="mtop16">Módulo:</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                    {!! Form::select('module', getModulesArray(), $cat->module, ['class' => 'form-select']) !!}
            </div>

            <label for="icon" class="mtop16">Ícono:</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                    {!! Form::text('icon', $cat->icono, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('Guardar',['class' => 'btn btn-success mtop16']) !!}
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
    
@endsection