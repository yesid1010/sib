@extends('index')
@section('content')
<div class="card-header">     
    <h3 class="float-left">Listado de Stock Ideales</h3>       
    <button class="btn btn-primary float-right mt-1" type="button" data-toggle="modal" data-target="#abrirmodalStock">
        <i class="fa fa-plus "></i>&nbsp;&nbsp;Agregar Stock Ideal
    </button>
</div>

<div class="card-body">
    <table id="tablaStocks" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Bar</th>
                <th>Descripcion</th>
                <th>Detalle</th>
                <th>Editar</th>
                <th>Eliminar</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach($stocks as $stock)
                <tr>
                    <td>{{$stock->name}}</td>
                    <td>{{$stock->description}}</td>
                    <td class="text-center">
                        <button class="btn btn-success">
                            detalle
                        </button>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-primary" type="button"                                             data-toggle="modal" 
                                data-target="#abrirmodalEditarRol"
                                data-id="{{$stock->id}}"
                                data-pub_id="{{$stock->pub_id}}"
                                data-description="{{$stock->description}}">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                        </button>
                    </td>
                    <td class="text-center">
                        <form action="{{route('stocks.destroy',$stock->id)}}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger" type="submit">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> <!-- fin card-body-->
@endsection