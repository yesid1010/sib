@extends('index')
@section('content')

    @if (session('mensajeok'))
        <div class="alert alert-success">
            {{ session('mensajeok') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
        </div>
    @else
        @if (session('mensajeerror'))
            <div class="alert alert-danger">
                {{ session('mensajeerror') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
        @endif
    @endif

    <div class="card-header">     
        <h3 class="float-left">Perfil de Usuario</h3> 
        @if($user->rol_id != 3)      
            <button class="btn btn-primary float-right mt-1" data-id = "{{$user->id}}"type="button" data-toggle="modal" data-target="#abrirmodalActualizarPassword">
                    <i class="fa fa-plus "></i>&nbsp;&nbsp; Actualizar Contraseña
            </button>
        @endif
        </div>

        <div class="card-body">
            <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Identificación : </label>
                <div class="col-md-9">
                    <label>{{$user->identification}}</label>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Nombres : </label>
                <div class="col-md-9">
                    <label>{{$user->names}}</label>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Apellidos : </label>
                <div class="col-md-9">
                    <label>{{$user->surnames}}</label>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Email : </label>
                <div class="col-md-9">
                    <label>{{$user->email}}</label>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Rol : </label>
                <div class="col-md-9">
                    <label>{{$user->role->name}}</label>
                </div>
            </div>
            <div class="form-group row">
                    <label class="col-md-3 form-control-label" for="text-input">Estado : </label>
                    <div class="col-md-9">
                        <label>{{$user->status}}</label>
                    </div>
            </div>
    </div>

    <!--Inicio del modal Password-->
    <div class="modal fade" id="abrirmodalActualizarPassword" tabindex="-1" usere="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-md" usere="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Actualizar Contraseña</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <form action="{{route('updatepass')}}" method="post" class="form-horizontal">
                        
                        {{csrf_field()}}

                        <input type="hidden" name="id" id="id" value="">
                        @include('profile.password')
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modalpassword-->
@endsection
