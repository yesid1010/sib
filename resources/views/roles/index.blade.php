@extends('index')
@section('content')
    <div class="card-header">     
        <h3 class="float-left">Listado de Roles</h3>       
        <button class="btn btn-primary float-right mt-1" type="button" data-toggle="modal" data-target="#abrirmodalrol">
            <i class="fa fa-plus "></i>&nbsp;&nbsp;Agregar Rol
        </button>
    </div>
    {{-- manejo de errores de campos --}}
    @if(count($errors))

    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
    {{-- fin manejo de errores de campos --}}
    <div class="card-body">
        <table id="tablaRols" class="table table-bordered table-striped">
            <thead class="bg-primary">
                <tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{$role->name}}</td>
                        <td>{{$role->description}}</td>
                        <td class="text-center">
                            <button class="btn btn-primary" type="button"                                             data-toggle="modal" 
                                    data-target="#abrirmodalEditarRol"
                                    data-id="{{$role->id}}"
                                    data-name="{{$role->name}}"
                                    data-description="{{$role->description}}">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                            </button>
                        </td>
                        <td class="text-center">
                            @if(count($role->users)==0)
                                <button class="btn btn-danger" data-id="{{$role->id}}" type="button" data-toggle="modal" data-target="#abrirmodalEliminarRole">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> <!-- fin card-body-->

    <!--- MODALES --->
    <!--Inicio del modal agregar rol-->
    <div class="modal fade" id="abrirmodalrol" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar Rol</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <form action="{{route('roles.store')}}" method="post" class="form-horizontal">
                        {{csrf_field()}}
                        @include('roles.form')
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal agregar rol-->


    <!--Inicio del modal Editar rol-->
    <div class="modal fade" id="abrirmodalEditarRol" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Actualizar Rol</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <form action="{{route('roles.update','test')}}" method="post" class="form-horizontal">
                        {{method_field('patch')}}
                        {{csrf_field()}}

                        <input type="hidden" name="id" id="id" value="">
                        @include('roles.form')
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal Editar rol-->


    <!--Inicio del modal de eliminar-->
    <div class="modal fade" id="abrirmodalEliminarRole" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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
                    <form action="{{route('destroyrole')}}" method="post">
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