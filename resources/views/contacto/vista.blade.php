@extends('layouts.master')
@section('title', $contacto->nombre)
@section('content')
    <div class="row">
        <div class="col-lg-5">
            <h3 class="titleConfig"><i class="fa fa-fw fa-users text-secondary"></i>
                <span class="text-success font-weight-light">{{ $contacto->nombre }}</span>
            </h3>
        </div>
        <div class="col-lg-7">
            <button class="btn btn-xs btn-outline-secondary"><i class="fa fa-fw fa-plus"></i> Nueva factura de venta</button>
            <button class="btn btn-xs btn-outline-secondary"><i class="fa fa-fw fa-plus"></i> Nueva factura de proveedor</button>
            <a href="{{ url('contacto/editar/'.$contacto->id, []) }}" class="btn btn-xs btn-outline-secondary"><i class="fa fa-fw fa-edit"></i> Editar</a>
            <!-- Example single danger button -->
            <div class="btn-group">
                <button type="button" class="btn btn-xs btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-plus"></i>
                    Más opciones
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Desactivar contacto</a>
                  <a class="dropdown-item" href="#">Adjuntar archivo</a>
                  <a class="dropdown-item" href="#">Ver estado de cuenta</a>
                  <a class="dropdown-item" href="#">Generar enlace de estado de cuenta</a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-lg-2 border-right">
                            <label>Cuentas por cobrar</label>
                            <h3 class="text-danger">$0.00</h3>
                        </div>
                        <div class="col-lg-2 border-right">
                            <label>Anticipos recibidos</label>
                            <h3 class="text-success">$0.00</h3>
                        </div>
                        <div class="col-lg-2 border-right">
                            <label>Anticipos entregados</label>
                            <h3 class="text-secondary">$0.00</h3>
                        </div>
                        <div class="col-lg-2 border-right">
                            <label>Por pagar</label>
                            <h3 class="text-secondary">$0.00</h3>
                        </div>
                        <div class="col-lg-2 border-right">
                            <label>Notas crédito por aplicar</label>
                            <h3 class="text-danger">$0.00</h3>
                        </div>
                        <div class="col-lg-2">
                            <label>Notas débito por aplicar</label>
                            <h3 class="text-success">$0.00</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-7">
            <form action="">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="breadcrumb rounded p-2 text-center font-weight-light">Datos generales</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Tipo de tercero</label>
                                    <input type="text" class="form-control form-control-sm no-border" readonly disabled value="{{ $contacto->tipoTercero }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>RFC</label>
                                    <input type="text" class="form-control form-control-sm no-border" readonly disabled value="{{ $contacto->rfc }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control form-control-sm no-border" readonly disabled value="{{ $contacto->nombre }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Calle</label>
                                    <input type="text" class="form-control form-control-sm no-border" readonly disabled value="{{ $contacto->calle }}">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Exterior</label>
                                    <input type="text" class="form-control form-control-sm no-border" readonly disabled value="{{ $contacto->exterior }}">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Interior</label>
                                    <input type="text" class="form-control form-control-sm no-border" readonly disabled value="{{ $contacto->interior }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Colonia</label>
                                    <input type="text" class="form-control form-control-sm no-border" readonly disabled value="{{ $contacto->colonia }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Localidad</label>
                                    <input type="text" class="form-control form-control-sm no-border" readonly disabled value="{{ $contacto->localidad }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Estado</label>
                                    <input type="text" class="form-control form-control-sm no-border" readonly disabled value="{{ $contacto->estadoPersona }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>País</label>
                                    <select name="" id="" class="form-control form-control-sm no-border" readonly disabled>
                                        <option value="mexico" selected disabled>México</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Correo electrónico</label>
                                    <input type="text" class="form-control form-control-sm no-border" readonly disabled value="{{ $contacto->email }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Celular</label>
                                    <input type="text" class="form-control form-control-sm no-border" readonly disabled value="{{ $contacto->celular }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Teléfono 1</label>
                                    <input type="text" class="form-control form-control-sm no-border" readonly disabled value="{{ $contacto->telefono }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Teléfono 2</label>
                                    <input type="text" class="form-control form-control-sm no-border" readonly disabled value="{{ $contacto->telefono2 }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="breadcrumb rounded p-2 text-center font-weight-light">Archivos adjuntos</p>
                            </div>
                            <div class="col-lg-12 breadcrumb">
                                <div class="row">
                                    {{-- Aquí van los archivos --}}
                                    <div class="col-lg-12">
                                        {{-- <div class="row">
                                            <div class="col-6 text-truncate">
                                                <button type="button" class="btn btn-xs link text-danger"><i class="fa fa-times"></i></button>
                                                <a href="#" class="text-success" data-toggle="tooltip" data-placement="top" title="35364273_1360705027612090_4922817188256501573_o.jpg">
                                                    35364273_1360705027612090_4922817188256501573_o.jpg
                                                </a>
                                            </div>
                                            <div class="col-6 text-truncate">
                                                <button type="button" class="btn btn-xs link text-danger"><i class="fa fa-times"></i></button>
                                                <a href="#" class="text-success" data-toggle="tooltip" data-placement="top" title="35364273_1360705027612090_4922817188256501573_o.jpg">
                                                    35364273_1360705027612090_4922817188256501573_o.jpg
                                                </a>
                                            </div>
                                            <div class="col-6 text-truncate">
                                                <button type="button" class="btn btn-xs link text-danger"><i class="fa fa-times"></i></button>
                                                <a href="#" class="text-success" data-toggle="tooltip" data-placement="top" title="35364273_1360705027612090_4922817188256501573_o.jpg">
                                                    35364273_1360705027612090_4922817188256501573_o.jpg
                                                </a>
                                            </div>
                                        </div> --}}
                                        <div class="col-lg-12">
                                            <button type="button" class="btn btn-link"><i class="fa fa-plus-circle"></i> Haz clic para agregar más archivos</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row breadcrumb p-2 rounded">
                                <div class="col-lg-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" @if($contacto->es_cliente) checked @endif disabled id="check_cliente">
                                        <label class="form-check-label" for="check_cliente">Cliente</label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" @if($contacto->es_proveedor) checked @endif disabled id="check_proveedor">
                                        <label class="form-check-label" for="check_proveedor">Proveedor</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Tipo de operación</label>
                                <input type="text" class="form-control form-control-sm no-border" readonly disabled value="{{ $contacto->tipoOperacion }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Plazo de pago</label>
                                <input type="text" class="form-control form-control-sm no-border" readonly disabled value="{{ $contacto->plazoPago }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Vendedor</label>
                                <input type="text" class="form-control form-control-sm no-border" readonly disabled value="{{ $contacto->vendedorNombre }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Lista de precios</label>
                                <input type="text" class="form-control form-control-sm no-border" readonly disabled value="{{ $contacto->listaPrecio }}">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Método de pago</label>
                                <input type="text" class="form-control form-control-sm no-border" readonly disabled value="{{ $contacto->metodoPago }}">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Forma de pago</label>
                                <input type="text" class="form-control form-control-sm no-border" readonly disabled value="{{ $contacto->formaPago }}">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Uso CFDI</label>
                                <input type="text" class="form-control form-control-sm no-border" readonly disabled value="{{ $contacto->usoCfdi }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Cuenta por cobrar</label>
                                <input type="text" class="form-control form-control-sm no-border" readonly disabled value="{{ $contacto->cuentaCobrar }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Cuenta por pagar</label>
                                <input type="text" class="form-control form-control-sm no-border" readonly disabled value="{{ $contacto->cuentaPagar }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <section id="tabs" class="project-tab">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <nav>
                                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Transacciones</a>
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Facturas</a>
                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Facturas de proveedor</a>
                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Notas de credito</a>
                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Notas debito</a>
                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Cotizaciones</a>
                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Remisiones</a>
                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Órdenes de compra</a>
                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Pólizas mensuales</a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <table class="table" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Project Name</th>
                                                <th>Employer</th>
                                                <th>Awards</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><a href="#">Work 1</a></td>
                                                <td>Doe</td>
                                                <td>john@example.com</td>
                                            </tr>
                                            <tr>
                                                <td><a href="#">Work 2</a></td>
                                                <td>Moe</td>
                                                <td>mary@example.com</td>
                                            </tr>
                                            <tr>
                                                <td><a href="#">Work 3</a></td>
                                                <td>Dooley</td>
                                                <td>july@example.com</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <table class="table" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Project Name</th>
                                                <th>Employer</th>
                                                <th>Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><a href="#">Work 1</a></td>
                                                <td>Doe</td>
                                                <td>john@example.com</td>
                                            </tr>
                                            <tr>
                                                <td><a href="#">Work 2</a></td>
                                                <td>Moe</td>
                                                <td>mary@example.com</td>
                                            </tr>
                                            <tr>
                                                <td><a href="#">Work 3</a></td>
                                                <td>Dooley</td>
                                                <td>july@example.com</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                    <table class="table" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Contest Name</th>
                                                <th>Date</th>
                                                <th>Award Position</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><a href="#">Work 1</a></td>
                                                <td>Doe</td>
                                                <td>john@example.com</td>
                                            </tr>
                                            <tr>
                                                <td><a href="#">Work 2</a></td>
                                                <td>Moe</td>
                                                <td>mary@example.com</td>
                                            </tr>
                                            <tr>
                                                <td><a href="#">Work 3</a></td>
                                                <td>Dooley</td>
                                                <td>july@example.com</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="container">
        <div class="d-flex justify-content-center row">
            <div class="col-lg-12">
                <div class="d-flex flex-column comment-section">
                    <div class="bg-light p-2">
                        <div class="d-flex flex-row align-items-start">
                            <img class="rounded-circle" src="{{ asset('img/media/contact/contacto1.png') }}" width="40">
                            <textarea placeholder="Escribe un comentario..." class="form-control ml-1 shadow-none textarea"></textarea>
                        </div>
                        <div class="mt-2 text-right">
                            <button class="btn btn-secondary btn-sm shadow-none" type="button">Cancelar</button>
                            <button class="btn btn-primary btn-sm shadow-none" type="button">Comentar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection