@extends('admin.master')

@section('title', 'Categorías')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{url('/admin/categories/0')}}"><i class="fa-regular fa-folder-closed"></i>Categorías</a>
</li>

@endsection


@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="tittle"><i class="fa-solid fa-square-plus"></i> Agregar Categoría</h2>
                </div>
                <div class="inside">
                    @if(kvfj(Auth::user()->permissions, 'category_add'))
                    {!! Form::open(['url' => '/admin/category/add', 'files' => true]) !!}
                    <label for="name">Nombre:</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>

                <label for="module" class="mtop16">Módulo:</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                    {!! Form::select('module', getModulesArray(), 0, ['class' => 'form-select']) !!}


            <label for="icon" class="mtop16">Ícono:</label>
            <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupFile01">Upload</label>
            {!! Form::file('icon', ['class' => 'form-control', 'required' ,'id' => 'inputGroupFile01', 'accept'=>'image/*']) !!}
            </div>

                {!! Form::submit('Guardar',['class' => 'btn btn-success mtop16']) !!}
                    {!! Form::close() !!}
                    @endif
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="panel shadow">
            <div class="header">
                <h2 class="tittle"><i class="fa-regular fa-folder-closed"></i>Categorías</h2>
            </div>
            <div class="inside">
                <nav class="nav nav-pills nav-fill col-md-12">
                    @foreach(getModulesArray() as $m => $k)
                    <a class="nav-link" href="{{url('/admin/categories/'.$m)}}"><i class="fa-solid fa-list"></i>{{ $k }}</a>
                    @endforeach
                </nav>
                <table class="table mtop16">
                    <thead>
                        <tr>
                            <td width='64px'></td>
                            <td>Nombre</td>
                            <td width="140px"></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cats as $cat)
                            <tr>
                                <td>@if(!is_null($cat->icono))
                                    <img src="{{url ('/uploads/'.$cat->file_path.'/'.$cat->icono)}}" class="img-fluid">
                                @endif</td>
                                <td>{{ $cat->name }}</td>
                                <td>
                                    <div class="opts">
                                        @if(kvfj(Auth::user()->permissions, 'category_edit'))
                                        <a href="{{ url('/admin/category/'.$cat->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa-solid fa-user-pen"></i></a>
                                        @endif
                                        @if(kvfj(Auth::user()->permissions, 'category_delete'))
                                        <a href="{{ url('/admin/category/'.$cat->id.'/delete') }}" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa-solid fa-trash"></i></a>
                                        @endif
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
    
@endsection