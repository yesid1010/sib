@extends('index')
@section('content')

    <div class="card-header">     
        <h3 class="float-left">Listado de Usuarios</h3>       
    </div>
    @if(count($errors))

    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card-body">
        <table id="tablaUsers" class="table table-bordered table-striped">
            <thead class="bg-primary">
                <tr>
                    <th>Rol</th>
                    <th>identificación</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Historial</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->role->name}}</td>
                    <td>{{$user->identification}}</td>
                    <td>{{$user->names}}</td>
                    <td>{{$user->surnames}}</td>
                    <td class="text-center"> 
                        <button class="btn btn-primary">
                            <i class="fa fa-pencil" aria-hidden="true"></i> &nbsp;Ver
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div> <!-- fin card-body-->
@endsection