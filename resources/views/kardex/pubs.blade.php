@extends('index')
@section('content')

    <div class="card-header">  
      <div class="row">
          <div class="col-md-2">
            <a class="btn btn-success py-2 mt-1 float-left" href="{{URL::previous()}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</a>
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
                    <th>Bar</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detalles as $detalle)
                    <tr>
                        <th>{{$detalle->bar}}</th>
                        <th>{{$detalle->cantidad}}</th>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div> <!-- fin card-body-->

    
@endsection