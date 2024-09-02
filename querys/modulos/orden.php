
<?php
// Iniciar sesión
session_start();

include '../../componentes/header.php';
include '../../componentes/sidebar.php';

?>

<style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 10px; font-size: 14px; }
        .order-form { border: 1px solid #000; padding: 20px; max-width: 1000px; margin: auto; }
        .header { background-color: #f0f0f0; padding: 10px; text-align: center; }
        .header p { margin: 0; }
        .header h1 { margin: 10px 0; font-size: 28px; }
        .subheader { display: flex; justify-content: space-between; font-weight: bold; margin: 10px 0; }
        .subheader .internet { color: blue; }
        .anula { color: red; text-align: center; font-weight: bold; margin: 10px 0; font-size: 16px; }
        .client-provider { display: flex; justify-content: space-between; }
        .client, .provider { width: 48%; }
        .box { border: 1px solid #000; padding: 5px; margin-top: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 12px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: center; }
        .days-header { font-size: 10px; }
        .days-content { font-size: 12px; }
        .totals { text-align: right; margin-top: 20px; font-size: 14px; }
        .footer { text-align: right; margin-top: 30px; font-size: 14px; color: blue; }
        .label { font-weight: bold; display: inline-block; width: 120px; }
    </style>
</head>
<body>
    <div class="order-form">
        <div class="header">
            <p>38.818.666-6</p>
            <p>(0000000000)</p>
            <h1>ORDEN DE PUBLICIDAD 1</h1>
        </div>
        <div class="subheader">
            <span class="internet">INTERNET</span>
            <span>ABRIL / 2024</span>
        </div>
        <p class="anula">ANULA Y REEMPLAZA ORDEN N°0019602</p>
        
        <div class="client-provider">
            <div class="client">
                <p><span class="label">CLIENTE:</span> RAZÓN SOCIAL PRUEBA</p>
                <p><span class="label">RUT:</span> 38.818.666-6</p>
                <p><span class="label">DIRECCIÓN:</span> CALLE FALSA S/N</p>
                <p><span class="label">COMUNA:</span> ARICA</p>
                <p><span class="label">PRODUCTO:</span> PRODUCTO PRUEBA 2</p>
                <p><span class="label">AÑO:</span> 2024</p>
                <p><span class="label">MES:</span> ABRIL</p>
                <p><span class="label">N°DE CONTRATO:</span> CONTRATO PRUEBA</p>
                <p><span class="label">FORMA DE PAGO:</span> CONTADO</p>
                <p><span class="label">TIPO ITEM:</span> AUSPICIO</p>
            </div>
            <div class="provider">
                <p><span class="label">PROVEEDOR:</span> PROVEEDOR DE PRUEBA</p>
                <p><span class="label">RUT:</span> 56.963.301-K</p>
                <p><span class="label">SOPORTE:</span> <span style="color: blue;">PROVEEDOR DE PRUEBA</span></p>
                <p><span class="label">DIRECCIÓN:</span> CALLE RIELES 1820</p>
                <p><span class="label">COMUNA:</span> CHIMBARONGO</p>
                <p><span class="label">CAMPAÑA:</span> CAMPAÑA PRUEBA</p>
                <p><span class="label">PLAN DE MEDIOS:</span> PLAN PRUEBA 2</p>
                <div class="box">
                    <p>DESCUENTOS DE CTTO:0.00 0.00 0.00</p>
                </div>
                <div class="box">
                    <p>Agencia de medios</p>
                    <p>AGENCIA CREATIVA: AGENCIA DE PRUEBAS</p>
                </div>
            </div>
        </div>
        
        <table>
            <tr>
                <th rowspan="2">Formato</th>
                <th rowspan="2">Detalle</th>
                <th class="days-header" colspan="30">1 2 3 4 5 6 7 8 9 10 11 12 13 14 15 16 17 18 19 20 21 22 23 24 25 26 27 28 29 30</th>
                <th rowspan="2">Total Avl</th>
                <th rowspan="2">Tarifa Bruto</th>
                <th rowspan="2">Dcto1</th>
                <th rowspan="2">Recargo</th>
                <th rowspan="2">Tarifa Negociada</th>
                <th rowspan="2">Total NETO</th>
            </tr>
            <tr>
                <th class="days-header">Lu Ma Mi Ju Vi Sa Do Lu Ma Mi Ju Vi Sa Do Lu Ma Mi Ju Vi Sa Do Lu Ma Mi Ju Vi Sa Do Lu Ma</th>
            </tr>
            <tr>
                <td>TEMA: CARRUSEL INFORMATIVO</td>
                <td></td>
                <td class="days-content">1 2 3 - 2 1 2 2 - - - - - - 2 2 - - - - - - - - - - - - - -</td>
                <td>1 1</td>
                <td>2.117.847</td>
                <td>0.0000</td>
                <td>0.0000</td>
                <td>2.117.847</td>
                <td>1.800.000</td>
            </tr>
        </table>
        
        <div class="totals">
            <p><strong>TOTAL NETO $</strong> 1.800.000</p>
            <p><strong>IVA 19%</strong> 342.000</p>
            <p><strong>TOTAL ORDEN($)</strong> 2.142.000</p>
        </div>
        
        <div class="footer">
            <p>MATIAS FUENTES</p>
            <p>matias.fuentes.2112@gmail.com</p>
        </div>
    </div>

    <?php include '../../componentes/settings.php'; ?>

      <?php include '../../componentes/footer.php'; ?>