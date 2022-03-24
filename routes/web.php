<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Grupo de rutas para evitar que un usuario logueado acceda a ellas */

//use GestionaFacil\Http\Controllers\AtributoController;

Route::group(['middleware' => ['guest']], function () {

    /* Bienvenido */
    Route::get('/', function () {return view('welcome'); })->name('Bienvenido');

    /* Autenticar */
    Route::get('autenticar', 'AuthController@getAutenticar')->name('login');
    Route::post('autenticar', 'AuthController@postAutenticar')->name('AutenticarUsuario');
    /* Registrar */
    Route::get('registrar', 'AuthController@getRegistrar')->name('Registrar');
    Route::post('registrar', 'AuthController@postRegistrar')->name('UsuarioCrear');
    /* Verificar */
    Route::get('verificar/{token}', 'AuthController@verificar');
    /** contacto registro */
    Route::get('autenticar/contacto', 'contactoRegController@getContactoReg')->name('contacto');
});

/* Grupo de rutas para que solo usuarios logueado accedan a ellas */
Route::group(['middleware' => ['auth']], function () {
   
    Route::get('salir', 'AuthController@salir')->name('salir');

    /* Configuracion | Plan no necesario */
    Route::get('configuracion/perfil', 'ConfiguracionController@getPerfil')->name('Perfil');
    Route::post('configuracion/perfil', 'ConfiguracionController@postPerfil');
    
    /* Suscripción */
    Route::get('configuracion/suscripcion', 'ConfiguracionController@getSuscripcion')->name('Suscripcion');

    /* Grupo de rutas para validar el plan con el cual el usuario se ha autentificado */
    Route::group(['middleware' => ['plan']], function(){
        /* Dashboard */
        Route::get('dashboard', 'DashboardController@index')->name('Dashboard');

        Route::group(['middleware' => ['role:admin']], function(){
            /* Configuración | Plan necesario */
            Route::get('configuracion', 'ConfiguracionController@index')->name('Configuracion');
            Route::get('configuracion/centroCostos', 'ConfiguracionController@getCentroCostos')->name('CentroCostos');
            Route::post('configuracion/centroCostos', 'ConfiguracionController@postCentroCostos');
            Route::get('configuracion/usuario', 'ConfiguracionController@getUsuario')->name('Usuario');
            Route::post('configuracion/usuario', 'ConfiguracionController@postUsuario');
            Route::get('configuracion/empresa', 'ConfiguracionController@getEmpresa')->name('Empresa');
            Route::post('configuracion/empresa', 'ConfiguracionController@postEmpresa');
            Route::get('configuracion/impuesto', 'ConfiguracionController@getImpuesto')->name('Impuesto');
            Route::post('configuracion/impuesto', 'ConfiguracionController@postImpuesto')->name('ImpuestoCrear');
            Route::post('configuracion/parametro/{id}', 'ConfiguracionController@postParametro')->name('ParametroGuardar');
            /* Lista de precios */
            Route::get('configuracion/listaPrecio', 'ConfiguracionController@listaPrecio')->name('listaPrecio');
            Route::get('configuracion/listadoDescripcion/{parametro_id}', 'ConfiguracionController@listadoDescripcion');
            Route::post('configuracion/descripcion/cambiarEstado', 'ConfiguracionController@cambiarEstado');
            Route::post('configuracion/descripcion/eliminar', 'ConfiguracionController@eliminarDescripcion');
        });

        /* Contacto */
        Route::get('contacto/todos', 'ContactoController@todos')->name('ContactoTodos');
        Route::get('contacto/nuevo', 'ContactoController@getContacto')->name('ContactoNuevo');
        Route::post('contacto/nuevo', 'ContactoController@postContacto');
        Route::get('contacto/vista/{id}', 'ContactoController@getVista')->name('ContactoVista');
        Route::get('contacto/cliente', 'ContactoController@getCliente')->name('ContactoCliente');
        Route::get('contacto/proveedor', 'ContactoController@getProveedor')->name('ContactoProveedor');
        Route::get('contacto/listado', 'ContactoController@listado');
        Route::post('contacto/vendedor', 'ContactoController@postVendedor');
        
        Route::get('contacto/editar/{id}', 'ContactoController@getEditar')->name('ContactoEditar');
        Route::post('contacto/editar', 'ContactoController@postEditar');
        Route::post('contacto/cambiarEstado', 'ContactoController@cambiarEstado');
        Route::post('contacto/eliminar', 'ContactoController@eliminar');
        
        Route::post('contacto/obtenerContactoID', 'ContactoController@obtenerContactoID');
        Route::post('contacto/personasAsociadas', 'ContactoController@obtenerContactoPersonasAsociadas');

        /**Inventario|  */
        Route::get('inventario/producto', 'ProductoController@producto')->name('producto');
        Route::get('inventario/producto/listado', 'ProductoController@listado');
        Route::post('inventario/producto/cambiarEstado', 'ProductoController@cambiarEstado');
        Route::get('inventario/producto/eliminar', 'ProductoController@eliminar');
        Route::post('inventario/producto/nuevo', 'ProductoController@postProducto');
        Route::get('inventario/nuevo_producto', 'ProductoController@getProducto')->name('productoNuevo');
        Route::get('inventario/producto/listado/ajuste', 'AjusteController@listadoAjuste');
        Route::get('inventario/producto/editar/{id}', 'ProductoController@loadProducto');
        Route::get('inventario/producto/detalle/{id}', 'ProductoController@vistaProducto');
        Route::get('inventario/atributo/sat', 'AtributoController@obtenerSat');
        Route::get('inventario/valor', 'ProductoController@valor')->name('InventarioValor');
        Route::get('inventario/valor/listado', 'ProductoController@ListadoValor');
        Route::get('inventario/producto/{id}', 'ProductoController@datosProducto');
        Route::get('inventario/producto/sin/id', 'ProductoController@datosProductoSinId'); 
        Route::get('inventario/producto/list', "ProductoController@listProducto");
        /**Ajuste de inventario  */
        Route::get('inventario/ajuste', 'AjusteController@ajuste')->name('ajuste');
        Route::get('inventario/ajuste/listado', 'AjusteController@listado');
        Route::post('inventario/ajuste/cambiarEstado', 'AjusteController@cambiarEstado');
        Route::post('inventario/ajuste/eliminar', 'AjusteController@eliminar');
        Route::get('inventario/ajuste/nuevo', 'AjusteController@getAjusteInventario')->name('ajusteNuevo');
        Route::post('inventario/ajuste/nuevo', 'AjusteController@postAjusteInventario');
        Route::get('ajuste/detalle/{id}', 'AjusteController@detalle');
        /* Banco */
        Route::get('bancos', 'BancoController@index')->name('Banco');
        Route::get('bancos/listado', 'BancoController@listado');
        Route::get('bancos/nuevo', 'BancoController@getNuevo')->name('NuevoBanco');
        Route::post('bancos/nuevo', 'BancoController@postNuevo');
        Route::get('bancos/detalle/{id}', 'BancoController@detalle')->name('DetalleBanco');
        Route::get('bancos/editar/{id}', 'BancoController@getEditar')->name('EditarBanco');
        Route::post('bancos/cambiarEstado', 'BancoController@cambiarEstado');
        Route::post('bancos/eliminar', 'BancoController@eliminar');
        Route::get('bancos/{id}', 'BancoController@bancoId');
        Route::get('bancos/conciliar/{id}', 'BancoController@getConciliar');

        /* Almacen */
        Route::get('almacen', 'AlmacenController@index')->name('Almacen');
        Route::get('almacen/listado', 'AlmacenController@listado');
        Route::post('almacen/guardar', 'AlmacenController@guardar');
        Route::post('almacen/cambiarEstado', 'AlmacenController@cambiarEstado');
        Route::post('almacen/eliminar', 'AlmacenController@eliminar');

        /* Categorias */
        Route::get('categoria', 'CategoriaController@index')->name('Categoria');
        Route::get('categoria/listado', 'CategoriaController@listado');
        Route::post('categoria/guardar', 'CategoriaController@guardar');
        Route::post('categoria/cambiarEstado', 'CategoriaController@cambiarEstado');
        Route::post('categoria/eliminar', 'CategoriaController@eliminar');

        /* Atributo */
        Route::get('atributo', 'AtributoController@index')->name('Atributo');
        Route::get('atributo/variante', 'AtributoController@variante')->name('AtributoVariante');
        Route::post('atributo/variante', 'AtributoController@postVariante');
        Route::get('atributo/campo', 'AtributoController@campo')->name('AtributoCampo');
        Route::get('atributo/variante/listado', 'AtributoController@varianteListado');
        Route::post('atributo/variante/cambiarEstado', 'AtributoController@cambiarEstado');
        Route::post('atributo/variante/eliminar', 'AtributoController@eliminar');
        Route::get('atributo/campo/listado', 'AtributoController@campoListado');
        Route::post('atributo/campo', 'AtributoController@postCampo');
        Route::get('atributo/SAT', 'AtributoController@listadoSat');

        /* Facturación */
        Route::get('factura/venta', 'Factura\FacturaVentaController@index')->name('facturaVenta');
        Route::get('factura/venta/nueva', 'Factura\FacturaVentaController@facturaNueva')->name('nuevaFacturaVenta');
        Route::get('factura/listado', 'Factura\FacturaVentaController@listarFactura');
       /* Facturación Frecuente */
        Route::get('factura/frecuente', 'Factura\FacturaFrecuenteController@index')->name('facturaFrecuente');
        Route::get('factura/frecuente/nueva', 'Factura\FacturaFrecuenteController@facturaFrecuenteNueva')->name('nuevaFacturaFrecuente');
        /* Facturación Frecuente */
        Route::get('factura/pago/recibido', 'Factura\PagoRecibidoController@index')->name('pagoRecibido');
        Route::get('factura/pago/recibido/nueva', 'Factura\PagoRecibidoController@pagoRecibido')->name('nuevaPagoRecibido');

        /* Guardar factura */
        Route::post('factura/guardar', 'Factura\FacturaVentaController@guardarFactura');
        Route::post('factura/cancelar', 'Factura\FacturaVentaController@cancelarFactura');

        /* Mostrar e imprimir factura */
        Route::get('factura/vista/{id}/{action}', 'Factura\FacturaVentaController@print')->name('printInvoice');
    });
    
});