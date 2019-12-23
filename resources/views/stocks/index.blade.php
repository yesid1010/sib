@extends('index')
@section('content')
<div class="card-header">     
    <h3 class="float-left">Listado de Stock Ideales</h3>       
    <button class="btn btn-primary float-right mt-1" type="button" data-toggle="modal" data-target="#abrirmodalStock">
        <i class="fa fa-plus "></i>&nbsp;&nbsp;Agregar Stock Ideal
    </button>
</div>

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
                                detalle
                            </button>
                        </form>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-primary" type="button"                                             data-toggle="modal" 
                                data-target="#abrirmodalEditarRol"
                                data-id="{{$stock->id}}"
                                data-pub_id="{{$stock->pub_id}}"
                                data-description="{{$stock->description}}">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                        </button>
                    </td>
                    <td class="text-center">
                        <form action="{{route('stocks.destroy',$stock->id)}}" method="post">
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

{{-- MODALES --}}
 <!--Inicio del modal agregar rol-->
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
<!--Fin del modal agregar rol-->

@endsection