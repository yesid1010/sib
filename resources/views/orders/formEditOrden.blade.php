
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="unity">Bar : </label>
    <div class="col-md-8">
        <select class="form-control" name="pub_id" id="pub_id">
            @foreach ($pubs as $pub)
                <option value="{{$pub->id}}">{{$pub->name}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="unity">Barman : </label>
    <div class="col-md-8">
        <select class="form-control" name="user_id" id="user_id">
            @foreach ($users as $user)
                <option value="{{$user->id}}">{{$user->names}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="des">Descripción :</label>
    <div class="col-md-8">
        <textarea  name="description" id="description" rows ="3" class="form-control" placeholder="Ingrese descripcion"></textarea>
    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
    <button type="submit" id="btnguardarorden" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button> 
</div>