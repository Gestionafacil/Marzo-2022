<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('img/media/logos/LOGO-PNG-SOLO.png') }}">
    <!-- Google Font: Source Sans Pro -->
    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> --}}
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    {{-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> --}}
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <link href="{{ asset('preconfig-css/app.estilo.css') }}" rel="stylesheet">
    <link href="{{ asset('css/Dashboard.css') }}" rel="stylesheet">
    {{-- Efecto de carga --}}
    <link rel="stylesheet" href="{{ asset('css/efecto_carga.css') }}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.css') }}">

    <!-- DataTables -->
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buttons.dataTables.min.css') }}">

    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('css/application.css') }}">
    <link rel="stylesheet" href="{{ asset('css/CheckStyle.css') }}">
    <!-- bootstrap selector -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap-chosen.css') }}">
</head>

<body class="hold-transition sidebar-mini">

    {{-- Efecto de carga --}}
    <div class="loading show" id="spinLoad" style="display: none;">
        <div class="spin"></div>
    </div>

    @if (current_plan()->dias_restantes <= 15)
        <div id="covid-bar" class="covid-bar bg-success">
            <i class="fa fa-calendar-alt"></i>
            Te quedan {{ current_plan()->dias_restantes }} día(s) en la versión {{ current_plan()->nombre }}.
            Después podrás seleccionar el plan que desees
            <span id="buttonCovid"></span>
        </div>
    @endif
    <div class="wrapper">
        <!-- logo inicial  -->
        @if (session('logoStatus'))
            <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__shake" src="{{ asset('dist/img/logo.png') }}" alt="Logo" height="60"
                    width="60">
            </div>
        @endif
        <!--  Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a></li>
                <li class="nav-item d-none d-sm-inline-block"><a href="index.php" class="nav-link"></a></li>
                <li class="nav-item d-none d-sm-inline-block"><a href="#" class="nav-link"></a></li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-question-circle"></i> Ayuda</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-envelope"></i> Soporte</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-primary">+99</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"
                        style="left: inherit;right: 0px; overflow-y: scroll;height: 300px;">
                        <span class="dropdown-item dropdown-header text-bold">Notificaciones</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <p class="font-wight-light" style="font-size: 13px;">Lorem, ipsum dolor sit amet consectetur
                                adipisicing elit. Ad, laudantium?</p>
                        </a>
                        <a href="#" class="dropdown-item">
                            <p class="font-wight-light" style="font-size: 13px;">Lorem, ipsum dolor sit amet consectetur
                                adipisicing elit. Ad, laudantium?</p>
                        </a>
                        <a href="#" class="dropdown-item">
                            <p class="font-wight-light" style="font-size: 13px;">Lorem, ipsum dolor sit amet consectetur
                                adipisicing elit. Ad, laudantium?</p>
                        </a>
                        <a href="#" class="dropdown-item">
                            <p class="font-wight-light" style="font-size: 13px;">Lorem, ipsum dolor sit amet consectetur
                                adipisicing elit. Ad, laudantium?</p>
                        </a>
                        <a href="#" class="dropdown-item">
                            <p class="font-wight-light" style="font-size: 13px;">Lorem, ipsum dolor sit amet consectetur
                                adipisicing elit. Ad, laudantium?</p>
                        </a>
                        <a href="#" class="dropdown-item">
                            <p class="font-wight-light" style="font-size: 13px;">Lorem, ipsum dolor sit amet consectetur
                                adipisicing elit. Ad, laudantium?</p>
                        </a>
                        <a href="#" class="dropdown-item">
                            <p class="font-wight-light" style="font-size: 13px;">Lorem, ipsum dolor sit amet consectetur
                                adipisicing elit. Ad, laudantium?</p>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer text-primary">Mostrar todas</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#"><i class="far fa-user"></i></a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header text-bold">Cuenta</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="far fa-user"></i>
                            {{-- {{ Auth::user()->email }} --}}
                            {{ current_user()->email }}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item"><i class="nav-icon fas fa-tachometer-alt"></i> Consumo del
                            plan</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item"><i class="fas fa-cogs"></i> Configuración</a>
                        <a href="#" class="dropdown-item"><i class="fas fa-users-cog"></i> Mi perfil</a>
                        <a href="{{ route('salir', []) }}" id="cerraSesion" class="dropdown-item"><i
                                class="fas fa-sign-out-alt"></i> Salir</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">Gestiona facil</a>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link" data-widget="fullscreen" href="#" role="button"><i
                            class="fas fa-expand-arrows-alt"></i></a></li>
            </ul>
        </nav>
        <aside class="main-sidebar  elevation-4">
            <!-- Brand Logo -->
            <!-- Sidebar -->
            <div class="sidebar nas">
                <!-- Sidebar user panel (optional) -->
                <div class="brand-link">
                    <img src="{{ asset('dist/img/favicon-blanco.png') }}" alt="Logo" class="brand-image img">
                    <span class="brand-text font-weight-light"> Gestiona Facil</span>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                        <li class="nav-item"><a href="{{ route('Dashboard', []) }}" class="nav-link"><i
                                    class="nav-icon fas fa-home"></i>
                                <p>INICIO</p>
                            </a></li>
                        <li class="nav-item">
                            <a href="#" class="nav-link"><i class="nav-icon fas fa-plus-square"></i><p>INGRESOS<i class="nav-icon right fas fa-angle-left"></i></p></a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><a href="{{ route('facturaVenta', []) }}" class="nav-link"><p>Facturas de ventas</p></a></li>
                                <li class="nav-item"><a href="#" class="nav-link"><p>Facturas globales</p></a></li>
                                <li class="nav-item"><a href="{{ route('facturaFrecuente', []) }}" class="nav-link"><p>Facturas frecuente</p></a></li>
                                <li class="nav-item"><a href="{{ route('pagoRecibido', []) }}" class="nav-link"><p>Pagos recibidos</p></a></li>
                                <li class="nav-item"><a href="#" class="nav-link"><p>Notas de crédito</p></a></li>
                                <li class="nav-item"><a href="#" class="nav-link"><p>Cotizaciones</p></a></li>
                                <li class="nav-item"><a href="#" class="nav-link"><p>Remisiones</p></a></li>
                                {{--<li class="nav-item"><a href="#" class="nav-link"><p>Puntos de venta</p></a></li>--}}
                            </ul> 
                        </li>
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link"><i class="nav-icon fas fa-minus-square"></i><p>GASTOS<i class="nav-icon fas fa-angle-left right"></i></p></a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><a href="#" class="nav-link"><p>Facturas Proveedores</p></a></li>
                                <li class="nav-item"><a href="#" class="nav-link"><p>Pagos</p></a></li>
                                <li class="nav-item"><a href="#" class="nav-link"><p>Pagos frecuentes</p></a></li>
                                <li class="nav-item"><a href="#" class="nav-link"><p>Notas débito</p></a></li>
                                <li class="nav-item"><a href="#" class="nav-link"><p>Buzón de correo</p></a></li>
                                <li class="nav-item"><a href="#" class="nav-link"><p>Órdenes de compra</p></a></li>
                            </ul>
                        </li> --}}
                        @if (Auth::user()->tieneRol(['admin', 'vendedor']))
                            <li class="nav-item">
                                <a href="#" class="nav-link"><i class="nav-icon fas fa-user-friends"></i>
                                    <p>CONTACTOS<i class="nav-icon right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item"><a href="{{ route('ContactoTodos', []) }}" class="nav-link">
                                            <p>Todos</p>
                                        </a></li>
                                    <li class="nav-item"><a href="{{ route('ContactoCliente', []) }}"
                                            class="nav-link">
                                            <p>Clientes</p>
                                        </a></li>
                                    <li class="nav-item"><a href="{{ route('ContactoProveedor', []) }}"
                                            class="nav-link">
                                            <p>Proveedores</p>
                                        </a></li>
                                    {{-- <li class="nav-item"><a href="#" class="nav-link"><p>Solicitudes de actualización</p></a></li> --}}
                                </ul>
                            </li>
                        @endif
                        @if (Auth::user()->tieneRol('admin'))
                            <li class="nav-item">
                                <a href="#" class="nav-link"><i class="nav-icon fas fa-th"></i>
                                    <p>INVENTARIO<i class="nav-icon fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item"><a href="{{ route('producto', []) }}" class="nav-link">
                                            <p>Productos de venta</p>
                                        </a></li>
                                    <li class="nav-item"><a href="{{ route('InventarioValor', []) }}" class="nav-link">
                                            <p>Valor de inventario</p>
                                        </a></li>
                                    <li class="nav-item"><a href="{{ route('ajuste', []) }}" class="nav-link">
                                            <p>Ajustes de inventario</p>
                                        </a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">
                                            <p>Gestión de items</p>
                                        </a></li>
                                    <li class="nav-item"><a href="{{ route('listaPrecio', []) }}" class="nav-link">
                                            <p>Lista de precios</p>
                                        </a></li>
                                    <li class="nav-item"><a href="{{ route('Almacen', []) }}" class="nav-link">
                                            <p>Almacenes</p>
                                        </a></li>
                                    <li class="nav-item"><a href="{{ route('Categoria', []) }}" class="nav-link">
                                            <p>Categorías</p>
                                        </a></li>
                                    <li class="nav-item"><a href="{{ route('Atributo', []) }}" class="nav-link">
                                            <p>Atributos</p>
                                        </a></li>
                                </ul>
                            </li>
                        @endif
                        <li class="nav-item"><a href="{{ route('Banco', []) }}" class="nav-link"><i
                                    class="nav-icon fas fa-university"></i>
                                <p>BANCOS</p>
                            </a></li>
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link"><i class="nav-icon fas fa-calculator"></i><p>CONTABILIDAD<i class="nav-icon fas fa-angle-left right"></i></p></a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><a href="#" class="nav-link"><p>Catálogo de cuentas</p></a></li>
                                <li class="nav-item"><a href="#" class="nav-link"><p>Ajustes contables</p></a></li>
                                <li class="nav-item"><a href="#" class="nav-link"><p>Pólizas contables</p></a></li>
                                <li class="nav-item"><a href="#" class="nav-link"><p>Reportes contables</p></a></li>
                            </ul>
                        </li> --}}
                        {{-- <li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon fas fa-chart-bar"></i><p>REPORTES</p></a></li>
                        <li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon fas fa-cash-register"></i><p>TPV</p></a></li>
                        <li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon fas fa-store"></i><p>TIENDA EN LÍNEA</p></a></li> --}}
                        @if (Auth::user()->tieneRol('admin'))
                            <li class="nav-item"><a href="{{ route('Configuracion', []) }}" class="nav-link"><i
                                        class="nav-icon fas fa-cogs"></i>
                                    <p>CONFIGURACIÓN</p>
                                </a></li>
                        @endif
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <div class="content-wrapper">
            <section class="content">
                <br>
                <div id="app">
                    @yield('content')
                </div>
            </section>
        </div>
        <footer class="main-footer">
            <strong>Copyright &copy; 2021 <a href="{{ route('Dashboard', []) }}">Gestion Facil</a>.</strong>
            Todos los derechos reservados.
        </footer>
    </div>
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
    </script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->

    <!-- DataTables -->
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/jszip.min.js') }}"></script>
    <script src="{{ asset('js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/chosen.jquery.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    <script src="{{ asset('js/sweetalert2@10.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/application.js') }}"></script>
    @yield('script')
</body>

</html>
