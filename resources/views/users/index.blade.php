@extends('index')
@section('content')

    <div class="card-header">     
        <h3 class="float-left">Listado de Usuarios</h3>       
        <button class="btn btn-primary float-right mt-1" type="button" data-toggle="modal" data-target="#abrirmodaluser">
            <i class="fa fa-plus "></i>&nbsp;&nbsp;Agregar Usuario
        </button>
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
                    <th>Estado</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                    <th>Contraseña</i></th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->role->name}}</td>
                    <td>{{$user->identification}}</td>
                    <td>{{$user->names}}</td>
                    <td>{{$user->surnames}}</td>
                    <td> 
                        @if($user->status == 'ENABLED') 
                            <form action="{{route('statuser',$user->id)}}" method="get">
                                @csrf
                                <button class= "btn btn-info" type="submit">
                                    Habilitado
                                </button>
                            </form>
                         @else 
                            <form action="{{route('statuser',$user->id)}}" method="get">
                                @csrf
                                <button class= "btn btn-secondary" type="submit">
                                    Deshabilitado
                                </button>
                            </form>
                        @endif
                    </td>
                    <td class="text-center">
                        <button class="btn btn-primary editar" type="button"
                                data-toggle="modal" 
                                data-target="#abrirmodalEditarUser"
                                data-id="{{$user->id}}"
                                data-identification="{{$user->identification}}"
                                data-names="{{$user->names}}"
                                data-surnames="{{$user->surnames}}"
                                data-email="{{$user->email}}"
                                data-role_id = "{{$user->role_id}}"
                                >
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                        </button>
                    </td>
                    <td class="text-center">
                        @if(count($user->orders)== 0)
                            <button class="btn btn-danger" data-id="{{$user->id}}" type="button" data-toggle="modal" data-target="#abrirmodalEliminarUser">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </button>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($user->password=='' && $user->role_id != 3)
                            <button class="btn btn-primary password" type="button"
                            data-toggle="modal" 
                            data-target="#abrirmodalPassword"
                            data-id="{{$user->id}}"
                            >
                            <i class="fa fa-unlock-alt" aria-hidden="true"></i>&nbspCrear
                        </button>
                        @else 
                            @if($user->role_id != 3  )
                                    <button class="btn btn-primary password" type="button"
                                        data-toggle="modal" 
                                        data-target="#abrirmodalPassword"
                                        data-id="{{$user->id}}"
                                        >
                                        Restaurar
                                </button>
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div> <!-- fin card-body-->

    <!-- MODALES -->
    
    <!--Inicio del modal agregar usuario-->
    <div class="modal fade" id="abrirmodaluser" tabindex="-1" usere="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-md" usere="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar Usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <form action="{{route('users.store')}}" method="post" class="form-horizontal">
                        {{csrf_field()}}
                        @include('users.form')
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal agregar usuario-->

    <!--Inicio del modal Editar usuario-->
    <div class="modal fade" id="abrirmodalEditarUser" tabindex="-1" usere="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-md" usere="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Actualizar usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <form action="{{route('users.update','test')}}" method="post" class="form-horizontal">
                        {{method_field('patch')}}
                        {{csrf_field()}}

                        <input type="hidden" name="id" id="id" value="">
                        @include('users.form')
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal Editar usuario-->

    <!--Inicio del modal Password-->
    <div class="modal fade" id="abrirmodalPassword" tabindex="-1" usere="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-md" usere="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar Contraseña</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <form action="{{route('password')}}" method="post" class="form-horizontal">
                        
                        {{csrf_field()}}

                        <input type="hidden" name="id" id="id" value="">
                        @include('users.password')
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modalpassword-->


    <!--Inicio del modal de eliminar-->
    <div class="modal fade" id="abrirmodalEliminarUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary " role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">¿ Está seguro de realizar esta acción?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <h5>Al dar click en Aceptar, No se podrá deshacer esta acción.</h5>
                    <form action="{{route('destroyuser')}}" method="post">
                        {{csrf_field()}}   
                        <input type="hidden" name="id" id="id" value="">  
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Aceptar</button> 
                        </div>
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
    <!-- FIN MODALES -->
@endsection