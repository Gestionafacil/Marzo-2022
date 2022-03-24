/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('factura-venta-component', require('./components/FacturaVentaComponent.vue'));
Vue.component('factura-frecuente-component', require('./components/FacturaFrecuenteComponent.vue'));
Vue.component('pago-recibido-component', require('./components/PagoRecibidoComponent.vue'));
Vue.component('factura-venta-listado-component', require('./components/FacturaVentaListaComponent.vue'));

Vue.component('modal-producto', require('./components/modal/BuquedaProductoModal.vue'));

const app = new Vue({
    el: '#app'
});