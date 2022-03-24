<template>
  <div>
    <div class="card-header-tp">
      <div class="row m-2">
        <div class="form-group col-lg-2">
          <label>Tipo de documento</label>
          <ul class="nav nav-pills">
            <li class="nav-item" style="width: 50%">
              <a class="nav-link active" href="#" data-toggle="tab">Facturas</a>
            </li>
            <li class="nav-item" style="width: 50%">
              <a class="nav-link" href="#" data-toggle="tab">Tickets</a>
            </li>
          </ul>
        </div>
        <div class="form-group col-lg-2">
          <label>Método de pago <span class="text-primary">*</span></label>
          <select class="form-control form-control-sm" v-model="metodo_pago_id">
            <option selected :value="0">Seleccionar</option>
            <option
              v-for="item in dmetodopago"
              :key="item.id"
              :value="item.id"
              v-text="item.valor"
            ></option>
          </select>
        </div>
        <div class="form-group col-lg-2">
          <label>Forma de pago <span class="text-primary">*</span></label>
          <select class="form-control form-control-sm" v-model="forma_pago_id">
            <option selected :value="0">Seleccionar</option>
            <option
              v-for="item in forma_pago"
              :key="item.id"
              :value="item.id"
              v-text="item.valor"
            ></option>
          </select>
        </div>
        <!-- <div class="form-group col-lg-2">
          <label>Número de cuenta</label>
          <input
            type="text"
            class="form-control form-control-sm"
            v-model="numero_cuenta"
          />
        </div> -->
        <div class="form-group col-lg-2">
          <label>Almacén</label>
          <select class="form-control form-control-sm" v-model="almacen_id">
            <option selected :value="0">Seleccionar</option>
            <option
              v-for="item in almacen"
              :key="item.id"
              :value="item.id"
              v-text="item.nombre"
            ></option>
          </select>
        </div>
        <div class="form-group col-lg-2">
          <label>Lista de precios</label>
          <select class="form-control form-control-sm" v-model="lista_precio_id">
            <option selected :value="0">Seleccionar</option>
            <option
              v-for="item in lista_precio"
              :key="item.id"
              :value="item.id"
              v-text="item.valor"
            ></option>
          </select>
        </div>
        <div class="form-group col-lg-2">
          <label>Vendedor</label>
          <select class="form-control form-control-sm" v-model="vendedor_id">
            <option selected :value="0">Seleccionar</option>
            <option
              v-for="item in vendedor"
              :key="item.id"
              :value="item.id"
              v-text="item.nombre"
            ></option>
          </select>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
        <!-- <hr /> -->
        <div class="row">
          <div class="col-lg-6">
            <div class="row">
              <div class="form-group col-lg-9">
                <label>Contacto <span class="text-primary">*</span></label>
                <select class="form-control form-control-sm" v-model="contacto_id">
                  <option selected :value="null">Seleccionar</option>
                  <option
                    v-for="item in contacto"
                    :key="item.id"
                    :value="item.id"
                    v-text="item.nombre"
                  ></option>
                </select>
              </div>
              <div class="col-lg-3">
                <button type="button" class="btn btn-xs mt-4 btn-link">
                  <i class="fa fa-fw fa-plus-circle"></i>Nuevo cliente
                </button>
              </div>
              <div class="form-group col-lg-6">
                <label>Telefono</label>
                <input
                  type="tel"
                  class="form-control form-control-sm"
                  v-model="telefono"
                />
              </div>
              <div class="form-group col-lg-6">
                <label>RFC</label>
                <input type="text" class="form-control form-control-sm" v-model="rfc" />
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="row">
              <div class="form-group col-lg-6">
                <label>Plazo de pago</label>
                <select class="form-control form-control-sm" v-model="plazo_pago_id">
                  <option selected :value="0">Seleccionar</option>
                  <option
                    v-for="item in plazo_pago"
                    :key="item.id"
                    :value="item.id"
                    v-text="item.valor"
                  ></option>
                </select>
              </div>
              <div class="form-group col-lg-6">
                <label>Fecha <span class="text-primary">*</span></label>
                <input
                  type="datetime-local"
                  class="form-control form-control-sm"
                  v-model="fecha"
                />
              </div>

              <div class="form-group col-lg-6">
                <label>Vencimiento <span class="text-primary">*</span></label>
                <input
                  type="datetime-local"
                  class="form-control form-control-sm"
                  v-model="vencimiento"
                />
              </div>
              <div class="form-group col-lg-6">
                <label>Uso <span class="text-primary">*</span></label>
                <select class="form-control form-control-sm" v-model="uso_id">
                  <option selected :value="0">Seleccionar</option>
                  <option
                    v-for="item in uso"
                    :key="item.id"
                    :value="item.id"
                    v-text="item.valor"
                  ></option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="table-responsive">
              <table class="table table-hover table-sm" id="listado">
                <thead>
                  <tr>
                    <th>Producto</th>
                    <th>Referencia</th>
                    <th>Precio</th>
                    <th>Desc %</th>
                    <th>Impuesto</th>
                    <th>Descripción</th>
                    <th width="50">Cantidad</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item, index) in arrayFact" :key="index">
                    <td>{{ item.nombre }}</td>
                    <td>{{ item.referencia }}</td>
                    <td>{{ item.precio }}</td>
                    <td>{{ item.desc }}</td>
                    <td>{{ item.impuesto }}</td>
                    <td>{{ item.descripcion }}</td>
                    <td>
                      <input
                        type="number"
                        class="form-control form-control-sm"
                        v-model="item.cantidad"
                        @change="calcular(index, item.cantidad)"
                      />
                    </td>
                    <td>{{ item.total }}</td>
                    <td class="text-muted text-center">
                      <a href="#" @click="removeItem(index)">X</a>
                    </td>
                  </tr>
                </tbody>
              </table>
              <hr />
              <button type="button" class="btn btn-sm btn-primary" @click="openModal()">
                <i class="fa fa-plus"></i> Agregar Item
              </button>
            </div>
          </div>
        </div>
        <div class="card-header-tp" v-if="arrayRetencion.length > 0">
          <table>
            <tbody>
              <tr v-for="(item, index) in arrayRetencion" :key="index">
                <td>
                  <div class="form-inline m-2">
                    <label>Retención <span class="text-primary ml-2 mr-2">*</span></label>
                    <select
                      class="form-control form-control-sm"
                      style="width: 200px"
                      v-model="item.retencion_id"
                    >
                      <option selected value="0">Seleccionar</option>
                      <option
                        v-for="item in impuestos"
                        :key="item.id"
                        :value="item.id"
                        v-text="item.valor"
                      ></option>
                    </select>
                  </div>
                </td>
                <td>
                  <div class="form-inline">
                    <label>Valor <span class="text-primary ml-2 mr-2">*</span></label>
                    <input
                      type="number"
                      class="form-control form-control-sm"
                      v-model="item.valor"
                    />
                  </div>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                  <a href="#" @click="removeItemRetencion(index)">X</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="card-header-tp" v-if="arrayRemision.length > 0">
          <table>
            <tbody>
              <tr v-for="(item, index) in arrayRemision" :key="index">
                <td>
                  <div class="form-inline m-2">
                    <label>Remisión <span class="text-primary ml-2 mr-2">*</span></label>
                    <select
                      class="form-control form-control-sm"
                      style="width: 200px"
                      v-model="item.remision_id"
                    ></select>
                  </div>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                  <a href="#" @click="removeItemRemision(index)">X</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="row">
          <div class="col-lg-6"></div>
          <div class="col-lg-6">
            <div class="text-right">
              <button
                type="button"
                class="btn btn-outline-primary btn-sm"
                @click="addItemretencion()"
              >
                <i class="fa fa-plus"></i> Agregar retención
              </button>
              <button
                type="button"
                class="btn btn-outline-primary btn-sm"
                @click="addItemRemision()"
              >
                <i class="fa fa-plus"></i> Agregar Remisión
              </button>
            </div>
            <div class="text-center totales">
              <p class="d-flex justify-content-between align-items-center">
                <strong>Sub Total:</strong>${{ subTotal }}
              </p>
              <p class="d-flex justify-content-between align-items-center">
                <strong>Descuento:</strong>${{ descuento }}
              </p>
              <hr />
              <p class="d-flex justify-content-between align-items-center total">
                <strong>Total:</strong>${{ total }}
              </p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-lg-8">
            <label>Terminos y Condiciones</label>
            <textarea
              class="form-control form-control-sm"
              cols="30"
              rows="4"
              v-model="termino_condicion"
            ></textarea>
          </div>
          <div class="form-group col-lg-4">
            <label>Notas</label>
            <textarea
              class="form-control form-control-sm"
              cols="30"
              rows="4"
              v-model="nota"
            ></textarea>
          </div>
          <div class="col-lg-6">
            <small class="text-muted"
              >Todos los campos marcados con * son de caracter obligatorio.</small
            >
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="text-right">
          <button
            type="button"
            class="btn btn-outline-primary"
            @click="cancelarFactura()"
          >
            Cancelar
          </button>
          <button type="button" class="btn btn-outline-primary">Vista previa</button>
          <button type="button" class="btn btn-outline-primary">
            Timbrar y agregar pagos
          </button>
          <button type="button" class="btn btn-outline-primary">
            Timbrar y crear nueva
          </button>
          <div class="btn-group">
            <div class="btn-group dropleft" role="group">
              <button
                type="button"
                class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <span class="sr-only">Timbrar</span>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" style="cursor: pointer;" @click="cambiarTypeInvoice('GuardarComoBorrador')">Guardar como borrador</a>
                <a class="dropdown-item" style="cursor: pointer;" @click="cambiarTypeInvoice('GuardarSinTimbrar')">Guardar sin timbrar</a>
                <a class="dropdown-item" style="cursor: pointer;" @click="cambiarTypeInvoice('TimbrarCorreo')">Timbrar y enviar por correo</a>
              </div>
            </div>
            <button type="button" class="btn btn-primary" @click="guardarTimbrarFactura()">Timbrar</button>
          </div>
        </div>
      </div>
      <modal-producto
        v-if="modal != 0"
        :data="producto"
        :modal="modal"
        @data="arrayData = $event"
        v-on:llamarFuncion="selectItem()"
        v-on:llamarMetodo="cerraModal()"
      ></modal-producto>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    dmetodopago: [],
    forma_pago: [],
    almacen: [],
    lista_precio: [],
    vendedor: [],
    contacto: [],
    plazo_pago: [],
    uso: [],
    producto: [],
    impuestos: []
  },
  data() {
    return {
      modal: 0,
      subTotal: "0,00",
      descuento: "0,00",
      ck_numerocuenta: 0,
      ck_almacen: 0,
      ck_lista_precio: 0,
      ck_vendedor: 0,
      id: 0,
      metodo_pago_id: 0,
      forma_pago_id: 0,
      numero_cuenta: "",
      almacen_id: 0,
      lista_precio_id: 0,
      vendedor_id: 0,
      contacto_id: null,
      fecha: "",
      rfc: "",
      plazo_pago_id: 0,
      telefono: "",
      vencimiento: "",
      uso_id: 0,
      termino_condicion: "",
      nota: "",
      arrayFact: [],
      arrayRetencion: [],
      arrayRemision: [],
      arrayData: [],
      total: "0,00",
      InvoiceType: "GuardarTimbrar"
    };
  },
  methods: {
    openModal() {
      this.modal = 1;
    },
    cerraModal() {
      this.modal = 0;
    },
    addItemretencion() {
      this.arrayRetencion.push({
        retencion_id: 0,
        valor: 0,
      });
    },
    addItemRemision() {
      this.arrayRemision.push({
        remision_id: 0,
      });
    },
    removeItem(index) {
      this.arrayFact.splice(index, 1);
    },
    removeItemRetencion(index) {
      this.arrayRetencion.splice(index, 1);
    },
    removeItemRemision(index) {
      this.arrayRemision.splice(index, 1);
    },
    selectItem() {
      this.arrayFact.push({
        producto_id: this.arrayData.id,
        nombre: this.arrayData.nombre,
        referencia: this.arrayData.referencia,
        precio: this.arrayData.precio_total,
        desc: "% " + this.arrayData.valor_impuesto,
        impuesto: this.arrayData.impuesto,
        descripcion: this.arrayData.descripcion,
      });
      this.cerraModal();
    },
    calcular(index, cantidad) {
      this.arrayFact[index]["total"] = cantidad * this.arrayFact[index]["precio"];
      for (let index = 0; index <= this.arrayFact.length; index++) {
        if (this.arrayFact.length > 1) {
          this.subTotal =
            this.arrayFact[index]["total"] + this.arrayFact[index + 1]["total"];
        } else {
          this.subTotal = this.arrayFact[index]["total"];
        }
      }
      //this.total = this.subTotal - this.descuento;
    },
    cancelarFactura() {
      axios
        .post("/factura/cancelar", {})
        .then(function (response) {
          window.responseWsdl = response;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    cambiarTypeInvoice(type){
        this.InvoiceType = type;
        this.guardarTimbrarFactura();
    },
    guardarTimbrarFactura() {
      $("#spinLoad").show();
      axios
        .post("/factura/guardar", {
          metodo_pago_id: this.metodo_pago_id,
          forma_pago_id: this.forma_pago_id,
          numero_cuenta: this.numero_cuenta,
          almacen_id: this.almacen_id,
          lista_precio_id: this.lista_precio_id,
          vendedor_id: this.vendedor_id,
          contacto_id: this.contacto_id,
          fecha: this.fecha,
          rfc: this.rfc,
          plazo_pago_id: this.plazo_pago_id,
          telefono: this.telefono,
          vencimiento: this.vencimiento,
          uso_id: this.uso_id,
          termino_condicion: this.termino_condicion,
          nota: this.nota,
          arrayFact: this.arrayFact,
          arrayRetencion: this.arrayRetencion,
          arrayRemision: this.arrayRemision,
          InvoiceType: this.InvoiceType
        })
        .then(function (response) {
          window.responseWsdl = response;
          this.InvoiceType = "GuardarTimbrar";
          $("#spinLoad").hide();
          alertaBonita('success', response.message, 'Acceptar');
        })
        .catch(function (error) {
          console.log(error);
          alertaBonita('error', 'No se pudo guardar la factura', 'Acceptar');
          $("#spinLoad").hide();
          this.InvoiceType = "GuardarTimbrar";
        });
    },
  },
  mounted() {},
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
.nav-link {
  color: black !important;
}
.nav-pills {
  background-color: #fff !important;
}
</style>
