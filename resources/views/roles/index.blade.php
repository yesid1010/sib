@extends('index')
@section('content')
    <div class="card-header">     
        <h3 class="float-left">Listado de Roles</h3>       
        <button class="btn btn-primary float-right mt-1" type="button" data-toggle="modal" data-target="#abrirmodalrol">
            <i class="fa fa-plus "></i>&nbsp;&nbsp;Agregar Rol
        </button>
    </div>

    <div class="card-body">
        <table id="tablaRols" class="table table-bordered table-striped">
            <thead>
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
                            <form action="{{route('roles.destroy',$role->id)}}" method="post">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger" type="submit">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </button>
                            </form>
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
    <!-- FIN MODALES -->
@endsection