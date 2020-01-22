@extends('pdf.template')

@section('content')

@section('title')
Fecha : {{$order->created_at}}
@endsection


<div class="row">
    <div class="col-md-6">
        Barman : {{$user->names}} {{$user->surnames}}
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        Bar : {{$pub->name}}
    </div>
</div>
<div class="row ">
    <div class="col-md-6 mt-3">
       Productos
    </div>
</div>

<table class="table table-bordered table-striped mt-2">
    <thead class="bg-primary">
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($details as $detail)
            <tr>
                <th>{{$detail->product_name}}</th>
                <th>{{$detail->unity}}</th>    
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
@section('footer')
<label class="form-control-label float-right">Encargado : {{$admin->names}} {{$admin->surnames}}</label>
@endsection
