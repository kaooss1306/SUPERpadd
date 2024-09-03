<?php
// Iniciar sesión
session_start();

//include '../../querys/qcontratos.php';
include '../../querys/qclientes.php';
include '../../componentes/header.php';
include '../../componentes/sidebar.php';


// Obtener el ID de la orden de la URL
$idOrdenPlan = isset($_GET['id_orden']) ? $_GET['id_orden'] : null;

$url = "https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/OrdenesDePublicidad?id_ordenes_de_comprar=eq.$idOrdenPlan&select=*";
$planPublicidad = makeRequest($url);
$datosPublicidad = $planPublicidad[0] ?? [];

$idCliente = $datosPublicidad['id_cliente'] ?? '';

$url2 = "https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/PlanesPublicidad?id_cliente=eq.$idCliente&select=*";
$productoPublicidad = makeRequest($url2);
$datosProductos = $productoPublicidad[0] ?? [];

$url4 = "https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Contratos?IdCliente=eq.$idCliente&select=*";
$contrato = makeRequest($url4);
$datosContrato = $contrato[0] ?? [];


$idCampania = $datosProductos['id_campania'] ?? null;
$url3 = "https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Campania?id_campania=eq.$idCampania&select=*";
$campania = makeRequest($url3);
$datosCampania = $campania[0] ?? [];


$cliente = $clientesMap[$idCliente] ?? [];
$idComuna = $cliente['id_comuna'] ?? '';
$idRegion = $cliente['id_region'] ?? '';
$nombreComuna = $comunasMap[$idComuna] ?? 'N/A';
$nombreRegion = $regionesMap[$idRegion] ?? 'N/A';

// Corregir la obtención del nombre del producto
$id_producto = $datosProductos['id_producto'] ?? null;
$nombreProducto = $productosMap2[$id_producto] ?? "Nombre no disponible";

// Si $productosMap2[$id_producto] es un array, intentamos obtener el nombre del producto
if (is_array($nombreProducto)) {
    $nombreProducto = $nombreProducto['NombreDelProducto'] ?? $nombreProducto['nombre'] ?? "Nombre no disponible";
}

$nombresMeses = [
  1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
  5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
  9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
];

?>
<div class="main-content">

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo $ruta; ?>dashboard">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo $ruta; ?>ListOrdenes.php">Ver Ordenes de Publicidad</a></li>
        <li class="breadcrumb-item active" aria-current="page">Orden de Publicidad - <?php echo $clientesMap[$datosPublicidad['id_cliente'] ?? '']['nombreCliente'];?></li>
    </ol>
</nav>
<section class="section">
    <div class="section-body">
        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                <div class="card-header milinea">
                            <div class="titulox">
                                <h4>Información de la orden de Publicidad</h4>
                            </div>
                            <div class="agregar">
                            <button id="generatePdfButton"><i class="fas fa-file-pdf"></i> Generar PDF</button>
                            </div>
                        </div>
                    <div class="card-body">
                        <div class="author-box-center">
                        <div class="contentable">
<table class="espaciador" width="100%" border="0">
  <tr>
    <td class="azul" width="33%">RUT <?php $rutOrden = $clientesMap[$datosPublicidad['id_cliente'] ?? '']['RUT'];
                                        echo $rutOrden;
    ?></td>
    <td class="titulot" width="33%"><div align="center">ORDEN DE PUBLICIDAD </div></td>
    <td class="titulot2" width="34%">INTERNET - <?php 
$idCalendar = $datosPublicidad['id_calendar'] ?? '';
$mesNumero = $calendarMap[$idCalendar][0]['mes'] ?? 'No disponible';
$mesNombre = is_numeric($mesNumero) ? ($nombresMeses[(int)$mesNumero] ?? 'No disponible') : 'No disponible';
echo htmlspecialchars($mesNombre);
?> <?php 
    $idCalendar = $datosPublicidad['id_calendar'] ?? '';
    $matrizCalendario = $calendarMap[$idCalendar][0]['anio'] ?? 'No disponible';
    echo htmlspecialchars($matrizCalendario);
    ?> </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="titulot3">Anula y reemplaza orden n° 0019602</td>
    <td>&nbsp;</td>
  </tr>
  <tr>

    <td><strong>CLIENTE:</strong> <?php echo $clientesMap[$datosPublicidad['id_cliente'] ?? '']['nombreCliente'];?><br>
    <strong>RUT:</strong> <?php echo $clientesMap[$datosPublicidad['id_cliente'] ?? '']['RUT'];?><br>
    <strong>DIRECCIÓN:</strong> <?php echo $clientesMap[$datosPublicidad['id_cliente'] ?? '']['direccionEmpresa'];?><br>
    <strong>COMUNA:</strong> <?php echo $nombreComuna; ?><br>
    <strong>PRODUCTO:</strong> <?php echo htmlspecialchars($nombreProducto); ?><br>
    <strong>AÑO:</strong> <?php 
    $idCalendar = $datosPublicidad['id_calendar'] ?? '';
    $matrizCalendario = $calendarMap[$idCalendar][0]['anio'] ?? 'No disponible';
    echo htmlspecialchars($matrizCalendario);
    ?><br>
    <strong>MES:</strong> <?php 
$idCalendar = $datosPublicidad['id_calendar'] ?? '';
$mesNumero = $calendarMap[$idCalendar][0]['mes'] ?? 'No disponible';
$mesNombre = is_numeric($mesNumero) ? ($nombresMeses[(int)$mesNumero] ?? 'No disponible') : 'No disponible';
echo htmlspecialchars($mesNombre);
?><br>
    <strong>N° CONTRATO:</strong> <?php echo $datosContrato['num_contrato'] ?? 'No disponible'; ?><br>
    <strong>FORMA DE PAGO:</strong> CONTADO<br>
    <strong>TIPO ITEM:</strong> PRUEBA</td>


    <td style="text-align:center;"><strong>CAMPAÑA:</strong> <?php echo $datosCampania['NombreCampania'] ?? 'Nombre no disponible'; ?><br>
    
    <strong>PLAN DE MEDIOS:</strong> <?php echo $datosProductos['NombrePlan'] ?? 'Nombre no disponible'; ?><br>
    <div class="thebordex">
    <strong>DESCUENTOS:</strong> ACA VALOR <br>
</div>
</td>


    <td valign="top">
    <strong>PROVEEDOR:</strong> PROVEEDOR DE PRUEBA<br>
    <strong>RUT:</strong> 56.963.301-K<br>
    <strong>SOPORTE:</strong> PROVEEDOR DE PRUEBA<br>
    <strong>DIRECCIÓN:</strong> CALLE NUEVA 345<br>
    <strong>COMUNA:</strong> CHIMBARONGO<br><br><br>
    <div class="conborde">AGENCIA DE MEDIOS<br />
    <strong>AGENCIA CREATIVA:</strong> AGENCIA DE PRUEBAS  </div>
</td>
  </tr>
</table>
<table width="100%" border="0">
  <tr>
    <td width="26%"><div class="formatotabla bordered-table">
      <table width="100%" border="1">
        <tr>
          <td><div align="center">FORMATO</div></td>
          <td><div align="center">DETALLE</div></td>
        </tr>
        <tr>
          <td><div align="center">TEMA: CARRUSEL </div></td>
          <td><div align="center">- </div></td>
        </tr>
      </table>
    </div></td>
    <td width="45%"><div class="formatotabla bordered-table">
      <table width="100%" border="1">
        <tr>
          <td>LISTAR DÍAS </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <td width="29%">
        <table width="100%" class="bordered-table">
      <tr>
        <td>Avisos </td>
        <td>Bruto</td>
        <td>Descto</td>
        <td>Recargo</td>
        <td>Tarifa</td>
        <td>NETO </td>
      </tr>
      <tr>
        <td>1</td>
        <td>2.117.847</td>
        <td>0</td>
        <td>0</td>
        <td>2.117.847</td>
        <td>1.800.000</td>
      </tr>
      
    </table></td>
  </tr>
  <tr style="border:0px solid; ">
    <td colspan="2">
     <div class="observa">Observaciones</div>
    </td>
    <td><table style="margin-top:30px;" width="100%" border="0">
      <tr>
        <td width="14%">&nbsp;</td>
        <td width="43%"><strong>TOTAL NETO</strong> </td>
        <td width="43%">$1.800.000</td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td><strong>IVA 19%</strong> </td>
        <td>$342.000</td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td><strong>TOTAL ORDEN</strong> </td>
        <td>$2.142.000</td>
        </tr>
        <tr>
            <td></td>
        </tr>
      <tr>

        <td>&nbsp;</td>
        <td colspan="2">
        <br>    
        <div class="thename">Miguel Llanos</div>
        <div class="themailx"> miguel@prueba.cl</div>
</td>

        </tr>
    </table></td>
  </tr>
</table>
</div>

                        </div>
                    </div>
                </div>


        </div>
    </div>
</section>
<div class="settingSidebar">
    <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
    </a>
    <div class="settingSidebar-body ps-container ps-theme-default">
        <div class=" fade show active">
            <div class="setting-panel-header">Setting Panel
            </div>
            <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Select Layout</h6>
                <div class="selectgroup layout-color w-50">
                    <label class="selectgroup-item">
                        <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                        <span class="selectgroup-button">Light</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                        <span class="selectgroup-button">Dark</span>
                    </label>
                </div>
            </div>
            <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Sidebar Color</h6>
                <div class="selectgroup selectgroup-pills sidebar-color">
                    <label class="selectgroup-item">
                        <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                        <span class="selectgroup-button selectgroup-button-icon" data-bs-toggle="tooltip" data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                        <span class="selectgroup-button selectgroup-button-icon" data-bs-toggle="tooltip" data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                    </label>
                </div>
            </div>
            <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Color Theme</h6>
                <div class="theme-setting-options">
                    <ul class="choose-theme list-unstyled mb-0">
                        <li title="white" class="active">
                            <div class="white"></div>
                        </li>
                        <li title="cyan">
                            <div class="cyan"></div>
                        </li>
                        <li title="black">
                            <div class="black"></div>
                        </li>
                        <li title="purple">
                            <div class="purple"></div>
                        </li>
                        <li title="orange">
                            <div class="orange"></div>
                        </li>
                        <li title="green">
                            <div class="green"></div>
                        </li>
                        <li title="red">
                            <div class="red"></div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                    <label class="m-b-0">
                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="mini_sidebar_setting">
                        <span class="custom-switch-indicator"></span>
                        <span class="control-label p-l-10">Mini Sidebar</span>
                    </label>
                </div>
            </div>
            <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                    <label class="m-b-0">
                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="sticky_header_setting">
                        <span class="custom-switch-indicator"></span>
                        <span class="control-label p-l-10">Sticky Header</span>
                    </label>
                </div>
            </div>
            <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                    <i class="fas fa-undo"></i> Restore Default
                </a>
            </div>
        </div>
    </div>

</div>
</div>
<script>
function generatePDF() {
    // Crear una nueva instancia de jsPDF en orientación horizontal
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF({
        orientation: 'landscape',
        unit: 'mm',
        format: 'a4'
    });

    // Obtener el contenido del div
    const content = document.querySelector('.contentable');

    // Definir el padding en milímetros
    const padding = 10; // Puedes ajustar este valor según necesites

    // Usar html2canvas para convertir el contenido HTML a una imagen
    html2canvas(content, {
        scale: 4, // Aumenta la escala para mejorar la calidad
        useCORS: true // Permite cargar imágenes de otros dominios si es necesario
    }).then(canvas => {
        const imgData = canvas.toDataURL('image/jpeg', 1.0);
        
        // Obtener las dimensiones de la página
        const pageWidth = doc.internal.pageSize.getWidth();
        const pageHeight = doc.internal.pageSize.getHeight();
        
        // Calcular las dimensiones de la imagen para que ocupe toda la página menos el padding
        const maxWidth = pageWidth - (2 * padding);
        const maxHeight = pageHeight - (2 * padding);
        
        const widthRatio = maxWidth / canvas.width;
        const heightRatio = maxHeight / canvas.height;
        const ratio = Math.min(widthRatio, heightRatio);
        
        const imgWidth = canvas.width * ratio;
        const imgHeight = canvas.height * ratio;
        
        // Centrar la imagen en la página, considerando el padding
        const x = (pageWidth - imgWidth) / 2;
        const y = (pageHeight - imgHeight) / 2;

        // Añadir la imagen al PDF
        doc.addImage(imgData, 'JPEG', x, y, imgWidth, imgHeight);

        // Guardar el PDF
        doc.save('orden_publicidad_horizontal_con_padding.pdf');
    });
}

// Añadir el evento click al botón
document.getElementById('generatePdfButton').addEventListener('click', generatePDF);
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <?php include '../../componentes/settings.php'; ?>

      <?php include '../../componentes/footer.php'; ?>