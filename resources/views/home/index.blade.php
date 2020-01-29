@extends('index')
@section('content')
<div class="card-header"> 

    {{-- si aun no hay kardex creado  --}}
    @if ($empty)
        <form  action="{{route('kardexs.create')}}" method="get">
            <button class="btn btn-primary mx-3 mt-1" id="btniniciarkardex" type="submit" >
                <h3 class="float-left">Iniciar Kardex .</h3>  
            </button>
        </form>
    @endif
    
    @if($isfirst && !$empty)
        <button class="btn btn-primary mx-3 mt-1" id="btningresarpedido"
            type="button" data-toggle="modal" data-target="#abrirmodalKardex">
            <h3 class="float-left">Ingresar Pedido .</h3>  
        </button> 
    @else 
    
        @php
            $encontrado = false;
            foreach ($kardexs as $kardex){

                if($kardex->date == $today){
                    $encontrado = true;
                }
            }
        @endphp  
        @if (!$encontrado && $last_state == 1)
            <form  action="{{route('kardexs.create')}}" method="get">
                <button class="btn btn-primary mx-3 mt-1" id="btniniciarkardex" type="submit" >
                    <h3 class="float-left">Iniciar Kardex</h3>  
                </button>
            </form>
        @endif

        @if ($encontrado)
            <button class="btn btn-primary mx-3 mt-1" id="btningresarpedido" type="button" data-toggle="modal" data-target="#abrirmodalKardex">
                <h3 class="float-left">Ingresar Pedido</h3>  
            </button>
        @endif

        @if (!$encontrado  && $last_state == 0)
            <button class="btn btn-danger mx-3 mt-1" id="btncerrarkardex" type="button" data-toggle="modal" data-target="#cerrarkardex">
                <h3 class="float-left">Cerrar Kardex</h3> 
            </button>
        @endif


    @endif
       
</div>

    <!--Inicio del modal agregar pedido-->
    <div class="modal fade" id="abrirmodalKardex" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar Pedido</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <form action="{{route('kardexs.update','test')}}" method="post" class="form-horizontal">
                        {{csrf_field()}}
                        {{method_field('patch')}}
                        @include('kardex.add')
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal agregar pedido -->


    <!--Inicio del modal de cerrar kardex-->
    <div class="modal fade" id="cerrarkardex" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary " role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">¿ Está seguro de realizar esta acción?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <h5>Al dar click en Aceptar, No se podrá deshacer esta acción.</h5>
                    <form action="{{route('kardexs.edit','test')}}" method="get">
                        {{csrf_field()}}   
                        <input type="hidden" name="id" id="id" value="">  
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Aceptar</button> 
                        </div>
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->

@endsection