@extends('pdf.template')

@section('content')
    
@section('title')
Fecha : {{$kardex->date}}
@endsection
<div class="row ">
    <div class="col-md-6 mt-3">
       <h3 class="text-center">INVENTARIO DIARIO</h3>
    </div>
</div>
<hr>

<label class=" text-center label" for="">Bares</label>

<table class="table table-bordered table-striped mt-2">
        <thead class="bg-primary">
            <tr>
                <th>producto</th>
                <th>Bodega</th>
                <th>Entrada</th>
                <th>Total</th>
            @foreach ($pubs as $pub)
                    @if ($pub->category == 0)
                     <th>{{$pub->name}}</th>  
                    @endif
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

                @php
                    $product_id = $detalle->product_id;
                    $encontrado = false;
                    foreach ($detallesBares as $item) {
                       if($item->product_id == $product_id){
                           $encontrado = true;
                           break;
                       }
                    }
                @endphp

                @if ($encontrado)
                    @foreach ($pubs as $pub)
                        @foreach ($detallesBares as $item)
                            @if ($item->product_id == $detalle->product_id  && $pub->category == 0)
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
                                            break;
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
   
                @else 
                    @foreach ($pubs as $pub)
                        @if ($pub->category == 0)
                            <td>0</td>
                        @endif
                    @endforeach
                @endif

                <td class="text-danger text-center"> <strong>{{$detalle->output_product}}</strong> </td>
                <td class="text-center">{{$detalle->stock_end}}</td>   
            </tr>
        @endforeach
        
    </tbody>
</table>

<div style="page-break-after:always;"></div>

<label class=" label" for="">Restaurantes</label>
<hr>
<table class="table table-bordered table-striped mt-2">
        <thead class="bg-primary">
            <tr>
                <th>producto</th>

            @foreach ($pubs as $pub)
                    @if ($pub->category == 1)
                     <th>{{$pub->name}}</th>  
                    @endif
            @endforeach

            </tr>
        </thead>
    <tbody>
        
        @foreach ($detalles as $detalle)
        <tr>
            <td>{{$detalle->name}}</td>


            @php
                $product_id = $detalle->product_id;
                $encontrado = false;
                foreach ($detallesBares as $item) {
                   if($item->product_id == $product_id){
                       $encontrado = true;
                       break;
                   }
                }
            @endphp

            @if ($encontrado)
                @foreach ($pubs as $pub)
                    @foreach ($detallesBares as $item)
                        @if ($item->product_id == $detalle->product_id  && $pub->category == 1)
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
                                        break;
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

            @else 
                @foreach ($pubs as $pub)
                    @if ($pub->category == 1)
                        <td>0</td>
                    @endif
                @endforeach
            @endif
        </tr>
    @endforeach
    </tbody>
</table>

@endsection