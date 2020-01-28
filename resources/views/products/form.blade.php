<div class="form-group row">
    <label class="col-md-3 form-control-label" for="text-input">Producto</label>
    <div class="col-md-7">
        <input type="text" name="name" id="name" class="form-control" required placeholder="Nombre de producto">    
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="unity">unidades</label>
    <div class="col-md-3">
        <input type="number" min="1"  name="unity" id="unity" class="form-control input-number" value='1'>
    </div>
</div>

{{-- <div class="form-group row">
    <label class="col-md-3 form-control-label" for="unity">3/4 unidad</label>
    <div class="col-md-3">
        <input type="number" name="three_quarters" value="0" id="three_quarters" class="form-control" >
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="unity">1/2 unidad</label>
    <div class="col-md-3">
            <input type="number" name="half" id="half" class="form-control"  value='0'>
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="unity">1/4 unidad</label>
    <div class="col-md-3">
        <input type="number" name="quater" id="quater" class="form-control" value = '0' >
    </div>
</div> --}}


<div class="form-group row">
    <label class="col-md-3 form-control-label" for="unity">Categoría</label>
    <div class="col-md-7">
        <select class="form-control" name="category_id" id="category_id">
            @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
    </div>
</div>
   
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button> 
</div>