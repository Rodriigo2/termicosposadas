@extends('admin.master')

@section('title', 'Cobertura de envios')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{url('/admin/coverage')}}"><i class="fa-solid fa-truck-fast"></i> Cobertura de envios</a>
</li>
<li class="breadcrumb-item">
    <a href="{{url('/admin/coverage/'.$coverage->id.'/edit')}}"><i class="fas fa-edit"></i> Editar Provincia / Ciudad</a>
</li>


@endsection


@section('content')
<div class="container-fluid">
<div class="row">
    <div class="col-md-3">
        @if(kvfj(Auth::user()->permissions, 'coverage_edit'))
        <div class="panel shadow">
            <div class="header">
                <h2 class="tittle"><i class="fas fa-edit"></i> Editar cobertura de envió</h2>
            </div>
            <div class="inside">
                
                {!! Form::open(['url' => '/admin/coverage/state/'.$coverage->id.'/edit']) !!}
                <label for="name">Nombre:</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                {!! Form::text('name', $coverage->name, ['class' => 'form-control']) !!}
            </div>

            <label for="status" class="mtop16">Estado:</label>
            <div class="input-group">
                <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                {!! Form::select('status', getCoverageStatus(), $coverage->status, ['class' => 'form-select']) !!}

            </div>
            <label for="name" class="mtop16">Días estimados de entrega:</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                {!! Form::number('days',$coverage->days, ['class' => 'form-control', 'min' => '0' , 'step' => 'any']) !!}
            </div>

            {!! Form::submit('Guardar',['class' => 'btn btn-success mtop16']) !!}
                {!! Form::close() !!}
                
                </div>
                @endif
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="tittle"><i class="fa-solid fa-truck-fast"></i> Información General</h2>
                </div>
                <div class="inside">
                    @if ($coverage->ctype == "0")
                    <p><Strong>Tipo:</Strong> Provincia / Ciudad</p>
                    <p><strong>Nombre: </strong> {{$coverage->name}} </p>
                    @endif
                    </div>
                </div>
            </div>
    </div>
    </div>
</div>

@endsection