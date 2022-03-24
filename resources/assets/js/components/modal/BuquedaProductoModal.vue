<template>
  <div
    class="modal fade scroll"
    :class="{ mostrar: modal }"
    tabindex="-1"
    role="dialog"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-success">Productos</h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
            v-on:click="$emit('llamarMetodo')"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
              <table class="table table-sm" id="tablaProductos">
                <thead>
                  <tr>
                    <th>Opción</th>
                    <th>Nombre</th>
                    <th>Referencia</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item, index) in arraydata" :key="index">
                    <td>
                      <button
                        type="button"
                        class="btn btn-sm btn-primary"
                        @click="getData(item)"
                        v-on:click="$emit('llamarFuncion')"
                      >
                        <i class="fas fa-plus"></i>
                      </button>
                    </td>
                    <td>{{ item.nombre }}</td>
                    <td>{{ item.referencia }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    modal: 0,
  },
  data() {
    return {
      arraydata: [],
    };
  },
  methods: {
    getData(data = []) {
      this.$emit("data", data);
    },
    loadProduct() {
      let me = this;
      axios
        .get("/inventario/producto/sin/id")
        .then(function (response) {
          me.arraydata = response.data;
        })
        .catch(function (error) {
          console.error(error);
        });
    },
  },
  mounted() {
    this.loadProduct();
  },
};
</script>
<style scope>
.mostrar {
  display: list-item !important;
  opacity: 1 !important;
  position: absolute !important;
  background-color: #3c29297a !important;
}

.scroll {
  height: 400px;
  overflow-y: scroll;
}
</style>