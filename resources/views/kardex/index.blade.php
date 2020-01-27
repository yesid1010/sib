@extends('index')
@section('content')

    <div class="card-header">     
        <h3 class="float-left">Listado de Kardex</h3>       
    </div>

    <div class="card-body ">
     

            <form  action="{{route('kardexs.index','test')}}" method="get">                               
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
        <table id="tablakardexs" class="table table-bordered table-striped">
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