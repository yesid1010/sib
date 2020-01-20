@extends('index')
@section('content')

    <div class="card-header">     
        <h3 class="float-left">Listado de Kardex</h3>       
    </div>

    <div class="card-body">
        <table id="tablakardexs" class="table table-bordered table-striped ">
            <thead class="bg-primary">
                <tr>
                    <th>Fecha</th>
                    <th>Detalles</th>
                    <th>Imprimir</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kardexs as $kardex)
                    <tr>
                        <td>{{$kardex->date}}</td>
                        <td class="text-center"> 
                            <form action="{{route('kardexshow')}}" method="get">
                                @csrf
                                <input type="hidden" value="{{$kardex->id}}" name="id">
                                <button class= "btn btn-success" type="submit">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </button> 
                            </form>
                        </td>
                        <td class="text-center">
                            <form target="_blank" action="{{route('pdfkardex',$kardex->id)}}" method="get">                               
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