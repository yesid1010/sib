@extends('index')
@section('content')
<div class="card-header">     
    <h3 class="float-left">Listado de Ordenes</h3>       
    <button class="btn btn-primary float-right mt-1" type="button" data-toggle="modal" data-target="#abrirmodalOrdenes">
        <i class="fa fa-plus "></i>&nbsp;&nbsp;Agregar Orden
    </button>
</div>

<div class="card-body">
    <table id="tablaOrden" class="table table-bordered table-striped">
        <thead class="bg-primary">
            <tr>
                <th>Bar</th>
                <th>Barman</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Detalles</th>
                <th>Anular</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{$order->nameP}}</td>
                    <td>{{$order->nameU}}</td>
                    <td>{{$order->description}}</td>
                    <td>{{$order->created_at}}</td>
                    <td class="text-center">

                        <form action="{{route('ordendetail')}}" method="get">
                            @csrf
                            <input type="hidden" value="{{$order->id}}" name="id">
                            <button class= "btn btn-success" type="submit">
                                Detalle
                            </button>
                        </form>
                    </td>
                    <td class="text-center">
                        {{-- <form action="{{route('stocks.destroy',$stock->id)}}" method="post">
                            @method('DELETE')
                            @csrf --}}
                            <button class="btn btn-danger" type="submit">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </button>
                        {{-- </form> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> <!-- fin card-body-->

{{-- MODALES --}}
 <!--Inicio del modal agregar rol-->
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
<!--Fin del modal agregar rol-->

@endsection