@extends('index')
@section('content')
<div class="card-header">     
    <div class="row">
        <div class="col-md-2">
        <a class="btn btn-success py-2 mt-1 float-left" href="{{url('pubs')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</a>
        </div>
        <div class="col-md-8">
            <h3 class="float-left mt-1"> Listado de ordenes : {{$pub->name}}</h3> 
        </div>
    </div>   
</div>

<div class="card-body">
    <form  action="{{route('orderspub')}}" method="get">      
        @csrf
        <input type="hidden" value="{{$pub->id}}" name="id">             
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
                <th>Detalles</th>
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

                        <form action="{{route('ordendetail')}}" method="get">
                            @csrf
                            <input type="hidden" value="{{$order->id}}" name="id">
                            <button class= "btn btn-success" type="submit">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </button> 
                        </form>
                    </td>
                    <td class="text-center">
                        <form target="_blank" action="{{route('pdf',$order->id)}}" method="get">
                            
                            <button class= "btn btn-danger" type="submit">
                                <i class="fa fa-print" aria-hidden="true"></i>
                            </button> 
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> <!-- fin card-body-->

@endsection