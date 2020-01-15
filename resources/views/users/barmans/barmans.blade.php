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
                        <form action="{{route('ordersbarman')}}" method="get">
                            @csrf
                            <input type="hidden" value="{{$user->id}}" name="id">
                            <button class= "btn btn-success" type="submit">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Ver
                            </button> 
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div> <!-- fin card-body-->
@endsection