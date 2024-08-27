<?php
// Iniciar la sesión
session_start();

include '../querys/qcontratos.php';
// Obtener el ID del cliente de la URL
$idContrato = isset($_GET['id']) ? $_GET['id'] : null;

if (!$idContrato) {
    die("No se proporcionó un ID de cliente válido.");
}

// Obtener datos del contrato específico
$url = "https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Contratos?id=eq.$idContrato&select=*";

$nombreCliente = isset($clientesMap[$contrato['IdCliente']]) ? $clientesMap[$contrato['IdCliente']]['nombreCliente'] : 'N/A';
$nombreProvee = isset($proveedorMap[$contrato['IdProveedor']]) ? $proveedorMap[$contrato['IdProveedor']]['nombreProveedor'] : 'N/A';
$nombreProducto = 'N/A';
if (isset($productosMap[$contrato['IdCliente']]) && !empty($productosMap[$contrato['IdCliente']])) {
    $nombreProducto = $productosMap[$contrato['IdCliente']][0]['NombreDelProducto'];
}
$nombreMedio = isset($mediosMap[$contrato['IdMedios']]) ? $mediosMap[$contrato['IdMedios']]['NombredelMedio'] : 'N/A';
$tipoPublicidad = isset($tipoPMap[$contrato['IdTipoDePublicidad']]) ? $tipoPMap[$contrato['IdTipoDePublicidad']]['NombreTipoPublicidad'] : 'N/A';
$anioz = isset($aniosMap[$contrato['id_Anio']]) ? $aniosMap[$contrato['id_Anio']]['years'] : 'N/A';
$mez = isset($mesesMap[$contrato['Id']]) ? $mesesMap[$contrato['Id']]['Nombre'] : 'N/A';
$formaPago = isset($pagosMap[$contrato['id_FormadePago']]) ? $pagosMap[$contrato['id_FormadePago']]['NombreFormadePago'] : 'N/A';

include '../componentes/header.php';
include '../componentes/sidebar.php';

?>
      <!-- Main Content -->
      <div class="main-content">
      
      <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo $ruta; ?>dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $ruta; ?>ListContratos.php">Ver Contratos</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $contrato['NombreContrato']; ?></li>
                      </ol>
                    </nav>
        <section class="section">
          <div class="section-body">
            <div class="row mt-sm-4">
              <div class="col-12 col-md-12 col-lg-4">
                <div class="card author-box">
                  <div class="card-body">
                    <div class="author-box-center">
                      
                      <div class="clearfix"></div>
                      <div class="nombrex author-box-name">
                      <?php echo $contrato['NombreContrato']; ?>
                       
                      </div>
                      <div class="author-box-job">
                      <?php
    // Convertir la cadena de fecha y hora a un objeto DateTime
    $fecha = new DateTime($contrato['FechaCreacion']);
    
    // Formatear la fecha como deseas (en este caso, solo la fecha)
    echo 'Fecha registro: '.$fecha->format('d-m-Y'); // Esto mostrará la fecha en formato AAAA-MM-DD
    ?>
                    </div>
                    </div>
                    <div class="author-box-job text-center">
                    N° de Contrato: <?php echo $contrato['num_contrato']; ?>
                    </div>
                    <div class="text-center">
                      <div class="author-box-job">
                      <?php 
    // Suponiendo que $contrato['Estado'] contiene el valor del estado
    $estado = $contrato['Estado'];

    // Verifica el valor del estado y muestra el mensaje correspondiente
    if ($estado == 1) {
        echo "El Contrato se encuentra activo";
    } elseif ($estado == 0) {
        echo "El Contrato se encuentra desactivado";
    } else {
        echo "Estado desconocido"; // Mensaje opcional para valores inesperados
    }
?>
                   
                      </div>
                      <div class="w-100 d-sm-none"></div>
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
                          aria-selected="true">Información del Contrato</a>
                      </li>
                       <li class="removido">
                       <button type="button" class="btn6" data-bs-toggle="modal" data-bs-target="#exampleModal">
                       <i class="fas fa-edit duo"></i></button><li>
                    </ul>
                    <div class="tab-content tab-bordered" id="myTab3Content">
                      <div class="tab-pane fade show active" id="medio" role="tabpanel" aria-labelledby="home-tab2">
                        <div class="row">
                          <div class="col-md-3 col-12 b-r">
                            <strong>Nombre del Contrato</strong>
                            <br>
                            <p class="text-muted"><?php echo $contrato['NombreContrato']; ?></p>
                          </div>
                          <div class="col-md-3 col-12 b-r">
                            <strong>Cliente</strong>
                            <br>                      
                            <p class="text-muted"><?php echo $nombreCliente; ?></p>
                          </div>
                          <div class="col-md-3 col-12 b-r">
                            <strong>Proveedor</strong>
                            <br>
                            <p class="text-muted"><?php echo $nombreProvee; ?></p>
                          </div>
                          <div class="col-md-3 col-12 b-r">
                            <strong>Producto</strong>
                            <br>
                            <p class="text-muted"><?php echo $nombreProducto; ?></p>
                          </div>
                          <div class="col-md-3 col-12 b-r">
                            <strong>Medio</strong>
                            <br>
                            <p class="text-muted"><?php echo $nombreMedio; ?></p>
                          </div>
                          <div class="col-md-3 col-12 b-r">
                            <strong>Tipo de Publicidad</strong>
                            <br>
                            <p class="text-muted"><?php echo $tipoPublicidad; ?></p>
                          </div>
                          <div class="col-md-3 col-12 b-r">
                            <strong>Año</strong>
                            <br>
                            <p class="text-muted"><?php echo $anioz; ?></p>
                          </div>
                          <div class="col-md-3 col-12 b-r">
                            <strong>Mes</strong>
                            <br>
                            <p class="text-muted"><?php echo $mez; ?></p>
                          </div>
                          <div class="col-md-3 col-12 b-r">
                            <strong>Forma de Pago</strong>
                            <br>
                            <p class="text-muted"><?php echo $formaPago; ?></p>
                          </div>
                          <div class="col-md-3 col-12 b-r">
                            <strong>Fecha Inicio</strong>
                            <br>
                            <p class="text-muted"><?php
    // Convertir la cadena de fecha y hora a un objeto DateTime
    $fecha = new DateTime($contrato['FechaInicio']);
    
    // Formatear la fecha como deseas (en este caso, solo la fecha)
    echo $fecha->format('d-m-Y'); // Esto mostrará la fecha en formato AAAA-MM-DD
    ?></p>
                          </div>
                          <div class="col-md-3 col-12 b-r">
                            <strong>Fecha de Término</strong>
                            <br>
                            <p class="text-muted"><?php
    // Convertir la cadena de fecha y hora a un objeto DateTime
    $fecha = new DateTime($contrato['FechaTermino']);
    
    // Formatear la fecha como deseas (en este caso, solo la fecha)
    echo $fecha->format('d-m-Y'); // Esto mostrará la fecha en formato AAAA-MM-DD
    ?></p>
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


      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="formModal">EDITAR MEDIO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                 <!-- Alerta para mostrar el resultado de la actualización -->
                 <div id="updateAlert" class="alert" style="display:none;" role="alert"></div>
                            
                 
                <form id="updateMedioForm">
    <input type="hidden" name="id" value="<?php echo $idMedio; ?>">
    <div class="form-group">
        <label for="NombredelMedio">Nombre del Medio</label>
         <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="
fas fa-caret-square-right"></i></span>
            </div>
        <input type="text" class="form-control" id="NombredelMedio" name="NombredelMedio" value="<?php echo htmlspecialchars($datosMedio['NombredelMedio']); ?>">
    </div>
    </div>
    <div class="form-group">
        <label for="codigo">Código</label>
        <div class="input-group">
        <div class="input-group-prepend">
                <span class="input-group-text"><i class="
fas fa-barcode"></i></span>
            </div>
        <input type="text" class="form-control" id="codigo" name="codigo" value="<?php echo htmlspecialchars($datosMedio['codigo']); ?>">
    </div>
    </div>
    <div class="form-group">
        <label for="Id_Clasificacion">Clasificación</label>
         <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-indent"></i></span>
            </div>
        <select class="form-control" id="Id_Clasificacion" name="Id_Clasificacion">
            <?php foreach ($themedio as $clasificacion): ?>
                <option value="<?php echo $clasificacion['id_clasificacion_medios']; ?>" 
                        <?php echo ($clasificacion['id_clasificacion_medios'] == $datosMedio['Id_Clasificacion']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($clasificacion['NombreClasificacion']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    </div>
    <button type="submit" class="btn btn-primary">Guardar cambios</button>
</form>
              </div>
            </div>
          </div>
        </div>


<?php include '../componentes/settings.php'; ?>
<script src="../../../assets/js/updateMedio.js"></script>
<?php include '../componentes/footer.php'; ?>