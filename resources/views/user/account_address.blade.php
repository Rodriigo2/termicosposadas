@extends('master')

@section('title', 'Mis direcciones')

@section('content')
    <div class="row mtop32">
        <div class="col-md-3">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="tittle"><i class="fa-solid fa-map-location-dot"></i> Agregar dirección</h2>
                </div>
                <div class="inside">
                    {!! Form::open(['url' => '/account/address/add']) !!}
                    <label for="name">Nombre:</label>
                            <div class="input-group">
                            <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>
                    <label for="state" class="mtop16">Provincia:</label>
                            <div class="input-group">
                            <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                    {!! Form::select('state', $states, null, ['class' => 'form-select', 'id' => 'state']) !!}
                            </div>

                    <label for="city" class="mtop16">Ciudad:</label>
                            <div class="input-group">
                            <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                    {!! Form::select('city', [], null, ['class' => 'form-select', 'id' => 'address_city', 'required']) !!}
                            </div>

                    <label for="add1" class="mtop16">Localidad o barrio:</label>
                            <div class="input-group">
                            <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                    {!! Form::text('add1', null, ['class' => 'form-control']) !!}
                            </div>
                    
                    <label for="add2" class="mtop16">Calle / Avenida:</label>
                            <div class="input-group">
                            <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                    {!! Form::text('add2', null, ['class' => 'form-control']) !!}
                            </div>

                    <label for="add3" class="mtop16">Número:</label>
                            <div class="input-group">
                            <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                    {!! Form::text('add3', null, ['class' => 'form-control']) !!}
                            </div>

                    <label for="add4" class="mtop16">Indicaciones adicionales de esta dirección (opcional):</label>
                            <div class="input-group">
                            <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                    {!! Form::text('add4', null, ['class' => 'form-control']) !!}
                            </div>

                <div class="row mtop16">
                    <div class="col-md-12">
                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                    {!! Form::close() !!}
                </div>

            </div>
    </div>
    <div class="col-md-9">
        <div class="panel shadow">
            <div class="header">
                <h2 class="tittle"><i class="fa-solid fa-map-location-dot"></i> Mis direcciones</h2>
            </div>
            <div class="inside">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td><strong>Nombre</strong></td>
                            <td><strong>Provincia / Ciudad</strong></td>
                            <td><strong>Dirección</strong></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Auth::user()->getAddress as  $address)
                        <tr>
                            <td>
                                <p>{{ $address->name }}</p>
                            </td>
                            <td><p>{{ $address->getState->name }} - {{ $address->getCity->name }}</p>
                                @if($address->default == "0")
                                 <p><a href="{{url('/account/address/'.$address->id.'/setdefault')}}">Convertir en principal</a> </p>
                                 @else
                                 <p><small>Dirección de entrega principal</small></p>
                                 @endif
                            </td>
                            <td>
                                <p>
                                    <strong>Localidad o barrio: </strong>{{ kvfj($address->addr_info, 'add1') }}
                                </p>
                                <p>
                                    <strong>Calle / Avenida: </strong> {{ kvfj($address->addr_info, 'add2') }}
                                </p> 
                                <p>
                                    <strong>Casa/Apartamento #: </strong>{{ kvfj($address->addr_info, 'add3') }}
                                </p> 
                                <p>
                                    <strong>Referencia: </strong> {{ kvfj($address->addr_info, 'add4') }} 
                                </p>
                            </td>

                            <td>
                                @if($address->default == "0")
                                <a href="#" class="btn-delete btn-deleted" data-object="{{$address->id}}" data-action="delete" data-path="account/address">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                                @endif
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
