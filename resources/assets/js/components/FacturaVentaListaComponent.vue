<template>
    <div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-hover table-sm" id="listado">
                <thead>
                    <th>folio</th>
                    <th>cliente</th>
                    <th>Creacion</th>
                    <th>Vencimiento</th>
                    <th>Total</th>
                    <th>Cobrado</th>
                    <th>Por cobrar</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                    <tr v-for="factura in facturas">
                        <td>folio</td>
                        <td>{{factura.cliente_id}}</td>
                        <td>Creacion</td>
                        <td>{{ factura.fecha_vencimiento }}</td>
                        <td>Total</td>
                        <td>Cobrado</td>
                        <td>Por cobrar</td>
                        <td>Estado</td>
                        <td>
                            <button type="button" class="btn btn-xs btn-link"><i class="fa fa-eye"></i></button>
                            <button type="button" class="btn btn-xs btn-link"><i class="fa fa-print"></i></button>
                            <button type="button" class="btn btn-xs btn-link"><i class="fa fa-file"></i></button>
                            <button type="button" class="btn btn-xs btn-link"><i class="fa fa-unlock"></i></button>
                            <button type="button" class="btn btn-xs btn-link"><i class="fa fa-money-bill-wave"></i></button>
                            <button type="button" class="btn btn-xs btn-link"><i class="fa fa-pencil-alt"></i></button>
                            <button type="button" class="btn btn-xs btn-link"><i class="text-danger fa fa-minus"></i></button>
                            <button type="button" class="btn btn-xs btn-link"><i class="text-danger fa fa-window-close"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: {
        facturas: []
    }
}
</script>