
<hr>
<div class="form-group row">
    <label class="col-md-2 form-control-label" for="unity">Producto : </label>
    <div class="col-md-4">
        <select class="form-control" name="product_id[]" id="product_idk">
            @foreach ($products as $product)
                <option value="{{$product->id}}">{{$product->name}}</option>
            @endforeach
        </select>
    </div>
    <button class="btn btn-success col-md-1" id="btnaddk" type="button">
        <i class="fa fa-plus "></i>
    </button>
</div>

<hr>

    <table id="tablakardex" class="table">
        <thead class="bg-info">
            <tr>
                <th class="text-center"></th>
                <th  class="text-center">Producto</th>
                <th  class="text-center">unidades</th>
                {{-- <th  class="text-center">3/4</th>
                <th  class="text-center">1/2</th>
                <th  class="text-center">1/4</th> --}}
                <th  class="text-center">Quitar</th>
            </tr>
        </thead>
        <tbody>


        </tbody>

    </table>
    


<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
    <button type="submit" id="btnguardark" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button> 

</div>