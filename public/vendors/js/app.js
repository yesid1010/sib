$(function () {
    $("#tablaCategorias").DataTable();
    $("#tablaProductos").DataTable();
    $("#tablaBares").DataTable();
    $("#tablaRols").DataTable();
    $("#tablaUsers").DataTable();
    $("#tablStock").DataTable();


    $('#password').val('');

   
});

$('#abrirmodalEditarProducto').on('show.bs.modal',function(event){
    var button = $(event.relatedTarget)
    var name_modal_editar = button.data('name')
    var unity_modal_editar = button.data('unity')
    var three_quarters_modal_editar = button.data('three_quarters')
    var half_modal_editar = button.data('half')
    var quater_modal_editar = button.data('quater')
    var category_id_modal_editar = button.data('category_id')
    var user_id_modal_editar = button.data('user_id')
    var id = button.data('id')

    var modal = $(this)

    modal.find('.modal-body #name').val(name_modal_editar);
    modal.find('.modal-body #unity').val(unity_modal_editar);
    modal.find('.modal-body #three_quarters').val(three_quarters_modal_editar);
    modal.find('.modal-body #half').val(half_modal_editar);
    modal.find('.modal-body #quater').val(quater_modal_editar);
    modal.find('.modal-body #category_id').val(category_id_modal_editar);
    modal.find('.modal-body #user_id').val(user_id_modal_editar);
    modal.find('.modal-body #id').val(id);

})

$('#abrirmodalEditar').on('show.bs.modal',function(event){
    var button = $(event.relatedTarget)
    var name_modal_editar = button.data('name')
    var description_modal_editar = button.data('description')
    var id = button.data('id')

    var modal = $(this)

    modal.find('.modal-body #name').val(name_modal_editar);
    modal.find('.modal-body #description').val(description_modal_editar);
    modal.find('.modal-body #id').val(id);

})

$('#abrirmodalEditarBar').on('show.bs.modal',function(event){
    var button = $(event.relatedTarget)
    var name_modal_editarBar = button.data('name')
    var description_modal_editarBar = button.data('description')
    var id = button.data('id')

    var modal = $(this)

    modal.find('.modal-body #name').val(name_modal_editarBar);
    modal.find('.modal-body #description').val(description_modal_editarBar);
    modal.find('.modal-body #id').val(id);

})

$('#abrirmodalEditarRol').on('show.bs.modal',function(event){
    var button = $(event.relatedTarget)
    var name_modal_editarRol = button.data('name')
    var description_modal_editarRol = button.data('description')
    var id = button.data('id')

    var modal = $(this)

    modal.find('.modal-body #name').val(name_modal_editarRol);
    modal.find('.modal-body #description').val(description_modal_editarRol);
    modal.find('.modal-body #id').val(id);

})

$('#abrirmodalEditarUser').on('show.bs.modal',function(event){
    var button = $(event.relatedTarget)
    var identification_modal_editarUser = button.data('identification')
    var names_modal_editarUser = button.data('names')
    var surnames_modal_editarUser = button.data('surnames')
    var email_modal_editarUser = button.data('email')
    var rol_id_modal_editarUser = button.data('role_id')
    var id = button.data('id')

    var modal = $(this)

    modal.find('.modal-body #identification').val(identification_modal_editarUser);
    modal.find('.modal-body #names').val(names_modal_editarUser);
    modal.find('.modal-body #surnames').val(surnames_modal_editarUser);
    modal.find('.modal-body #email').val(email_modal_editarUser);
    modal.find('.modal-body #role_id').val(rol_id_modal_editarUser);
    modal.find('.modal-body #id').val(id);
    modal.find('.modal-body #password').val('');
})

$('#abrirmodalPassword').on('show.bs.modal',function(event){
    var button = $(event.relatedTarget)
    var id = button.data('id')

    var modal = $(this)
    modal.find('.modal-body #id').val(id);

})


$('#abrirmodalActualizarPassword').on('show.bs.modal',function(event){
    var button = $(event.relatedTarget)
    var id = button.data('id')

    var modal = $(this)
    modal.find('.modal-body #id').val(id);

})


$('#abrirmodalAgregarProducto').on('show.bs.modal',function(event){
    var button = $(event.relatedTarget)
    var id = button.data('id')

    var modal = $(this)
    modal.find('.modal-body #id').val(id);

})

$(".alert").fadeOut(6000 );