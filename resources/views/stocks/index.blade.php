@extends('index')
@section('content')
<div class="card-header">     
    <h3 class="float-left">Listado de Stock Ideales</h3>       
    <button class="btn btn-primary float-right mt-1" type="button" data-toggle="modal" data-target="#abrirmodalStock">
        <i class="fa fa-plus "></i>&nbsp;&nbsp;Agregar Stock Ideal
    </button>
</div>
@if (session('mensajestock'))
<div class="alert alert-success">
    {{ session('mensajestock') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<div class="card-body">
    <table id="tablaStocks" class="table table-bordered table-striped">
        <thead class="bg-primary">
            <tr>
                <th>Bar</th>
                <th>Descripcion</th>
                <th>Detalle</th>
                <th>Editar</th>
                <th>Eliminar</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach($stocks as $stock)
                <tr>
                    <td>{{$stock->name}}</td>
                    <td>{{$stock->description}}</td>
                    <td class="text-center">

                        <form action="{{route('detail')}}" method="get">
                            @csrf
                            <input type="hidden" value="{{$stock->id}}" name="id">
                            <button class= "btn btn-success" type="submit" id="btndetalle">
                                Detalle
                            </button>
                        </form>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-primary" type="button" data-toggle="modal" 
                                data-target="#abrirmodalEditarStock"
                                data-id="{{$stock->id}}"
                                data-pub_id="{{$stock->pub_id}}"
                                data-description="{{$stock->description}}">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                        </button>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-danger" data-id="{{$stock->id}}" type="button" data-toggle="modal" data-target="#abrirmodalEliminarStock">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> <!-- fin card-body-->

{{-- MODALES --}}
 <!--Inicio del modal agregar stock-->
 <div class="modal fade" id="abrirmodalStock" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-primary modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar Stock Ideal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form action="{{route('stocks.store')}}" method="post" class="form-horizontal">
                    {{csrf_field()}}
                    @include('stocks.form')
                </form>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--Fin del modal agregar Stock-->

<!--Inicio del modal editar stock-->
<div class="modal fade" id="abrirmodalEditarStock" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-primary modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar Stock</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form action="{{route('stocks.update','test')}}" method="post" class="form-horizontal">
                    {{method_field('patch')}}
                    {{csrf_field()}}

                    <input type="hidden" name="id" id="id" value="">
                    @include('stocks.EditStock')
                </form>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--Fin del modal editar stock-->

<!--Inicio del modal de eliminar-->
<div class="modal fade" id="abrirmodalEliminarStock" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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
                <form action="{{route('destroystock')}}" method="post">
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

@endsection