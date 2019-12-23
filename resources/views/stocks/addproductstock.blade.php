<input type="hidden" name="id" id="id" value="">
<div class="form-group row">
    <div class="col-md-8">
        <select class="form-control" name="product_id" id="product_id">
            @foreach ($products as $product)
                <option value="{{$product->id}}">{{$product->name}}</option>
            @endforeach
        </select>
    </div>
    <input type="number" class="form-control col-md-3" value="1" name="quantity" id="cantidad">
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Agregar</button> 
</div>
