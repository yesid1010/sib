@extends('index')
@section('content')

    <div class="card-header">     
     <h3 class="float-left">{{$kardex->date}}</h3>       
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

                    </tr>
                @endforeach

            </tbody>
        </table>
    </div> <!-- fin card-body-->

    
@endsection