<div class="col-lg-6">
    <div class="form-group">
        <label>RFC <span class="text-success">*</span></label>
        <input type="text" class="form-control form-control-sm" name="rfc" id="rfc" required value={{ old('rfc') }} >
    </div>
</div>
<div class="col-lg-12">
    <div class="form-group">
        <label>Nombre <span class="text-success">*</span></label>
        <input type="text" class="form-control form-control-sm" name="nombre" id="nombre" required value={{ old('nombre') }}>
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label>Calle</label>
        <input type="text" class="form-control form-control-sm" name="calle" id="calle" value={{ old('calle') }}>
    </div>
</div>
<div class="col-lg-3">
    <div class="form-group">
        <label>Exterior</label>
        <input type="text" class="form-control form-control-sm" name="exterior" id="exterior" value={{ old('exterior') }}>
    </div>
</div>
<div class="col-lg-3">
    <div class="form-group">
        <label>Interior</label>
        <input type="text" class="form-control form-control-sm" name="interior" id="interior" value={{ old('interior') }}>
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label>Colonia</label>
        <input type="text" class="form-control form-control-sm" name="colonia" id="colonia" value={{ old('colonia') }}>
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label>Localidad</label>
        <input type="text" class="form-control form-control-sm" id="localidad" name="localidad" value={{ old('localidad') }}>
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label>Estado</label>
        <input type="text" class="form-control form-control-sm" name="estado" id="estado" value={{ old('estado') }}>
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label>País</label>
        <select class="form-control form-control-sm select" name="pais" id="pais" value={{ old('pais') }}>
            <option value="mexico" selected disabled>México</option>
        </select>
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label>Correo electrónico <span class="text-success">*</span></label>
        <input type="text" class="form-control form-control-sm" name="email" id="email" required value={{ old('email') }}>
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label>Celular</label>
        <input type="text" class="form-control form-control-sm" name="celular" id="celular" value={{ old('celular') }}>
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label>Teléfono 1</label>
        <input type="text" class="form-control form-control-sm" name="telefono" id="telefono" value={{ old('telefono') }}>
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label>Teléfono 2</label>
        <input type="text" class="form-control form-control-sm" name="telefono2" id="telefono2" value={{ old('telefono2') }}>
    </div>
</div>