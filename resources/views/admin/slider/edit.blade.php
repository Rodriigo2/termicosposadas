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
        <div class="col-md-12">
            @if(kvfj(Auth::user()->permissions, 'sliders_edit'))
            <div class="panel shadow">
                <div class="header">
                    <h2 class="tittle"><i class="fa-solid fa-pen-to-square"></i> Editar Slider</h2>
                </div>
                <div class="inside">
                    {!! Form::open(['url' => '/admin/slider/'.$slider->id.'/edit']) !!}
                    <label for="name">Nombre:</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                    {!! Form::text('name', $slider->name, ['class' => 'form-control']) !!}
                </div>

                <label for="module" class="mtop16">Visible:</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                    {!! Form::select('visible', ['0' => 'No visible', '1' => 'Visible'], $slider->status, ['class' => 'form-select']) !!}
                </div>

            <label for="img" class="mtop16">Imagen Destacada:</label>
            <div class="row">
                <div class="col-md-4">
                    <img src="{{url('/uploads/'.$slider->file_path.'/'.$slider->file_name)}}" class="img-fluid">
                </div>
            </div>

            <label for="name" class="mtop16">Contenido:</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                    {!! Form::textarea('content', html_entity_decode($slider->content), ['class' => 'form-control', 'rows' => '3']) !!}
                </div>

                <label for="sorder" class="mtop16">Orden de aparición:</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                    {!! Form::number('sorder', $slider->sorder, ['class' => 'form-control', 'min' => '0']) !!}
                </div>

                {!! Form::submit('Guardar',['class' => 'btn btn-success mtop16']) !!}
                    {!! Form::close() !!}
            @endif
        </div>
        </div>
    </div>
@endsection