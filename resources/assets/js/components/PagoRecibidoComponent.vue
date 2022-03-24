<template>
  <div>
    <div class="card mt-2">
      <div class="card-body">
        <div class="row">
          <div class="form-group col-lg-3">
            <label>Fecha</label>
            <input type="datetime-local" class="form-control form-control-sm" />
          </div>
          <div class="form-group col-lg-3">
            <label>Serie o Folio</label>
            <input type="text" class="form-control form-control-sm" />
          </div>
          <div class="form-group col-lg-3">
            <label>Contacto</label>
            <select class="form-control form-control-sm select">
              <option selected value="0">Seleccionar</option>
            </select>
          </div>
          <div class="form-group col-lg-3">
            <label>Cuenta Bancaria *</label>
            <select class="form-control form-control-sm select">
              <option selected value="0">Seleccionar</option>
            </select>
          </div>
          <div class="form-group col-lg-3">
            <label>Forma de pago *</label>
            <select class="form-control form-control-sm select">
              <option selected value="0">Seleccionar</option>
            </select>
          </div>
          <div class="form-check col-lg-3">
            <label class="form-check-label" for="defaultCheck1">
              Complemento de pago
            </label>
            <input
              class="form-check-input"
              type="checkbox"
              value=""
              id="defaultCheck1"
            />
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="table-responsive">
              <table class="table table-hover table-sm" id="listado">
                <thead>
                  <th>Concepto</th>
                  <th>Valor</th>
                  <th>Impuesto</th>
                  <th>Cantidad</th>
                  <th>Observaciones</th>
                  <th>Total</th>
                </thead>
                <tbody></tbody>
              </table>
              <hr />
              <button type="button" class="btn btn-outline-primary">
                <i class="fa fa-plus"></i> Agregar cuenta contable
              </button>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6"></div>
          <div class="col-lg-6">
            <div class="text-right">
              <button type="button" class="btn btn-outline-primary btn-sm">
                <i class="fa fa-plus"></i> Agregar retención
              </button>
            </div>
            <div class="text-center totales">
              <p class="d-flex justify-content-between align-items-center">
                <strong>Sub Total:</strong>${{ subTotal }}
              </p>
              <p class="d-flex justify-content-between align-items-center">
                <strong>Descuento:</strong>${{ descuento }}
              </p>
              <p class="d-flex justify-content-between align-items-center">
                <strong>Sub Total:</strong>${{ subTotalDescue }}
              </p>
              <hr />
              <p
                class="d-flex justify-content-between align-items-center total"
              >
                <strong>Total:</strong>{{ total }}
              </p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-lg-12">
            <label>Nota de Recibo</label>
            <textarea
              class="form-control form-control-sm"
              cols="30"
              rows="4"
            ></textarea>
          </div>
          <div class="col-lg-6">
            <small class="text-muted"
              >Todos los campos marcados con * son de caracter
              obligatorio.</small
            >
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="text-right">
          <button type="button" class="btn btn-outline-primary">
            Cancelar
          </button>
          <button type="button" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      subTotal: "0,00",
      descuento: "0,00",
      subTotalDescue: "0,00",
      total: "0,00",
      numerocuenta: "",
      almacen_id: 0,
      lista_precio_id: 0,
    };
  },
};
</script>
<style scoped>
.card-header-tp {
  background-color: #e5e7e9;
  margin: 5px;
  margin-top: 20px;
  border-radius: 2px;
  height: 10%;
  width: 100%;
  margin-left: 0;
}
.totales {
  margin-top: 50px;
  font-size: 15px !important;
}
p {
  padding-left: 100px !important;
  padding-right: 100px !important;
}
.total {
  padding-left: 200px !important;
  padding-right: 200px !important;
  font-size: 25px !important;
}
.form-check-input{
 position: relative !important;
 margin-right: 1.25rem !important;
}
.form-check{
  margin-top: 30px;
}
.form-check-label {
  margin-right: 20px;
}
</style>
