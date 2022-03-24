@extends('layouts.master')
@section('title', 'Configuración')

@section('content')
    {{-- Alertas --}}
    @include('layouts.alerts')
    <div class="container-fluid">
        <img src="{{ asset('img/baseline_settings_black_24dp.png') }}" class="icon-header" alt="setting">
        <h3 class="text-secondary titleConfig">Configuración</h3>
        <hr>
        <div class="row card-list-config">
            <!-- Empresa -->
            <div class="col-lg-3 d-flex align-items-stretch">
                <div class="card">
                    <div class="card-header text-white text-center">
                        <h6>Empresa</h6>
                    </div>
                    <div class="card-body">
                        Configura la información de tu empresa y adapta Gestiona Facil a tu negocio.
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('Empresa', []) }}" class="link">Empresa</a>
                        <a href="{{ route('Usuario', []) }}" class="link">Usuarios</a>
                        <a href="{{ route('Perfil', []) }}" class="link">Mi perfil</a>
                        <a href="{{ route('CentroCostos', []) }}" class="link">Centros de costos</a>
                    </div>
                </div>
            </div>
            <!-- \Empresa -->

            <!-- Facturación -->
            {{-- <div class="col-lg-3 d-flex align-items-stretch">
                <div class="card">
                    <div class="card-header text-white text-center">
                        <h6>Facturación</h6>
                    </div>
                    <div class="card-body">
                        <p>Configura la información que se mostrará en tus facturas.</p>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="link">Términos de pago</a>
                        <a href="#" class="link">Numeraciones</a>
                        <a href="#" class="link">Datos generales</a>
                        <a href="#" class="link">Vendedores</a>
                    </div>
                </div>
            </div> --}}
            <!-- \Facturación -->

            <!-- Plantillas de impresión -->
            {{-- <div class="col-lg-3 d-flex align-items-stretch">
                <div class="card">
                    <div class="card-header text-white text-center">
                        <h6>Plantillas de impresión</h6>
                    </div>
                    <div class="card-body">
                        <p>Administra las plantillas de impresión de tus documentos.</p>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="link">Plantillas</a>
                    </div>
                </div>
            </div> --}}
            <!-- \Plantillas de impresión -->

            <!-- Impuestos -->
            <div class="col-lg-3 d-flex align-items-stretch">
                <div class="card">
                    <div class="card-header text-white text-center">
                        <h6>Impuestos</h6>
                    </div>
                    <div class="card-body">
                        <p>Define aquí los tipos de impuestos y retenciones que aplicas a tus facturas.</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('Impuesto', []) }}" class="link">Impuestos</a>
                        <a href="#" class="link">Retenciones</a>
                        {{-- <a href="#" class="link">Configuración avanzada</a> --}}
                    </div>
                </div>
            </div>
            <!-- \Impuestos -->

            <!-- Contabilidad -->
            {{-- <div class="col-lg-3 d-flex align-items-stretch">
                <div class="card">
                    <div class="card-header text-white text-center">
                        <h6>Contabilidad</h6>
                    </div>
                    <div class="card-body">
                        <p>Define opciones avanzadas para el manejo de tu contabilidad.</p>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="link">Plantillas</a>
                    </div>
                </div>
            </div> --}}
            <!-- \Contabilidad -->

            <!-- Notificaciones y correos -->
            {{-- <div class="col-lg-3 d-flex align-items-stretch">
                <div class="card">
                    <div class="card-header text-white text-center">
                        <h6>Notificaciones y correos</h6>
                    </div>
                    <div class="card-body">
                        <p>Configura las plantillas, las notificaciones del sistema y las notificaciones de
                            facturas.</p>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="link">Notificaciones</a>
                        <a href="#" class="link">Plantillas de correos</a>
                        <a href="#" class="link">Preferencias de correo</a>
                    </div>
                </div>
            </div> --}}
            <!-- \Notificaciones y correos -->

            <!-- Inventario -->
            {{-- <div class="col-lg-3 d-flex align-items-stretch">
                <div class="card">
                    <div class="card-header text-white text-center">
                        <h6>Inventario</h6>
                    </div>
                    <div class="card-body">
                        <p>Define opciones avanzadas para la creación, venta y gestión de tus productos.</p>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="link">Campos adicionales</a>
                        <a href="#" class="link">Variantes</a>
                    </div>
                </div>
            </div> --}}
            <!-- \Inventario -->

            <!-- Integraciones -->
            {{-- <div class="col-lg-3 d-flex align-items-stretch">
                <div class="card">
                    <div class="card-header text-white text-center">
                        <h6>Integraciones</h6>
                    </div>
                    <div class="card-body">
                        <p>Encuentra toda la información para que puedas integrar otros sistemas con Gestiona
                            Facil.</p>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="link">Integración manual - API</a>
                        <a href="#" class="link">Pagos en línea</a>
                        <a href="#" class="link">Zapier</a>
                    </div>
                </div>
            </div> --}}
            <!-- \Integraciones -->

            <!-- Historial -->
            {{-- <div class="col-lg-3 d-flex align-items-stretch">
                <div class="card">
                    <div class="card-header text-white text-center">
                        <h6>Historial</h6>
                    </div>
                    <div class="card-body">
                        <p>Consulta el historial de correos de facturas enviadas a clientes y operaciones
                            realizadas en la cuenta.</p>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="link">Historial de correos</a>
                        <a href="#" class="link">Historial de operaciones</a>
                    </div>
                </div>
            </div> --}}
            <!-- \Historial -->

            <!-- Punto de venta (POS) -->
            {{-- <div class="col-lg-3 d-flex align-items-stretch">
                <div class="card">
                    <div class="card-header text-white text-center">
                        <h6>Punto de venta (POS)</h6>
                    </div>
                    <div class="card-body">
                        <p>Configura la facturación en tus puntos de venta.</p>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="link">Configuración general</a>
                    </div>
                </div>
            </div> --}}
            <!-- \Punto de venta (POS) -->

            <!-- Suscripción - Planes -->
            <div class="col-lg-3 d-flex align-items-stretch">
                <div class="card">
                    <div class="card-header text-white text-center">
                        <h6>Suscripción - Planes</h6>
                    </div>
                    <div class="card-body">
                        <p>Elige el plan que quieres tener en Gestiona Facil y configura cómo quieres pagarlo.</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('Suscripcion', []) }}" class="link">Suscripción</a>
                        <a href="#" class="link">Métodos de pago</a>
                    </div>
                </div>
            </div>
            <!-- \Suscripción - Planes -->
        </div>
    </div>
@endsection

{{-- Archivos JavaScript --}}
@section('script')
    <script src="{{ asset('js/app/configuracionController.js') }}"></script>
@endsection
