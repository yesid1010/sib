

$(function () {

    //tabla categorias
    $("#tablaCategorias").DataTable({
        "info"    : false,
        "ordering": false,
      
        "language":{
            "search":"Buscar",
            "emptyTable":     "No hay datos disponibles en la tabla",
            "lengthMenu":     "mostrar _MENU_ registros",
            "paginate": {
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
        }
    });

    //tablakardexdetail
    $("#tablakardexdetail").DataTable({
        "info"          : false,
        "ordering"      : false,
        "autoWidth"     : false,
       
        "language":{
            "search":"Buscar",
            "emptyTable":     "No hay datos disponibles en la tabla",
            "lengthMenu":     "mostrar _MENU_ registros",
            "paginate": {
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
        }
    });

    //tablakardexs
    $("#tablakardexs").DataTable({
        "info"          : false,
        //"lengthChange"  : false,
        "ordering": false,
        "autoWidth"      : false,
        //"scrollY"       : "250px",
        "language":{
            "search":"Buscar",
            "emptyTable":     "No hay datos disponibles en la tabla",
            "lengthMenu":     "mostrar _MENU_ registros",
            "paginate": {
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
        }
    });

    //tabla productos
    $("#tablaProductos").DataTable( {
        //"scrollY"       : "250px",
        "scrollCollapse": true,
        "info"          : false,
       // "lengthChange"  : false,
        "ordering": false,
        "language":{
            "search":"Buscar",
            "emptyTable":     "No hay datos disponibles en la tabla",
            "lengthMenu":     "mostrar _MENU_ registros",
            "paginate": {
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
        }
    });

    //tabla bares
    $("#tablaBares").DataTable({
        "info"          : false,
        "lengthChange"  : false,
        "ordering": false,
       // "scrollY"       : 250,
        responsive: true,
        "language":{
            "search":"Buscar",
            "emptyTable":     "No hay datos disponibles en la tabla",
            "lengthMenu":     "mostrar _MENU_ registros",
            "paginate": {
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
        }
        
    });

    //tabla de roles
    $("#tablaRols").DataTable({
        "info"          : false,
        "lengthChange"  : false,
        "ordering": false,
        "language":{
            "search":"Buscar",
            "emptyTable":     "No hay datos disponibles en la tabla",
            "lengthMenu":     "mostrar _MENU_ registros",
            "paginate": {
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
        }
    });

    //tabla de usuarios
    $("#tablaUsers").DataTable({
        "info"          : false,
       // "lengthChange"  : false,
        "ordering": false,
        "language":{
            "search":"Buscar",
            "emptyTable":     "No hay datos disponibles en la tabla",
            "lengthMenu":     "mostrar _MENU_ registros",
            "paginate": {
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
        }
    });

// TABLAS STOCK //
    // tabla de todos los stocks ideales
    $("#tablaStocks").DataTable({
        "info"          : false,
        "ordering": false,
        //"lengthChange"  : false,
        "language":{
            "search":"Buscar",
            "emptyTable":     "No hay datos disponibles en la tabla",
            "lengthMenu":     "mostrar _MENU_ registros",
            "paginate": {
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
        }
    });

    // tabla para mostrar un stock ideal de un bar en especifico
    $('#detallestock').DataTable({
        //"lengthChange"   : false,
        //"scrollY"        : "250px",
        "info"           : false,
        //"searching"      : false,
        "scrollCollapse" : true,
        "autoWidth"      : false,
        "ordering"       : false,
        "language":{
            "search":"Buscar",
            "emptyTable":     "No hay datos disponibles en la tabla",
            "lengthMenu":     "mostrar _MENU_ registros",
            "paginate": {
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
        }
    });

    // tabla para ingresar los detalles de un stock ideal de un bar
    tabla = $('#tablastock').DataTable({
        "info"          : false,
        "lengthChange"  : false,
        "ordering": false,
        "language":{
            "search":"Buscar",
            "emptyTable":     "No hay datos disponibles en la tabla",
            "lengthMenu":     "mostrar _MENU_ registros",
            "paginate": {
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
        }
    });

    $('#btnguardar').hide()

    //evento en el boton btnadd para ir agregrando los productos a la tabla tablastock
    counter = 0;
    $('#btnadd').on("click",function(){

        product_id  = $('#product_id').val();
        product     = $('#product_id option:selected').text()

        tabla.row.add([
            '<input type="hidden" value="'+product_id+'" name="product[]">',
            product,
            '<input type="number"  min="1"  class="form-control col-md-3 input-number" value="1" name="quantity[]">',
            '<button class="btn btn-danger" type="button">X</button>',
        ]).draw(false);
        counter++;

        if(counter > 0){
            $('#btnguardar').show()
        }else{
            $('#btnguardar').hide()
        }
    });

     // FIN TABLAS STOCK //

    // TABLAS ORDENES //
    $('#tablaOrden').DataTable({
        //"lengthChange"   : false,
        //"scrollY"        : "250px",
        "info"           : false,
        //"scrollCollapse" : true,
        "autoWidth"      : false,
        "ordering": false,
        "language":{
            "search":"Buscar",
            "emptyTable":     "No hay datos disponibles en la tabla",
            "lengthMenu":     "mostrar _MENU_ registros",
            "paginate": {
                "first":      "First",
                "last":       "Last",
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
        }
    });


    // tabla para mostrar los productos de una orden en especifico
    $('#detalleorden').DataTable({
        //"lengthChange"   : false,
        //"scrollY"        : "250px",
        "info"           : false,
        //"searching"      : false,
        //"scrollCollapse" : true,
        "autoWidth"      : false,
        "ordering": false,
        "language":{
            "search":"Buscar",
            "emptyTable":     "No hay datos disponibles en la tabla",
            "lengthMenu":     "mostrar _MENU_ registros",
            "paginate": {
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
        }
    });

     // tabla para ingresar los pedidos kardex
    tablakardex =  $('#tablakardex').DataTable({
        "info"          : false,
        "lengthChange"  : false,
        "ordering": false,
        "language":{
            "search":"Buscar",
            "emptyTable":     "No hay datos disponibles en la tabla",
            "lengthMenu":     "mostrar _MENU_ registros",
            "paginate": {
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
        }
    });
    $('#btnguardark').hide()
    countk= 0;
    $('#btnaddk').on("click",function(){
        product_idk  = $('#product_idk').val();
        productk     = $('#product_idk option:selected').text()

        tablakardex.row.add([
            '<input type="hidden" value="'+product_idk+'" name="product[]">',
            productk,
            '<input type="number" min="1" class="form-control col-md-3 input-number" value="1" name="quantity[]">',
            '<button class="btn btn-danger" type="button">X</button>',
        ]).draw(false);
        countk++;

        if(countk > 0){
            $('#btnguardark').show()
        }else{
            $('#btnguardark').hide()
        }
    });

    // tabla para ingresar los detalles de un stock ideal de un bar
    tablaorders = $('#tablaorders').DataTable({
        "info"          : false,
        "lengthChange"  : false,
        "ordering": false,
        "language":{
            "search":"Buscar",
            "emptyTable":     "No hay datos disponibles en la tabla",
            "lengthMenu":     "mostrar _MENU_ registros",
            "paginate": {
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
        }
    });
    

    $('#btnguardarorden').hide()

    countorden = 0;
    $('#btnaddorden').on("click",function(){

        producto = document.getElementById('product_idorden').value.split('_');
        cantidad = $('#cantidad').val();
        product_idorden  = producto[0];
        stock = producto[1];

        if(parseInt(cantidad) > parseInt(stock)){
            Swal.fire({
                type: 'error',
                //title: 'Oops...',
                text: 'La cantidad escogida supera el stock',
            
                })
        }else{
            productorden = $('#product_idorden option:selected').text()

            tablaorders.row.add([
                '<input type="hidden" value="'+product_idorden+'" name="product[]">',
                productorden,
                '<input type="number" min="1"  readonly="readonly" class="form-control col-md-3" value="'+cantidad+'" name="quantity[]">',
                '<button class="btn btn-danger" type="button">X</button>',
            ]).draw(false);
            countorden++;
    
            if(countorden > 0){
                $('#btnguardarorden').show()
            }else{
                $('#btnguardarorden').hide()
            }
        }
    });

    // FIN TABLAS ORDENES //

});

    //eliminar fila seleccionada por el button eliminar en la tabla tabla stock
    $('#tablastock tbody').on( 'click', 'button', function () {
        tabla
            .row( $(this).parents('tr') )
            .remove()
            .draw();
    });

    //eliminar fila seleccionada por el button eliminar en la tabla tabla ordenes
    $('#tablaorders tbody').on( 'click', 'button', function () {
        tablaorders
            .row( $(this).parents('tr') )
            .remove()
            .draw();
    });

    //eliminar fila seleccionada por el button eliminar en la tabla tabla kardex
    $('#tablakardex tbody').on( 'click', 'button', function () {
        tablakardex
            .row( $(this).parents('tr') )
            .remove()
            .draw();
    });



$('#product_idorden').change(mostrarvalores);

function mostrarvalores(){
    datosproducto = document.getElementById('product_idorden').value.split('_');
    $("#stock").val(datosproducto[1]);
}

$('.input-number').on('input', function () { 
    this.value = this.value.replace(/[^0-9]/g,'');
});

$(".alert").fadeOut(5000 );