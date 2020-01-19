@extends('index')
@section('content')

    <div class="card-header">  
        <div class="row">
            <div class="col-md-2">
            <a class="btn btn-success py-2 mt-1 float-left" href="{{url('kardexs')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</a>
            </div>
            <div class="col-md-2">
                <h3 class="float-left mt-1">{{$kardex->date}}</h3> 
            </div>
        </div>
    </div>

    <div class="card-body">
        <table id="tablakardexdetail" class="table table-bordered table-striped ">
            <thead class="bg-primary">
                <tr>
                    <th>producto</th>
                    <th>Bodega</th>
                    <th>Entrada</th>
                    <th>Total</th>
                    <th>Salida</th>
                    <th>Stock nuevo</th>
                    <th>Distribucion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detalles as $detalle)
                    <tr>
                        <td>{{$detalle->name}}</td>
                        <td class="text-center">{{$detalle->stock_ini}}</td>
                        <td class="text-success text-center"><strong>{{$detalle->input_product}}</strong> </td>
                        <td class="text-center">{{$detalle->total}}</td>
                        <td class="text-danger text-center"> <strong>{{$detalle->output_product}}</strong> </td>
                        <td class="text-center">{{$detalle->stock_end}}</td>
                        <td class="text-center"> 
                            <form action="{{route('distribution')}}" method="get">
                                @csrf
                                <input type="hidden" value="{{$detalle->kardex_id}}" name="kardex_id">
                                <input type="hidden" value="{{$detalle->product_id}}" name="product_id">
                                <button class= "btn btn-success" type="submit">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </button> 
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div> <!-- fin card-body-->

    
@endsection