
<?php
// Iniciar sesión
session_start();

include '../../componentes/header.php';
include '../../componentes/sidebar.php';

?>
<div class="main-content">

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo $ruta; ?>dashboard">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo $ruta; ?>ListCampaign.php">Ver Campañas</a></li>
        <li class="breadcrumb-item active" aria-current="page">Orden</li>
    </ol>
</nav>
<section class="section">
    <div class="section-body">
        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                <div class="card-header milinea">
                            <div class="titulox">
                                <h4>Información de Orden</h4>
                            </div>
                            <div class="agregar"><a class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modalAgregarCampania"><i class="fas fa-plus-circle"></i> Editar Orden</a></div>
                        </div>
                    <div class="card-body">
                        <div class="author-box-center">
                        <div class="contentable">
<table class="espaciador" width="100%" border="0">
  <tr>
    <td width="33%">38.818.666-6</td>
    <td class="titulot" width="33%"><div align="center">ORDEN DE PUBLICIDAD </div></td>
    <td class="titulot2" width="34%">INTERNET - ABRIL 2024 </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="titulot3">Anula y reemplaza orden n&deg;0019602</td>
    <td>&nbsp;</td>
  </tr>
  <tr>

    <td><strong>CLIENTE:</strong> RAZON SOCIAL PRUEBA<br>
    <strong>RUT:</strong> 38.818.666-6<br>
    <strong>DIRECCIÓN:</strong> CALLE FALSA S/N<br>
    <strong>COMUNA:</strong> ARICA<br>
    <strong>PRODUCTO:</strong> PRUEBA 2<br>
    <strong>AÑO:</strong> 2024<br>
    <strong>MES:</strong> ABRIL<br>
    <strong>N° CONTRATO:</strong> 0012<br>
    <strong>FORMA DE PAGO:</strong> CONTADO<br>
    <strong>TIPO ITEM:</strong> PRUEBA</td>


    <td style="text-align:center;"><strong>CAMPAÑA:</strong> CAMPAÑA DE PRUEBA<br>
    <strong>PLAN DE MEDIOS:</strong> PLAN PRUEBA 2<br>
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
    <td width="26%"><div class="formatotabla">
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
    <td width="45%"><div class="formatotabla">
      <table width="100%" border="1">
        <tr>
          <td>LISTAR D&Iacute;AS </td>
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
    <td colspan="2">&nbsp;</td>
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

    <?php include '../../componentes/settings.php'; ?>

      <?php include '../../componentes/footer.php'; ?>