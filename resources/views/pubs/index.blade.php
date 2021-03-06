@extends('index')
@section('content')

    <div class="card-header">     
        <h3 class="float-left">Listado de Bares</h3>       
        <button class="btn btn-primary float-right mt-1" type="button" data-toggle="modal" data-target="#abrirmodalBar">
            <i class="fa fa-plus "></i>&nbsp;&nbsp;Agregar Bar
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
    <div class="card-body" >
        <table id="tablaBares"  class="table table-bordered table-striped">
            <thead class="bg-primary">
                <tr>
                    <th>Tipo</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Historial</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pubs as $pub)
                    <tr>
                        @if ($pub->category == 0)
                            <td>Bar</td>
                        @else 
                            <td>Restaurante</td>
                        @endif
                        <td>{{$pub->name}}</td>
                        <td>{{$pub->description}}</td>
                        <td class="text-center"> 
                            <form action="{{route('orderspub')}}" method="get">
                                @csrf
                                <input type="hidden" value="{{$pub->id}}" name="id">
                                <button class= "btn btn-success" type="submit">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Ver
                                </button> 
                            </form>
                        </td>
                        <td class="text-center"><button class="btn btn-primary" type="button"                                             
                                    data-toggle="modal" 
                                    data-target="#abrirmodalEditarBar"
                                    data-id="{{$pub->id}}"
                                    data-name="{{$pub->name}}"
                                    data-description="{{$pub->description}}"
                                    data-category = "{{$pub->category}}">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                            </button>
                        </td>
                        <td class="text-center">
                            @if(count($pub->orders)==0)
                                <button class="btn btn-danger" data-id="{{$pub->id}}" type="button" data-toggle="modal" data-target="#abrirmodalEliminarPub">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> <!-- fin card-body-->

    <!-- MODALES -->
     <!--Inicio del modal agregar bar-->
    <div class="modal fade" id="abrirmodalBar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar Bar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <form action="{{route('pubs.store')}}" method="post" class="form-horizontal">
                        {{csrf_field()}}
                        @include('pubs.form')
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
    
    
    <!--Inicio del modal Editar bar-->
    <div class="modal fade" id="abrirmodalEditarBar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Actualizar Bar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <form action="{{route('pubs.update','test')}}" method="post" class="form-horizontal">
                        {{method_field('patch')}}
                        {{csrf_field()}}

                        <input type="hidden" name="id" id="id" value="">
                        @include('pubs.form')
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal Editar bar-->
     
    <!--Inicio del modal de eliminar-->
    <div class="modal fade" id="abrirmodalEliminarPub" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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
                    <form action="{{route('destroypub')}}" method="post">
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