@extends('layouts.master')
@section('title', 'Suscripción')
@section('content')
    <div class="row text-center">
        <div class="col-lg-12">
            <h1 class="font-weight-light">Estás inscrito en el <b>{{ current_plan()->nombre }}</b></h1>
            <h6 class="font-weight-light text-muted">Elige uno de nuestros planes y sigue creciendo con Alegra</h6>
        </div>
        <div class="col-lg-3 offset-1">
            <div class="card">
                <div class="card-body">
                    <h2><span class="badge badge-success px-5 py-2">PYME</span></h2>
                    <h1 class="font-weight-light">MXN $400</h1>
                    <h5>/ MES</h5>
                    <small class="border-bottom text-muted card-planes">100 Ventas al mes</small>
                    <small class="border-bottom text-muted card-planes">Ingresos hasta $500,000 al mes</small>
                    <small class="border-bottom text-muted card-planes">2 Usuarios con acceso a la plataforma</small>
                    <small class="border-bottom text-muted card-planes">2 Almacenes de inventario</small>
                    <small class="border-bottom text-muted card-planes">Sistema de punto de venta (TPV)</small>
                    <small class="border-bottom text-muted card-planes">Multimoneda</small>
                    <small class="border-bottom text-muted card-planes">Integraciones</small>
                </div>
                <div class="card-body" style="padding-top: 0;">
                    <button class="btn btn-lg btn-block btn-outline-success">ELEGIR PLAN</button>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h2><span class="badge badge-primary px-5 py-2"><i class="fa fa-star text-warning"></i> PRO</span></h2>
                    <h1 class="font-weight-light">MXN $400</h1>
                    <h5>/ MES</h5>
                    <small class="border-bottom text-muted card-planes">100 Ventas al mes</small>
                    <small class="border-bottom text-muted card-planes">Ingresos hasta $500,000 al mes</small>
                    <small class="border-bottom text-muted card-planes">2 Usuarios con acceso a la plataforma</small>
                    <small class="border-bottom text-muted card-planes">2 Almacenes de inventario</small>
                    <small class="border-bottom text-muted card-planes">Sistema de punto de venta (TPV)</small>
                    <small class="border-bottom text-muted card-planes">Multimoneda</small>
                    <small class="border-bottom text-muted card-planes">Integraciones</small>
                </div>
                <div class="card-body" style="padding-top: 0;">
                    <button class="btn btn-lg btn-block btn-outline-primary">ELEGIR PLAN</button>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h2><span class="badge badge-warning px-5 py-2">PLUS</span></h2>
                    <h1 class="font-weight-light">MXN $400</h1>
                    <h5>/ MES</h5>
                    <small class="border-bottom text-muted card-planes">100 Ventas al mes</small>
                    <small class="border-bottom text-muted card-planes">Ingresos hasta $500,000 al mes</small>
                    <small class="border-bottom text-muted card-planes">2 Usuarios con acceso a la plataforma</small>
                    <small class="border-bottom text-muted card-planes">2 Almacenes de inventario</small>
                    <small class="border-bottom text-muted card-planes">Sistema de punto de venta (TPV)</small>
                    <small class="border-bottom text-muted card-planes">Multimoneda</small>
                    <small class="border-bottom text-muted card-planes">Integraciones</small>
                </div>
                <div class="card-body" style="padding-top: 0;">
                    <button class="btn btn-lg btn-block btn-outline-warning">ELEGIR PLAN</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-lg-5 offset-1">
            <div class="card">
                <div class="card-body">
                  <h2><span class="badge badge-secondary px-5 py-2">Emprendedor</span></h2>
                  <h4 class="font-weight-light">MXN $150 / MES</h4>
                  <p class="card-text border-top text-muted">Crea 10 ventas y 10 facturas de proveedor mensuales, Ingresos hasta $50,000 al mes, 1 usuario y 1 almacén.</p>
                  <a href="#" class="btn btn-outline-secondary">ELEGIR PLAN</a>
                </div>
              </div>
        </div>
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                  <h2><span class="badge badge-info px-5 py-2">Corporativo</span></h2>
                  <h4 class="font-weight-light">MXN $0 / MES</h4>
                  <p class="card-text border-top text-muted">Si tu empresa necesita más facturas, usuarios, bodegas o tienes ingresos superiores.</p>
                  <a href="#" class="btn btn-outline-info">CONTÁCTENOS</a>
                </div>
              </div>
        </div>
    </div>
@endsection
