<?php
// Iniciar la sesión
session_start();
// Definir variables de configuración
//$ruta = 'localhost/paddv4/';
// Función para hacer peticiones cURL
include '../querys/qplanes.php';
// Obtener el ID del cliente de la URL
$idPlan = isset($_GET['id']) ? $_GET['id'] : null;

if (!$idPlan) {
    die("No se proporcionó un ID de cliente válido.");
}

// Obtener datos del cliente específico
$url = "https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/PlanesPublicidad?id_planes_publicidad=eq.$idPlan&select=*";
$planmed = makeRequest($url);
$datosPlan = $planmed[0];
// Verificar si se obtuvo el medio

// Obtener datos
$temas = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Temas?select=*');
$soportes = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Soportes?select=*');
$proveedores = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Proveedores?select=*');
$clientes = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Clientes?select=*');
$contratos = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Contratos?select=*');
$planes = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/PlanesPublicidad?select=*');
$meses = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Meses?select=*');
$anos = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Anios?select=*');
$productos = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Productos?select=*');
$jsonData = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/json?select=*');
$calendarMap = [];

foreach ($jsonData as $calendar) {
    // Aquí asumimos que `id_calendar` es único y usamos su valor como clave en nuestro mapa
    $calendarMap[$calendar['id_calendar']] = $calendar['matrizCalendario'];
}
$mesesNombres = [
    1 => 'Enero',
    2 => 'Febrero',
    3 => 'Marzo',
    4 => 'Abril',
    5 => 'Mayo',
    6 => 'Junio',
    7 => 'Julio',
    8 => 'Agosto',
    9 => 'Septiembre',
    10 => 'Octubre',
    11 => 'Noviembre',
    12 => 'Diciembre'
];

$clientesMap = [];
foreach ($clientes as $cliente) {
    $clientesMap[$cliente['id_cliente']] = [
        'nombreCliente' => $cliente['nombreCliente'],
        'razonSocial' => $cliente['razonSocial']
    ];
}
$campaignsMap2 = [];
foreach ($campaigns as $campaign) {
    $campaignsMap2[$campaign['id_campania']] = [
        'id' => $campaign['id_campania'],
        'nombreCampania' => $campaign['NombreCampania'],
        'idCliente' => $campaign['id_Cliente']
    ];
}

$soportesMap = [];
foreach ($soportes as $soporte) {
    $soportesMap[] = [
        'id' => $soporte['id_soporte'],
        'nombreIdentficiador' => $soporte['nombreIdentficiador'],
        'idProveedor' => $soporte['id_proveedor']
    ];
}
$temasMap2 = [];
foreach ($temas as $tema) {
    $temasMap2[] = [
        'id' => $tema['id_tema'],
        'NombreTema' => $tema['NombreTema'],
        'CodigoMegatime' => $tema['CodigoMegatime'],
        'id_medio' => $tema['id_medio']
    ];
}


$contratosMap = [];
foreach ($contratos as $contrato) {
    $contratosMap[$contrato['id']] = [
        'nombreContrato' => $contrato['NombreContrato'],
        'idCliente' => $contrato['IdCliente'],
        'idProveedor' => $contrato['IdProveedor']
    ];
}
$proveedoresMap = [];
foreach ($proveedores as $proveedor) {
    $proveedoresMap[$proveedor['id']] = [
        'nombreProveedor' => $proveedor['NombreProveedor']
    ];
}

// Luego, para acceder a 'razonSocial' del cliente correspondiente al 'id_cliente' del plan seleccionado:
$idCliente = $datosPlan['id_cliente']; // Aquí obtienes el 'id_cliente' del plan seleccionado
$idPlan = $datosPlan['id_soporte'];
$idTem = $datosPlan['id_temas'];
$idCam = $datosPlan['id_campania'];
$idContrato = $datosPlan['id_contrato'];
$nombreProveedor = isset($proveedoresMap[$idProveedor]) ? $proveedoresMap[$idProveedor]['nombreProveedor'] : null;
$contra = isset($contratosMap[$idContrato]) ? $contratosMap[$idContrato]['nombreContrato'] : null;
$cammoe = isset($campaignsMap2[$idCam]) ? $campaignsMap2[$idCam]['nombreCampania'] : null;
$razonSocial = isset($clientesMap[$idCliente]) ? $clientesMap[$idCliente]['razonSocial'] : null;
$nombreCliente = isset($clientesMap[$idCliente]) ? $clientesMap[$idCliente]['nombreCliente'] : null;
$soportename = isset($soportesMap[$idPlan]) ? $soportesMap[$idPlan]['nombreIdentficiador'] : null;
$temm = isset($temasMap2[$idTem]) ? $temasMap2[$idTem]['NombreTema'] : null;



include '../componentes/header.php';
include '../componentes/sidebar.php';

?>
<div class="main-content">
      
      <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo $ruta; ?>dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $ruta; ?>ListMedios.php">Ver Medios</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $razonSocial; ?></li>
                      </ol>
                    </nav>
        <section class="section">
          <div class="section-body">
            <div class="row mt-sm-4">
              <div class="col-12 col-md-12 col-lg-4">
              <div class="card">
                  <div style="display: flex;
    justify-content: space-between;" class="card-header">
                   
                    <h4>Detalles del Plan</h4>
                    <a class="btn btn-danger micono"  data-bs-toggle="modal" data-bs-target="#actualizarProveedor" data-idmedios="<?php echo $id_medios_json; ?>" data-idproveedor="<?php echo $idProveedor ?>" onclick="loadProveedorData(this)" ><i class="fas fa-pencil-alt"></i> Editar datos</a>

                  </div>
                  <div class="card-body">
    <div class="py-4">
                            <p class="clearfix">
                                <span class="float-start">Nombre Proveedor</span>
                                <span class="float-right text-muted "><?php echo $datosPlan['NombrePlan']; ?></span>
                            </p>
                            <p class="clearfix">
                                <span class="float-start">Razón Social</span>
                                <span class="float-right text-muted "><?php echo $razonSocial; ?></span>
                            </p>
                             
                            <p class="clearfix">
                                <span class="float-start">Soporte</span>
                                <span class="float-right text-muted "><?php echo $soportename; ?></span>
                            </p> 
                            <p class="clearfix">
                                <span class="float-start">Tema</span>
                                <span class="float-right text-muted "><?php echo $temm; ?></span>
                            </p> 
                            <p class="clearfix">
                                <span class="float-start">Campaña</span>
                                <span class="float-right text-muted "><?php echo $cammoe; ?><?php echo $idCam; ?></span>
                            </p>
                            <p class="clearfix">
                                <span class="float-start">Contrato</span>
                                <span class="float-right text-muted "><?php echo $contra; ?><?php echo $idContrato; ?></span>
                            </p>
                            <p class="clearfix">
                                <span class="float-start">Proveedor</span>
                                <span class="float-right text-muted "><?php echo $contra; ?><?php echo $nombreProveedor; ?></span>
                            </p>
    </div>
</div>
                </div>
                 
              
               
              </div>
              <div class="col-12 col-md-12 col-lg-8">
                <div class="card">
                  <div class="padding-20">
                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="home-tab2" data-bs-toggle="tab" href="#medio" role="tab"
                          aria-selected="true">Información Medio</a>
                      </li>
                       <li class="removido">
                       <button type="button" class="btn6" data-bs-toggle="modal" data-bs-target="#exampleModal">
                       <i class="fas fa-edit duo"></i></button><li>
                    </ul>
                    <div class="tab-content tab-bordered" id="myTab3Content">
                      <div class="tab-pane fade show active" id="medio" role="tabpanel" aria-labelledby="home-tab2">
                        <div class="row">
                          <div class="col-md-4 col-12 b-r">
                            <strong>Nombre del Medio</strong>
                            <br>
                            <p class="text-muted"><?php echo $datosMedio['NombredelMedio'];?></p>
                          </div>
                          <div class="col-md-4 col-12 b-r">
                            <strong>Código del Medio</strong>
                            <br>                      
                            <p class="text-muted"><?php echo $datosMedio['codigo'];?></p>
                          </div>
                          <div class="col-md-4 col-12 b-r">
                            <strong>Clasificación</strong>
                            <br>
                            <p class="text-muted"><?php echo $clasificacionesMap[$datosMedio['Id_Clasificacion']]['NombreClasificacion'] ?? 'No especificado'; ?></p>
                          </div>
                        
                    
                        </div>
                      
                      </div>


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
                    <span class="selectgroup-button selectgroup-button-icon" data-bs-toggle="tooltip"
                      data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                    <span class="selectgroup-button selectgroup-button-icon" data-bs-toggle="tooltip"
                      data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
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
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="mini_sidebar_setting">
                    <span class="custom-switch-indicator"></span>
                    <span class="control-label p-l-10">Mini Sidebar</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label class="m-b-0">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="sticky_header_setting">
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
      <?php include '../componentes/settings.php'; ?>
<script src="../../../assets/js/updateMedio.js"></script>
<?php include '../componentes/footer.php'; ?>