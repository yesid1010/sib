<div class="form-group row">
    <label class="col-md-3 form-control-label" for="text-input">Bares</label>
    <div class="col-md-9">
        <input type="text" name="name" id="name" class="form-control" placeholder="Nombre de Bar">
        
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="des">Descripción</label>
    <div class="col-md-9">
        <textarea  name="description" id="description" rows ="3" class="form-control" placeholder="Ingrese descripcion"></textarea>
    </div>
</div>



<div class="form-group row">
  <label for="categoria" class="col-md-3 form-control-label">Tipo</label>
  <div class="col-md-9">
    <select class="form-control" name="category" id="category">
        <option value="0">Bar</option>
        <option value="1">Restaurante</option>
    </select>
  </div>
</div>


<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button> 
</div>