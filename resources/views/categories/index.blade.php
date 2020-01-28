@extends('index')
@section('content')
    <div class="card-header">     
        <h3 class="float-left">Listado de categorías</h3>       
        <button class="btn btn-primary float-right mt-1" type="button" data-toggle="modal" data-target="#abrirmodal">
            <i class="fa fa-plus "></i>&nbsp;&nbsp;Agregar Categoría
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
        <table id="tablaCategorias" class="table table-bordered table-striped">
            <thead class="bg-primary">
                <tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{$category->name}}</td>
                    <td>{{$category->description}}</td>
                    <td class="text-center"><button class="btn btn-primary" type="button"                                             data-toggle="modal" 
                                data-target="#abrirmodalEditar"
                                data-id="{{$category->id}}"
                                data-name="{{$category->name}}"
                                data-description="{{$category->description}}">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                        </button>
                    </td>
                    <td class="text-center">
                        @if(count($category->products)==0)
                            <button class="btn btn-danger" data-id="{{$category->id}}" type="button" data-toggle="modal" data-target="#abrirmodalEliminarCategoria">
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
    <!--Inicio del modal agregar-->
    <div class="modal fade" id="abrirmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar categoría</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <form action="{{route('categories.store')}}" method="post" class="form-horizontal">
                        {{csrf_field()}}
                        @include('categories.form')
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal agregar categoria-->

    <!--Inicio del modal Editar categoria-->
    <div class="modal fade" id="abrirmodalEditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Actualizar categoría</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <form action="{{route('categories.update','test')}}" method="post" class="form-horizontal">
                        {{method_field('patch')}}
                        {{csrf_field()}}

                        <input type="hidden" name="id" id="id" value="">
                        @include('categories.form')
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
        <!--Fin del modal Editar categoria-->


<!--Inicio del modal de eliminar-->
    <div class="modal fade" id="abrirmodalEliminarCategoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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
                    <form action="{{route('destroycategories')}}" method="post">
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