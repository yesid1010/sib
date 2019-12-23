@extends('index')
@section('content')

    <div class="card-header">     
        <h3 class="float-left">Listado de Bares</h3>       
        <button class="btn btn-primary float-right mt-1" type="button" data-toggle="modal" data-target="#abrirmodalBar">
            <i class="fa fa-plus "></i>&nbsp;&nbsp;Agregar Bar
        </button>
    </div>

    <div class="card-body">
        <table id="tablaBares" class="table table-bordered table-striped">
            <thead class="bg-primary">
                <tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pubs as $pub)
                    <tr>
                        <td>{{$pub->name}}</td>
                        <td>{{$pub->description}}</td>
                        <td class="text-center"><button class="btn btn-primary" type="button"                                             
                                    data-toggle="modal" 
                                    data-target="#abrirmodalEditarBar"
                                    data-id="{{$pub->id}}"
                                    data-name="{{$pub->name}}"
                                    data-description="{{$pub->description}}">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                            </button>
                        </td>
                        <td class="text-center">
                            <form action="{{route('pubs.destroy',$pub->id)}}" method="post">
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

    <!-- MODALES -->
     <!--Inicio del modal agregar bar-->
    <div class="modal fade" id="abrirmodalBar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar Bar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <form action="{{route('pubs.store')}}" method="post" class="form-horizontal">
                        {{csrf_field()}}
                        @include('pubs.form')
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
    
    
    <!--Inicio del modal Editar bar-->
    <div class="modal fade" id="abrirmodalEditarBar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Actualizar Bar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <form action="{{route('pubs.update','test')}}" method="post" class="form-horizontal">
                        {{method_field('patch')}}
                        {{csrf_field()}}

                        <input type="hidden" name="id" id="id" value="">
                        @include('pubs.form')
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal Editar bar-->
     
    <!-- FIN MODALES -->
@endsection