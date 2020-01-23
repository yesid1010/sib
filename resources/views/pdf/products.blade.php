@extends('pdf.template')

@section('content')

@section('title')
Fecha : {{now()}}
@endsection


<div class="row ">
    <div class="col-md-6 mt-3">
       <h3 class="text-center">STOCK DE PRODUCTOS</h3>
    </div>
</div>
<hr>
<table class="table table-bordered table-striped mt-2">
    <thead class="bg-primary">
        <tr>
            <th>Producto</th>
            <th>Stock</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
                <th>{{$product->name}}</th>
                <th>{{$product->unity}}</th>    
            </tr>
        @endforeach
    </tbody>
</table>
@endsection

