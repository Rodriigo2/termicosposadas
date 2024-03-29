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
                <h2 class="tittle"><i class="fa-solid fa-square-plus"></i> Nuevo Provincia / Ciudad</h2>
            </div>
            <div class="inside">
                
                {!! Form::open(['url' => '/admin/coverage/state/add/']) !!}
                <label for="name">Nombre:</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
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

        <div class="col-md-9">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="tittle"><i class="fa-solid fa-truck-fast"></i> Listado de Provincias / Ciudades</h2>
                    </div>
                    <div class="inside"> 
                        <table class="table mtop16">
                            <thead>
                                <tr>
                                    <td><strong>Estado</strong></td>
                                    <td><strong>Provincia / Ciudad</strong></td>
                                    <td><strong>Entrega estimada en:</strong></td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($states as $state)
                                    <tr>
                                        <td>{{ getCoverageStatus($state->status) }}</td>
                                        <td>{{ $state->name }}</td>
                                        <td>@if ($state->days== "1")
                                            {{$state->days}} Día
                                            @else
                                            {{$state->days}} Días
                                        @endif</td>
                                        <td>
                                            <div class="opts">
                                                @if(kvfj(Auth::user()->permissions, 'coverage_edit'))
                                                <a href="{{ url('/admin/coverage/'.$state->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Editar" class="edit"><i class="fa-solid fa-user-pen"></i></a>
            
                                                @endif
                                                <a href="{{ url('/admin/coverage/'.$state->id.'/cities') }}" data-toggle="tooltip" data-placement="top" title="Ciudades" class="inventory"><i class="fa-solid fa-list"></i></a>
            
                                                
                                                @if(kvfj(Auth::user()->permissions, 'coverage_delete'))
                                                <a href="{{ url('/admin/coverage/'.$state->id.'/delete') }}" data-action="delete" data-path="admin/coverage" data-object="{{ $state->id }}" data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn-deleted delete"><i class="fa-solid fa-trash"></i>
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
    </div>
</div>
@endsection