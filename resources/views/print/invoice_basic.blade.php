<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FACTURA ELECTRÓNICA (CFDI) - {{ $factura["codigoFactura"] }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-size: 13px;
            font-family: Arial, Helvetica, sans-serif;
        }
        
        body{
            padding: 0px 10px 5px 10px;
        }

        /* Cabecera */
        
        h1 {
            text-align: center;
            padding: 8px;
            background-color: blue;
            color: #fff;
            font-size: 1.2em;
            font-weight: 100;
        }
        
        #nombre_empresa {
            font-size: 1.4em;
            margin-top: 8px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        
        .empresa {
            width: 60%;
            /* overflow: hidden; */
            /* float: left; */
            margin-top: 10px;
        }
        
        .factura {
            width: 40%;
            overflow: hidden;
            float: right;
            text-align: right;
            margin-top: 10px;
        }
        
        .factura > p {
            padding-bottom: 4px;
        }
        
        .empresa img {
            width: 175px;
            height: 60px;
            /* float: left; */
            margin-right: 10px;
            /* border: 1px solid #b1b0b0; */
        }
        
        .empresa > p {
            padding-bottom: 8px;
            /* font-size: 12px; */
        }
        
        .empresa div {
            float: left;
            margin-top: 3px;
        }
        
        .text-primary {
            color: blue;
            font-weight: 800;
        }
        
        .text-secondary {
            font-weight: 800;
        }
        
        .receptor {
            clear: both;
            padding-top: -20px !important;
        }
        
        #factura_detalle {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
            margin-bottom: 10px;
            border: #888 solid;
        }
        
        #factura_detalle td,
        #factura_detalle th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        
        #factura_detalle tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        
        #factura_detalle tr:hover {
            background-color: #ddd;
        }
        
        #factura_detalle th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #acafae;
            color: white;
        }
        
        #detalle_pago {
            margin-top: 10px;
            float: right;
            /* width: 30%; */
            text-align: center;
            padding-bottom: 50px;
            clear: both;
            /* margin-right: -15px; */
        }
        
        .certificado {
            margin-top: 10px;
            float: right;
            width: 40%;
        }
        
        .fecha {
            margin-top: 10px;
            float: left;
            width: 40%;
        }
        
        .uppercase {
            text-transform: uppercase;
        }
        
        #QR {
            margin-top: 10px;
            width: 90%;
            /* overflow: hidden; */
        }
        
        #QR img {
            float: left;
            width: 100px;
        }
        
        #QR > div {
            margin-top: 20px;
            text-align: right;
            text-align: left;
        }
        
        .pie {
            width: 10% !important;
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- Cabecera -->
    <h1>FACTURA ELECTRÓNICA (CFDI)</h1>
    <!-- Nombre de la empresa -->
    <h2 id="nombre_empresa">{{ $factura["Enombre"] }}</h2>
    <!-- Datos de la empresa -->
    <div class="empresa">
        <div>
            <p>RFC: {{ $factura["Erfc"] }}</p>
            <p>Zapotal No. Ext. S/N Col. La Manga II Villahermosa, Centro, Tabasco. C.P. 86125</p>
            <p>Tel.: (993) 2692919</p>
            <p>E-Mail: {{ $factura["Eemail"] }}</p>
            <p><span class="text-primary">LUGAR DE EXPEDICION</span> :86125</p>
        </div>
        {{-- <img src="{{ public_path('print/descarga.png') }}"> --}}
    </div>
    <!-- Datos de la factura -->
    <div class="factura">
        <p class="text-primary">FACTURA:</p>
        <p class="">{{ $factura["codigoFactura"] }}</p>
        <p class="text-primary">Folio fiscal:</p>
        <p class="">{{ $factura["uuid"] }}</p>
        <p class="text-primary">No de Serie del Certificado del CSD:</p>
        <p class="">20001000000300022779</p>
        <p class="text-primary">Fecha y hora de emisión:</p>
        <p class="">29-11-2017 00:02:53</p>
    </div>
    <!-- Receptor -->
    <div class="receptor">
        <p>RECEPTOR: <span class="text-secondary">GABRIELA ALONSO ULIN</span></p>
        <p>RFC CLIENTE: <span class="text-secondary">AOUG750308V67</span></p>
        <p>DIRECCION: <span class="text-secondary">28 S/N Col. Montes de Amé, Merida, Yucatán C.P. 97115, Mexico.</span></p>
        <p>USO CFDI: <span class="text-secondary">G03 GASTOS EN GENERAL</span></p>
    </div>
    <!-- Tabla descripción -->
    <table id="factura_detalle">
        <thead>
            <tr>
                <th>CANTIDAD</th>
                <th>UNIDAD DE MEDIDA</th>
                <th>DESCRIPCIÓN</th>
                <th>P. UNITARIO</th>
                <th>IMPORTE</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detalle as $item)
                <tr style="text-align: center;">
                    <td>{{ $item["cantidad"] }}</td>
                    <td>{{ $item["valor"] }} ({{ $item["valor_adicional"] }})</td>
                    <td>{{ $item["nombre"] }}</td>
                    <td>{{ $item["precio"] }}</td>
                    <td>22,931.03</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Total a pagar en letras -->
    <span class="text-secondary">( VEINTISEIS MIL QUINIENTOS NOVENTA Y NUEVE PESOS M.N. ) </span>
    <!-- Tabla de impuestos y total -->
    <table id="detalle_pago">
        <tr>
            <td>SUBTOTAL</td>
            <td>$</td>
            <td>22,931.03</td>
        </tr>
        <tr>
            <td>IVA 16.00%</td>
            <td>$</td>
            <td>3,668.96</td>
        </tr>
        <tr>
            <td class="text-secondary">TOTAL</td>
            <td>$</td>
            <td class="text-secondary">26,599.99</td>
        </tr>
    </table>
    <!-- Código QR -->
    <div id="QR">
        <img src="{{ public_path('print/qr.png') }}">
        <div style="margin-top: 10px;">
            <p>FORMA DE PAGO: <span class="text-secondary uppercase">99 POR DEFINIR</span></p>
            <p>CTA. BANCARIA: <span class="text-secondary uppercase">NA</span></p>
            <p>RÉGIMEN FISCAL: <span class="text-secondary uppercase">601 GENERAL DE LEY PERSONAS MORALES</span></p>
            <p>MONEDA: <span class="text-secondary uppercase">MXN</span></p>
            <p>MÉTODO PAGO: <span class="text-secondary uppercase">FUE PAGO EN UNA SOLA EXHIBICIÓN</span></p>
        </div>
    </div>
    
    <div style="clear: both; width: 100%; text-align: justify; justify-content: left; justify-items: left;">
    <!-- Sello Digital del CFDI -->
    <p class="text-secondary" style="clear: both;">Sello Digital del CFDI:</p>
    <p style="white-space:initial; word-wrap: break-word;">lPR9CZq8nBXIoCxTHVvyRSkqsc91B4OEV+rsVLbLUSchyDjh2mkKOaIhpPCiqZ0PuTTjlQX7VrwocNTqlcLBvEEIu65wnOsZfCqVd4INL9uT8hP6CGh4xJkdpeCroC3CS8kb2i702ZIFs9SxU7AWPVgQFvl2In4xTKN6BDfCdMOeDzatitvy4yjkDP4YrwVqfecWfbbi44EPemFFSfIK5VlJeHa0Db2x0Fig6pYdE33u6+uEzon/6AL9hURdgoV/7XId+Zw5cZvGSkOcRqmN6mwjR9g6AyDbWEarIAkc8S82khUq3lrPAk3czhJ5Bnh4EJ+h1pYTn+hLvPqtP021+A==</p>
    <br>
    <p class="text-secondary">Sello del SAT</p>
    <p style="white-space:initial; word-wrap: break-word;">SV73LzHTXycDfF/8p4+AwWqA59Q2uCCppMKCUO1eG+GAoi/CVEKnQ/ayR+Ifdi4LmPHyaoLqBhzrcwtH+ZzaZXaz6iTNjgOhQWWOLeYATBFs9P93Sk/1AxRC1iBsq1Oci8d9flKY9N+arCTdeqFVt8uZXcz1fj5gvB8Hhrhvi/i4ttnWKCbvd+4Mf+XO4DholRPWvv5Uxo04IK4zxgwFyU+oh+nun2nieNkKsZ/rMEFaCbwWLcxkrHTC6fPVd3QoEG9C0nU9awaFt/mvHxkI1G8AS246JFSYX0OMpWLOUhjnqTOWiP/grFljds66qkfvG4dqaRSTJm+6Zphk1HNzoA==</p>
    <br>
    <!-- Cadena Original del complemento de certificación digital del SAT -->
    <p class="text-secondary">Cadena Original del complemento de certificación digital del SAT:</p>
    <p style="white-space:initial; word-wrap: break-word;">||1.1|82E97F59-EA04-4CB0-AFE1-915A845B75F9|2017-11-29T00:28:15|DAL050601L35|lPR9CZq8nBXIoCxTHVvyRSkqsc91B4OEV+rsVLbLUSchyDjh2mkKOaIhpPCiqZ0PuTTjlQX7VrwocNTqlcLBvEEIu65wnOsZfCqVd4INL9uT8hP6CGh4xJkdpeCroC3CS8kb2i702ZIFs9SxU7AWPVgQFvl2In4xTKN6BDfCdMOeDzatitvy4yjkDP4YrwVqfecWfbbi44EPemFFSfIK5VlJeHa0Db2x0Fig6pYdE33u6+uEzon/6AL9hURdgoV/7XId+Zw5cZvGSkOcRqmN6mwjR9g6AyDbWEarIAkc8S82khUq3lrPAk3czhJ5Bnh4EJ+h1pYTn+hLvPqtP021+A==|20001000000300022323||</p>
    </div>
    <br>
    <table style="width: 100%">
        <tr style="text-align: center;">
            <td style="width: 50%;">
                <span class="text-primary">No de Serie del Certificado del SAT:</span> <br><span>20001000000300022323</span>
            </td>
            <td style="width: 50%;">
                <span class="text-primary">Fecha y hora de certificación:</span> <br><span>29-11-2017 00:28:15</span>
            </td>
        </tr>
    </table>
    
    <!-- Pie de página -->    
    <table style="width: 100%; border-top: blue solid 1px; margin-top: 10px; padding-top: 10px;">
        <tr style="text-align: center">
            <td style="width: 33%; color: #888;">Descarga tu factura en https://www.gestionafacil.com</td>
            <td style="width: 33%;">Esta es una representación impresa de un CFDI</td>
            <td style="width: 33%;">Efectos fiscales al pago</td>
        </tr>
    </table>
    <!-- Pie de página -->    
</body>

</html>