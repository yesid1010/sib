@extends('index')
@section('content')
<div class="card-header text-center ">     
<h3 class="float-left text-center"> {{$pub->name}} - {{$order->created_at}}</h3> 
    @if($order->status == 1)
        <button class="btn btn-primary float-right mt-1" data-id = "{{$order->id}}"type="button" data-toggle="modal" data-target="#abrirmodalaAddProductOrder">
            <i class="fa fa-plus "></i>&nbsp;&nbsp; Agregar Producto
        </button>
    @endif
</div>
<div class="row">
    <label class="form-control-label col-md-12 px-5 py-2">{{$order->description}}</label>
</div>

<hr>
    

<table class="table px-5 col-md-8  table-striped" id="detalleorden" >
    <thead class=" bg-primary">
        <tr>
            <td class="text-center">Producto</td>
            <td class="text-center">Cantidad</td>
            @if($order->status == 1)
                <td class="text-center">Editar</td>
                <td class="text-center">Eliminar</td>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach ($detalles as $detalle)
            <tr>
                <td class="text-center" >{{$detalle->product_name}}</td>
                <td class="text-center">{{$detalle->unity}}</td>
                @if($order->status == 1)
                    <td class="text-center">
                        <button class="btn btn-primary" type="button"
                                data-target="#abrirmodalEditDetailOrder"
                                data-toggle="modal" 
                                title="Editar"
                                data-id="{{$detalle->id}}"
                                data-unity="{{$detalle->unity}}">
                                <i class="fa fa-pencil "></i> 
                        </button>          
                    </td>
                    <td width="5%" class="text-center">
                        <form action="{{route('orders.destroy',$detalle->id)}}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger" type="submit">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </button>
                        </form>
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>

{{-- MODALES --}}

    <!--Inicio del modal editar Producto de un stock ideal-->
    <div class="modal fade" id="abrirmodalEditDetailOrder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Cantidad</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <form action="{{route('editorder')}}" method="post" class="form-horizontal">
                        {{csrf_field()}}
                        
                        @include('orders.EditCantDetail')
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->


    <!--Inicio del modal Agregar un Producto a un stock ideal ya creado-->
    <div class="modal fade" id="abrirmodalaAddProductOrder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar Producto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <form action="{{route('addproductorder')}}" method="post" class="form-horizontal">
                        {{csrf_field()}}
                        @include('orders.addproductorder')
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
{{-- FIN MODALES --}}
@endsection
