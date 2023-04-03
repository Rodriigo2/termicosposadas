@extends('admin.master')

@section('title', 'Cobertura de envios')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{url('/admin/coverage')}}"><i class="fa-solid fa-truck-fast"></i> Cobertura de envios</a>
</li>

@endsection


@section('content')
<div class="container-fluid">
<div class="row">
    <div class="col-md-3">
        @if(kvfj(Auth::user()->permissions, 'coverage_add'))
        <div class="panel shadow">
            <div class="header">
                <h2 class="tittle"><i class="fa-solid fa-square-plus"></i> Agregar cobertura de envió</h2>
            </div>
            <div class="inside">
                
                {!! Form::open(['url' => '/admin/category/add/', 'files' => true]) !!}
                <label for="name">Nombre:</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>

            <label for="module" class="mtop16">Tipo de cobertura:</label>
            <div class="input-group">
                <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                {!! Form::select('ctype', getCoverageType(), null, ['class' => 'form-select']) !!}

            </div>

            <label for="name" class="mtop16">Valor de envió:</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                {!! Form::number('shipping_value', Config::get('termicosposadas.shipping_default_value'), ['class' => 'form-control', 'min' => '1' , 'step' => 'any']) !!}
            </div>

            <label for="name" class="mtop16">Días estimados de entrega:</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                {!! Form::number('days',0, ['class' => 'form-control', 'min' => '0' , 'step' => 'any']) !!}
            </div>

            {!! Form::submit('Guardar',['class' => 'btn btn-success mtop16']) !!}
                {!! Form::close() !!}
                
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection