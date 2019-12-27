@extends('index')
@section('content')
    <div class="card-header">     
        <h3 class="float-left">Listado de Productos</h3>       
        <button class="btn btn-primary float-right mt-1" type="button" data-toggle="modal" data-target="#abrirmodalProducto">
            <i class="fa fa-plus "></i>&nbsp;&nbsp;Agregar Producto
        </button>
    </div>
    <div class="card-body">
        <table id="tablaProductos" class="table table-bordered table-striped">
            <thead class="bg-primary">
                <tr>
                    <th>Categoría</th>
                    <th>Nombre</th>
                    <th>unidades</th>
                    {{-- <th>3/4 unidad</th>
                    <th>1/2 unidad</th>
                    <th>1/4 unidad</th> --}}
                    <th>Agregar</th>
                    <th>Editar</th>
                    <th>Eliminar</th>           
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{$product->category->name}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->unity}}</td>
                        {{-- <td>{{$product->three_quarters}}</td>
                        <td>{{$product->half}}</td>
                        <td>{{$product->quater}}</td> --}}
                        <td class="text-center">
                            <button class="btn btn-dark" type="button"
                                    data-target="#abrirmodalAgregarProducto"
                                    data-toggle="modal" 
                                    title="Agregar"
                                    data-id="{{$product->id}}">
                                    <i class="fa fa-plus "></i> 
                            </button>
                                    
                        </td>
                        <td class="text-center">
                            <button class="btn btn-primary" type="button"                                             
                                    data-toggle="modal" 
                                    title="Editar"
                                    data-target="#abrirmodalEditarProducto"
                                    data-id="{{$product->id}}"
                                    data-name="{{$product->name}}"
                                    data-unity="{{$product->unity}}"
                                    data-three_quarters="{{$product->three_quarters}}"
                                    data-half="{{$product->half}}"
                                    data-quater="{{$product->quater}}"
                                    data-category_id = "{{$product->category_id}}"
                                    data-user_id = "{{$product->user_id}}">
                                    <i class="fa fa-pencil" aria-hidden="true"></i> 
                            </button>
                        </td>
                        <td class="text-center">
                            <form action="{{route('products.destroy',$product->id)}}" method="post">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger"  title="Eliminar" type="submit">
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
        <!--Inicio del modal agregar producto-->
        <div class="modal fade" id="abrirmodalProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Agregar Producto</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    
                    <div class="modal-body">
                        <form action="{{route('products.store')}}" method="post" class="form-horizontal">
                            {{csrf_field()}}
                            @include('products.form')
                        </form>
                    </div>
    
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Fin del modal agregar producto-->

        <!--Inicio del modal Editar-->
        <div class="modal fade" id="abrirmodalEditarProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Actualizar Producto</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    
                    <div class="modal-body">
                        <form action="{{route('products.update','test')}}" method="post" class="form-horizontal">
                            {{method_field('patch')}}
                            {{csrf_field()}}
    
                            <input type="hidden" name="id" id="id" value="">
                            @include('products.form')
                        </form>
                    </div>
    
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Fin del modal Editar producto-->

        <!--Inicio del modal agregar Producto por unidad-->
        <div class="modal fade" id="abrirmodalAgregarProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Agregar Producto</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    
                    <div class="modal-body">
                        <form action="{{route('addproduct')}}" method="post" class="form-horizontal">
                            {{csrf_field()}}
                            @include('products.addproduct')
                        </form>
                    </div>
    
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Fin del modal-->

    <!-- FIN MODALES -->
@endsection