
// evento para agregar los detalles de un producto al formulario para poder editarlo
$('#abrirmodalEditarProducto').on('show.bs.modal',function(event){
    var button                       = $(event.relatedTarget)
    var name_modal_editar            = button.data('name')
    var unity_modal_editar           = button.data('unity')
    // var three_quarters_modal_editar  = button.data('three_quarters')
    // var half_modal_editar            = button.data('half')
    // var quater_modal_editar          = button.data('quater')
    var category_id_modal_editar     = button.data('category_id')
    var user_id_modal_editar         = button.data('user_id')
    var id                           = button.data('id')

    var modal = $(this)

    modal.find('.modal-body #name').val(name_modal_editar);
    modal.find('.modal-body #unity').val(unity_modal_editar);
    // modal.find('.modal-body #three_quarters').val(three_quarters_modal_editar);
    // modal.find('.modal-body #half').val(half_modal_editar);
    // modal.find('.modal-body #quater').val(quater_modal_editar);
    modal.find('.modal-body #category_id').val(category_id_modal_editar);
    modal.find('.modal-body #user_id').val(user_id_modal_editar);
    modal.find('.modal-body #id').val(id);

})

// evento para agregar los detalles de una categoria al formulario para poder editarlo
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

// evento para agregar los detalles de un bar al formulario para poder editarlo
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

// evento para agregar los detaller de un rol al formulario para poder editarlo
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

// evento para agregar los detaller de un usuario al formulario para poder editarlo
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


// evento para  editar una orden
$('#abrirmodalEditarOrden').on('show.bs.modal',function(event){
    var button                   = $(event.relatedTarget)
    var description_modal_editar = button.data('description')
    var pub_id_modal_editar      = button.data('pub_id')
    var user_id_modal_editar     = button.data('user_id')
    var id                       = button.data('id')

    var modal = $(this)

    modal.find('.modal-body #description').val(description_modal_editar);
    modal.find('.modal-body #pub_id').val(pub_id_modal_editar);
    modal.find('.modal-body #user_id').val(user_id_modal_editar);
    modal.find('.modal-body #id').val(id);

})

// evento para  editar un stock ideal
$('#abrirmodalEditarStock').on('show.bs.modal',function(event){
    var button                   = $(event.relatedTarget)
    var description_modal_editar = button.data('description')
    var pub_id_modal_editar      = button.data('pub_id')
    var id                       = button.data('id')

    var modal = $(this)

    modal.find('.modal-body #description').val(description_modal_editar);
    modal.find('.modal-body #pub_id').val(pub_id_modal_editar);
    modal.find('.modal-body #id').val(id);

})

// evento para traer el id de un usuario para crearle una contraseña
$('#abrirmodalPassword').on('show.bs.modal',function(event){
    var button = $(event.relatedTarget)
    var id = button.data('id')

    var modal = $(this)
    modal.find('.modal-body #id').val(id);

})

// evento para traer el id de un usuario para editarle su contraseña
$('#abrirmodalActualizarPassword').on('show.bs.modal',function(event){
    var button = $(event.relatedTarget)
    var id = button.data('id')

    var modal = $(this)
    modal.find('.modal-body #id').val(id);

})

// evento para traer el id de un producto para agregarle cantidad
$('#abrirmodalAgregarProducto').on('show.bs.modal',function(event){
    var button = $(event.relatedTarget)
    var id = button.data('id')

    var modal = $(this)
    modal.find('.modal-body #id').val(id);

})

// evento traer el id de un producto para editar su cantidad  en un stock ideal de cierto bar
$('#abrirmodalEditDetail').on('show.bs.modal',function(event){
    var button = $(event.relatedTarget)
    var id = button.data('id')
    var unity = button.data('unity')
    var modal = $(this)
    modal.find('.modal-body #id').val(id);
    modal.find('.modal-body #unity').val(unity)

})

// evento para traer el id de un stock ideal para agregarle un producto
$('#abrirmodalAddProductD').on('show.bs.modal',function(event){
    var button = $(event.relatedTarget)
    var id = button.data('id')

    var modal = $(this)
    modal.find('.modal-body #id').val(id);

})


// evento para traer el id de una orden  para agregarle un producto
$('#abrirmodalaAddProductOrder').on('show.bs.modal',function(event){
    var button = $(event.relatedTarget)
    var id = button.data('id')

    var modal = $(this)
    modal.find('.modal-body #id').val(id);

})

// evento traer el id de un producto para editar su cantidad  en una orden especifica
$('#abrirmodalEditDetailOrder').on('show.bs.modal',function(event){
    var button = $(event.relatedTarget)
    var id = button.data('id')
    var unity = button.data('unity')
    var modal = $(this)
    modal.find('.modal-body #id').val(id)
    modal.find('.modal-body #unity').val(unity)
    modal.find('.modal-body #id_an').val(unity)

})


// pruebas de modales

// evento para traer el id de un stock ideal para agregarle un producto
$('#abrirmodalEliminarProducto').on('show.bs.modal',function(event){
    var button = $(event.relatedTarget)
    var id = button.data('id')

    var modal = $(this)
    modal.find('.modal-body #id').val(id);

})

$('#abrirmodalEliminarCategoria').on('show.bs.modal',function(event){
    var button = $(event.relatedTarget)
    var id = button.data('id')

    var modal = $(this)
    modal.find('.modal-body #id').val(id);

})


$('#abrirmodalEliminarRole').on('show.bs.modal',function(event){
    var button = $(event.relatedTarget)
    var id = button.data('id')

    var modal = $(this)
    modal.find('.modal-body #id').val(id);

})


$('#abrirmodalEliminarUser').on('show.bs.modal',function(event){
    var button = $(event.relatedTarget)
    var id = button.data('id')

    var modal = $(this)
    modal.find('.modal-body #id').val(id);

})


$('#abrirmodalEliminarPub').on('show.bs.modal',function(event){
    var button = $(event.relatedTarget)
    var id = button.data('id')

    var modal = $(this)
    modal.find('.modal-body #id').val(id);

})

$('#abrirmodalEliminarStock').on('show.bs.modal',function(event){
    var button = $(event.relatedTarget)
    var id = button.data('id')

    var modal = $(this)
    modal.find('.modal-body #id').val(id);

})