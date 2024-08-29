<?php
session_start();

//Verificar si el usuario ha iniciado sesión//
if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
  // Si no ha iniciado sesión, redirigir al login
  header("Location: index.php");
  exit();
}
// Usar el nombre del usuario
$user_name = $_SESSION['user_name'];


include 'componentes/header.php';
include 'componentes/sidebar.php';

?>
<link rel="stylesheet" href="<?php echo $ruta; ?>assets/bundles/fullcalendar/fullcalendar.min.css">



      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Calendario</h4>
                  </div>
                  <div class="card-body">
                    <div class="fc-overflow">
                      <div id="myEvent"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

      </div>
   

       


<?php include 'componentes/settings.php'; ?>
<script src="<?php echo $ruta; ?>assets/js/app.min.js"></script>
<script src="<?php echo $ruta; ?>assets/bundles/fullcalendar/fullcalendar.min.js"></script>
<script src="<?php echo $ruta; ?>assets/js/page/calendar.js"></script>
      <?php include 'componentes/footer.php'; ?>