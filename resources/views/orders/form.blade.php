
<div class="form-group row">
    <label class="col-md-2 form-control-label" for="unity">Bar : </label>
    <div class="col-md-4">
        <select class="form-control" name="pub_id" id="pub_id">
            @foreach ($pubs as $pub)
                <option value="{{$pub->id}}">{{$pub->name}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-2 form-control-label" for="unity">Barman : </label>
    <div class="col-md-4">
        <select class="form-control" name="user_id" id="user_id">
            @foreach ($users as $user)
                <option value="{{$user->id}}">{{$user->names}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label class="col-md-2 form-control-label" for="des">Descripción</label>
    <div class="col-md-8">
        <textarea  name="description" id="description" rows ="2" class="form-control" placeholder="Ingrese descripcion"></textarea>
    </div>
</div>
<hr>
<div class="form-group row">
    <label class="col-md-2 form-control-label" for="unity">Producto : </label>
    <div class="col-md-4">
        <select class="form-control" name="product_id[]" id="product_id">
            @foreach ($products as $product)
                <option value="{{$product->id}}">{{$product->name}}</option>
            @endforeach
        </select>
    </div>
    <button class="btn btn-success col-md-1" id="btnadd" type="button">
        <i class="fa fa-plus "></i>
    </button>
</div>

<hr>

    <table id="tablaorders" class="table">
        <thead class="bg-info">
            <tr>
                <th class="text-center"></th>
                <th  class="text-center">Producto</th>
                <th  class="text-center">unidades</th>
                <th  class="text-center">3/4</th>
                <th  class="text-center">1/2</th>
                <th  class="text-center">1/4</th>
                <th  class="text-center">Quitar</th>
            </tr>
        </thead>
        <tbody>


        </tbody>

    </table>
    


<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
    <button type="submit" id="btnguardar" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button> 

</div>