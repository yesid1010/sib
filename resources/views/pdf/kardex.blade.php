@extends('pdf.template')

@section('content')
    
<div class="row">
    <div class="col-md-6">
        KARDEX
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        Fecha : {{$kardex->date}}
    </div>
</div>
<hr>
<table class="table table-bordered table-striped mt-2">
        <thead class="bg-primary">
            <tr>
                <th>producto</th>
                <th>Bodega</th>
                <th>Entrada</th>
                <th>Total</th>
            @foreach ($pubs as $pub)
                <th>{{$pub->name}}</th>
            @endforeach
                <th>Salida</th>
                <th>Stock</th>

            </tr>
        </thead>
    <tbody>
        @foreach ($detalles as $detalle)
            <tr>
                <td>{{$detalle->name}}</td>
                <td class="text-center">{{$detalle->stock_ini}}</td>
                <td class="text-success text-center"><strong>{{$detalle->input_product}}</strong> </td>
                <td class="text-center ">{{$detalle->total}}</td>

                @foreach ($pubs as $pub)
                    @foreach ($detallesBares as $item)
                        @if ($item->product_id == $detalle->product_id)
                            @if ($item->pub_id == $pub->id )
                                    <td><strong>{{$item->cantidad}}</strong></td>
                                    @break
                            @else 
                                @php
                                    $bar = $pub->id;
                                    $producto = $detalle->product_id;
                                    $encontrado = 0;
                                    $cantidad = 0;
                                    foreach ($detallesBares as $ite) {
                                        if($bar == $ite->pub_id && $producto == $ite->product_id ){
                                            $encontrado = 1;
                                            $cantidad = $ite->cantidad;
                                        }
                                    }

                                    if($encontrado == 1){ 
                                       echo '<td> <strong>'.$cantidad.'</strong> </td>';
                                    }else{
                                        echo '<td>0</td>';
                                    }
                                @endphp

                                @break
                            @endif
                        @endif
                    @endforeach               
                @endforeach
                <td class="text-danger text-center"> <strong>{{$detalle->output_product}}</strong> </td>
                <td class="text-center">{{$detalle->stock_end}}</td>   
            </tr>
        @endforeach
        
    </tbody>
</table>

@endsection