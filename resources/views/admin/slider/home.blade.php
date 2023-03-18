@extends('admin.master')

@section('title', 'Modúlo de Sliders')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{url('/admin/sliders')}}"><i class="fa-solid fa-images"></i> Sliders</a>
</li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            @if(kvfj(Auth::user()->permissions, 'sliders_add'))
            <div class="panel shadow">
                <div class="header">
                    <h2 class="tittle"><i class="fa-solid fa-square-plus"></i> Agregar Slider</h2>
                </div>
                <div class="inside">
                    {!! Form::open(['url' => '/admin/slider/add', 'files' => true]) !!}
                    <label for="name">Nombre:</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>

                <label for="module" class="mtop16">Visible:</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                    {!! Form::select('visible', ['0' => 'No visible', '1' => 'Visible'], 1, ['class' => 'form-select']) !!}
                </div>

            <label for="img" class="mtop16">Imagen Destacada:</label>
            <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupFile01">Upload</label>
            {!! Form::file('img', ['class' => 'form-control' ,'id' => 'inputGroupFile01', 'accept'=>'image/*']) !!}
            </div>

            <label for="name" class="mtop16">Contenido:</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                    {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => '3']) !!}
                </div>

                <label for="sorder" class="mtop16">Orden de aparición:</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                    {!! Form::number('sorder', 0, ['class' => 'form-control', 'min' => '0']) !!}
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
                <h2 class="tittle"><i class="fa-solid fa-images"></i> Sliders</h2>
            </div>
            <div class="inside">
                <table class="table">
                    <thead>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sliders as $slider)
                            <tr>
                                <td width="180px">
                                    <img src="{{url('/uploads/'.$slider->file_path.'/'.$slider->file_name)}}" class="img-fluid">
                                </td>
                                <td>
                                    <div class="slider_content">
                                        <h1>{{ $slider->name }}</h1>
                                    {!! html_entity_decode($slider->content) !!}
                                </div>
                                </td>
                                <td width= "110px">
                                    <div class="opts">
                                        @if(kvfj(Auth::user()->permissions, 'sliders_edit'))
                                        <a href="{{ url('/admin/slider/'.$slider->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa-solid fa-user-pen"></i></a>
                                        @endif
                                        @if(kvfj(Auth::user()->permissions, 'sliders_delete'))
                                        <a href="" data-action="delete" data-path="admin/slider" data-object="{{ $slider->id }}" data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn-deleted"><i class="fa-solid fa-trash"></i>
                                        </a>
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
@endsection
