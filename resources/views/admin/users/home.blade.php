@extends('admin.master')

@section('title', 'Usuarios')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{url('/admin/users')}}"><i class="fa-solid fa-users"></i>Usuarios</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="tittle"><i class="fa-solid fa-users"></i> Usuarios</h2>
        </div>
        <div class="inside">
            <div class="row">
                <div class="col-md-2 offset-md-10">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle btn-filtrar" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: 100%;">
                            <i class="fa-solid fa-filter"></i> Filtrar
                          </button>
                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('admin/users/all') }}"><i class="fa-solid fa-bars-staggered"></i> Todos</a></li>
                            <li><a class="dropdown-item" href="{{ url('admin/users/0') }}"><i class="fa-solid fa-user-xmark"></i> No verificados</a></li>
                            <li><a class="dropdown-item" href="{{ url('admin/users/1') }}"><i class="fa-solid fa-user-check"></i> Verificados</a></li>
                            <li><a class="dropdown-item" href="{{ url('admin/users/100') }}"><i class="fa-solid fa-user-slash"></i> Baneados</a></li>
                          </ul>
                    </div>
                </div>
            <table class="table mtop16">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Nombre</td>
                        <td>Apellido</td>
                        <td>Email</td>
                        <td>Estado</td>
                        <td>Rol del Usuario</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->lastname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ getUserStatusArray(null, $user->status) }}</td>
                        <td>{{ getRoleUserArray(null, $user->role) }}</td>
                        <td>
                            <div class="opts">
                            @if(kvfj(Auth::user()->permissions, 'user_edit'))
                            <a href="{{ url('/admin/users/'.$user->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa-solid fa-user-pen"></i></a>
                            @endif
                            @if(kvfj(Auth::user()->permissions, 'user_permissions'))
                            <a href="{{ url('/admin/users/'.$user->id.'/permissions') }}" data-toggle="tooltip" data-placement="top" title="Permisos de usuario"><i class="fa-solid fa-gear"></i></a>
                            @endif
                        </div>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="7">{!! $users->links('pagination::bootstrap-4', ['class' => 'pagination-links']) !!}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection