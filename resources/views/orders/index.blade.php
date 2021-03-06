@extends('index')
@section('content')
<div class="card-header">     
    <h3 class="float-left">Listado de Ordenes</h3>       
    <button class="btn btn-primary float-right mt-1" type="button" data-toggle="modal" data-target="#abrirmodalOrdenes">
        <i class="fa fa-plus "></i>&nbsp;&nbsp;Agregar Orden
    </button>
</div>

<div class="card-body">
    <form  action="{{route('orders.index','test')}}" method="get">                               
        <div class="row ">
            <div class="col-md-4"> 
                <input type="text" class="form-control col-md-10" name="start_date" id="start_date" placeholder="Fecha inicial" onfocus="(this.type='date')" onblur="(this.type='text')" >

            </div>
            <div class="col-md-4">
                <input type="text" class="form-control col-md-10" name="end_date" id="end_date"placeholder="Fecha final" onfocus="(this.type='date')" onblur="(this.type='text')" >
                
            </div>
            <div class="col-md-4">
                <button class= "btn btn-danger" type="submit">
                    Filtrar
                </button>
            </div>
        </div>
    </form>
    <hr>
    <table id="tablaOrden" class="table table-bordered table-striped">
        <thead class="bg-primary">
            <tr>
                <th>Bar</th>
                <th>Barman</th>
                
                <th>Fecha </th>
                <th>Estado</th>
                <th>Detalles</th>
                <th>Editar</th>
                <th>imprimir</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{$order->nameP}}</td>
                    <td>{{$order->nameU}}</td>
                   
                    <td>{{$order->created_at}}</td>
                    <td class="text-center">
                       @if($order->status == 1) 
                            <button class="btn btn-info mx-3 mt-1" type="button"
                                    data-toggle="modal" data-target="#cerrarorden"
                                    data-id = "{{$order->id}}">
                                Abierto
                            </button>
                            {{-- <form action="{{route('status',$order->id)}}" method="get">
                                @csrf
                                <button class= "btn btn-info" type="submit">
                                    Abierto
                                </button>
                            </form> --}}
                        @else 
                            <button title="Cerrado" class= "btn btn-secondary" disabled type="submit">
                                Cerrado
                            </button>
                        @endif

                    </td>
                    <td class="text-center">

                        <form action="{{route('ordendetail')}}" method="get">
                            @csrf
                            <input type="hidden" value="{{$order->id}}" name="id">
                            <button class= "btn btn-success" type="submit">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </button> 
                        </form>
                    </td>
                    <td class="text-center">
                        @if($order->status == 1)
                            <button class            ="btn btn-primary"
                                    type             ="button" 
                                    data-id          ="{{$order->id}}"
                                    data-user_id     ="{{$order->user_id}}"
                                    data-pub_id      ="{{$order->pub_id}}"
                                    data-description ="{{$order->description}}"
                                    data-toggle      ="modal" 
                                    data-target      ="#abrirmodalEditarOrden">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                            </button>
                        @else
                            <button class="btn btn-secondary" disabled="disabled">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </button>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($order->status == 0)  
                        <form target="_blank" action="{{route('pdf',$order->id)}}" method="get">
                            
                            <button class= "btn btn-danger" type="submit">
                                <i class="fa fa-print" aria-hidden="true"></i>
                            </button> 
                        </form>
                      @else
                        <button disabled class= "btn btn-secondary" type="submit">
                            <i class="fa fa-print" aria-hidden="true"></i>
                        </button> 
                    @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> <!-- fin card-body-->

{{-- MODALES --}}
 <!--Inicio del modal agregar orden-->
 <div class="modal fade" id="abrirmodalOrdenes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-primary modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar Orden</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form action="{{route('orders.store')}}" method="post" class="form-horizontal">
                    {{csrf_field()}}
                    @include('orders.form')
                </form>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--Fin del modal agregar orden-->

<!--Inicio del modal agregar orden-->
<div class="modal fade" id="abrirmodalEditarOrden" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-primary modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar Orden</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form action="{{route('orders.update','test')}}" method="post" class="form-horizontal">
                    {{method_field('patch')}}
                    {{csrf_field()}}

                    <input type="hidden" name="id" id="id" value="">
                    @include('orders.formEditOrden')
                </form>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--Fin del modal agregar orden-->

<!--Inicio del modal de cerrar orden-->
<div class="modal fade" id="cerrarorden" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-primary " role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">¿ Está seguro de cerrar esta orden?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            <div class="modal-body">
                <h5>Al dar click en Aceptar, No se podrá deshacer esta acción.</h5>
                <form action="{{route('status','test')}}" method="get">
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