@extends('admin.master')

@section('title', 'Editar Usuario')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{url('/admin/users')}}"><i class="fa-solid fa-users"></i>Usuarios</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="page_user">
    <div class="row">
        <div class="col-md-4">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="tittle"><i class="fa-solid fa-circle-info"></i>Información</h2>
                </div>
                <div class="inside">
                    <div class="mini_profile">
                    @if(is_null($u->avatar))
                    <img src="{{url('/static/images/default-avatar.png')}}" class="avatar">
                    @else
                    <img src="{{url('/uploads/user/'.$u->id.'/'.$user->avatar)}}" class="avatar">
                    @endif
                    <div class="info">
                        <span class="title">
                            <i class="fa-solid fa-address-card"></i> Nombre:
                          <span class="text">{{ $u->name }} {{ $u->lastname }}</span>
                        </span>

                        <span class="title">
                            <i class="fa-solid fa-user-tie"></i> Estado del usuario:
                          <span class="text">{{ getUserStatusArray(null , $u->status)}}</span>
                        </span>

                        <span class="title">
                            <i class="fa-solid fa-envelope"></i> Correo electrónico:
                          <span class="text">{{ $u->email }}</span>
                        </span>

                        <span class="title">
                            <i class="fa-solid fa-calendar-days"></i> Fecha de registro:
                          <span class="text">{{ $u->created_at }}</span>
                        </span>

                        <span class="title">
                            <i class="fa-solid fa-user-shield"></i>  Rol de usuario:
                          <span class="text">{{ getRoleUserArray(null , $u->role)}}</span>
                        </span>
                      </div>
                      @if($u->status == "100")
                      <a href="{{ url('/admin/users/'.$u->id.'/banned') }}" class="btn btn-success">Activar Usuario</a>
                      @else
                      <a href="{{ url('/admin/users/'.$u->id.'/banned') }}" class="btn btn-danger">Suspender Usuario</a>
                      @endif
                </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="tittle"><i class="fa-solid fa-pen-to-square"></i>Editar información</h2>
                </div>
                <div class="inside">
        
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection