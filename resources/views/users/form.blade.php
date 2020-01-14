<div class="form-group row">
    <label class="col-md-4 form-control-label" for="unity">Identificación : </label>
    <div class="col-md-8">
        <input type="number" name="identification" id="identification" required class="form-control" >    
    </div>
</div>
<div class="form-group row">
        <label class="col-md-4 form-control-label" for="unity">Nombres : </label>
    <div class="col-md-8">
            <input type="text" name="names" id="names" required class="form-control">    
    </div>
</div>
<div class="form-group row">
        <label class="col-md-4 form-control-label" for="unity">Apellidos : </label>
    <div class="col-md-8">
            <input type="text" name="surnames" id="surnames"  required class="form-control">    
    </div>
</div>

<div class="form-group row">
    <label class="col-md-4 form-control-label" for="unity">Correo : </label>
    <div class="col-md-8">
        <input type="email" name="email" id="email" required class="form-control">    
    </div>
</div>

<div class="form-group row">
    <label class="col-md-4 form-control-label" for="unity">Rol : </label>
    <div class="col-md-8">
        <select class="form-control" name="role_id" id="role_id">
            @foreach ($roles as $role)
                <option value="{{$role->id}}">{{$role->name}}</option>
            @endforeach
        </select>
    </div>
</div>
<!--
<div class="form-group row" id="pass">
        <label class="col-md-4 form-control-label" for="unity">Contraseña : </label>
    <div class="col-md-8">
            <input type="password" name="password" id="password" class="form-control">    
    </div>
</div>
-->


<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button> 
</div>