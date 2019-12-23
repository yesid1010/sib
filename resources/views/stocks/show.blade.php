@extends('index')
@section('content')
<div class="card-header text-center ">     
    <h3 class="float-left text-center"> {{$stock->name}}</h3> 
</div>
<br>
<table width="10%" class="table px-5" id="detallestock" >
    <thead class=" bg-primary">
        <tr>
            <td class="text-center">Producto</td>
            <td class="text-center">Cantidad</td>
            <td class="text-center">Editar</td>
            <td class="text-center">Eliminar</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($detalles as $detalle)
            <tr>
                <td  width="25%">{{$detalle->name}}</td>
                <td width = "25%" class="text-center">{{$detalle->quantity}}</td>
                <td width = "5%" class="text-center">
                    <button class="btn btn-primary" type="button"
                            data-target="#abrirmodalEditDetail"
                            data-toggle="modal" 
                            title="Agregar"
                            data-id="{{$detalle->id}}">
                            <i class="fa fa-pencil "></i> 
                    </button>          
                </td>
                <td width="5%" class="text-center">
                    <form action="{{route('stocks.destroy',$detalle->id)}}" method="post">
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

{{-- MODALES --}}

        <!--Inicio del modal agregar Producto por unidad-->
        <div class="modal fade" id="abrirmodalEditDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar Cantidad</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    
                    <div class="modal-body">
                        <form action="{{route('editdetail')}}" method="post" class="form-horizontal">
                            {{csrf_field()}}
                            @include('stocks.addCantDetail')
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
