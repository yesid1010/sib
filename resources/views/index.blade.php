<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Sistema Compras-Ventas con Laravel y Vue Js- webtraining-it.com">
        <meta name="keyword" content="Sistema Compras-Ventas con Laravel y Vue Js">
        <title>Proyecto</title>
        <!-- Icons -->
        <link href="vendors/css/font-awesome.min.css" rel="stylesheet">
        <link href="vendors/css/simple-line-icons.min.css" rel="stylesheet">
        <!-- Main styles for this application -->
        <link href="vendors/css/style.css" rel="stylesheet">
        <!-- DataTables -->

        <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
        {{-- <link rel="stylesheet" href="plugins/buttons/css/buttons.bootstrap4.min.css"> --}}
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    </head>

    <body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
        <!-- header -->
        @include('template.header')
        
        <div class="app-body">
            <!-- sidebar -->
            @include('template.sidebar')
            <main class="main mt-2">
                <div class="container-fluid">
              
                    <div class="card mt-2">
                        <!-- Contenido Principal -->
                        @yield('content')
                    </div>
                </div>
            </main>
        </div>

        <footer class="app-footer">
            <span class="ml-auto">Desarrollado por <a target="_blank" href="https://yesid1010.github.io/perfil/">Yesid Sánchez</a></span>
        </footer>
    
        <!-- Bootstrap and necessary plugins -->
        <script src="vendors/js/jquery.min.js"></script>
        <script src="vendors/js/popper.min.js"></script>
        <script src="vendors/js/bootstrap.min.js"></script>
        <script src="vendors/js/pace.min.js"></script>
        <!-- Plugins and scripts required by all views -->
        <script src="vendors/js/Chart.min.js"></script>
        <!-- GenesisUI main scripts -->
        <script src="vendors/js/template.js"></script>
        <!-- DataTables -->
        <script src="plugins/datatables/jquery.dataTables.js"></script>
        <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
        {{-- <script src="plugins/buttons/js/buttons.bootstrap4.min.js"></script> --}}
        <script src="vendors/js/sweetalert2.all.min.js"></script>
        <!-- scripts -->
        <script src="vendors/js/app.js"></script>
        <script src="vendors/js/modals.js"></script>
    </body>
    
</html>