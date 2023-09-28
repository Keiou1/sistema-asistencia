<!-- Bootstrap CSS -->
<link rel="stylesheet" href="../backend/css/bootstrap.min.css">
<!----css3---->
<link rel="stylesheet" href="../backend/css/custom.css">

<!--google material icon-->
<link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
<link rel="shortcut icon" href="../backend/img/romboazul.svg" />


<?php
session_start();
if (empty($_SESSION['nombre']) and empty($_SESSION['apellidos'])) {
  header('location:login/login.php');
}

?>

<style>
  ul li:nth-child(1) .activo {
    background: rgb(11, 150, 214) !important;
  }
</style>

<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->

<div class="page-content">
  <h4 class="text-center text-secondary">PANEL DE CONTROL</h4>

  <div class="main-content">

    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header">
            <div class="icon icon-warning">
              <span class="material-icons">group</span>
            </div>
          </div>

          <div class="card-content">
            <p class="category"><strong>Personal</strong></p>
            <?php
            include "../modelo/conexion.php";

            $sql = $conexion->query("SELECT COUNT(*) total FROM personal");
            $total = $sql->fetch_object();
            ?>
            <h3 class="card-title">
              <?php echo $total->total; ?>
            </h3>
          </div>

          <div class="card-footer">
            <div class="stats">
              <i class="material-icons text-info">info</i>
              <a href="personal.php">Ver informe detallado</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header">
            <div class="icon icon-rose">
              <span class="material-icons">business_center</span>

            </div>
          </div>
          <div class="card-content">
            <p class="category"><strong>Cargos</strong></p>
            <?php

            $sql = $conexion->query("SELECT COUNT(*) total FROM cargo");
            $total = $sql->fetch_object();
            ?>
            <h3 class="card-title">
              <?php echo $total->total; ?>
            </h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons text-info">info</i>
              <a href="cargo.php">Ver informe detallado</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header">
            <div class="icon icon-success">
              <span class="material-icons">
                event
              </span>

            </div>
          </div>
          <div class="card-content">
            <p class="category"><strong>Entrada</strong></p>

            <?php

            $sql = $conexion->query("SELECT count(entrada) entrada FROM asistencia where date(entrada) = DATE(NOW())");
            $total = $sql->fetch_object();
            ?>
            <h3 class="card-title">
              <?php echo $total->entrada; ?>
            </h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons text-info">info</i>
              <a href="inicio.php">Ver informe detallado</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header">
            <div class="icon icon-info">
              <span class="material-icons">
                event
              </span>
            </div>
          </div>
          <div class="card-content">
            <p class="category"><strong>Salida</strong></p>
            <?php

            $sql = $conexion->query("SELECT count(salida) salida FROM asistencia where date(salida) = DATE(NOW())");
            $total = $sql->fetch_object();
            ?>
            <h3 class="card-title">
              <?php echo $total->salida; ?>
            </h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons text-info">info</i>
              <a href="inicio.php">Ver informe detallado</a>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="row ">
      <div class="col-lg-7 col-md-12">
        <div class="card" style="min-height: 485px">
          <div class="card-header card-header-text">
            <h4 class="card-title">Personal reciente</h4>
            <p class="category">Nuevo personal recientes</p>
          </div>
          <div class="card-content table-responsive">
            <?php

            $sql = $conexion->query("SELECT personal.id_personal, personal.nombre, personal.apellido_paterno, personal.dni, cargo.nombre as nom_cargo From personal inner join cargo on personal.cargo= cargo.id_cargo order by personal.id_personal desc limit 3");
            ?>
            <table class="table table-hover">
              <thead class="text-primary">
                <tr>
                  <th>ID</th>
                  <th>NOMBRE</th>
                  <th>DNI</th>
                  <th>CARGO</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($datos = $sql->fetch_object()) { ?>
                  <tr>
                    <td>
                      <?= $datos->id_personal ?>
                    </td>
                    <td>
                      <?= $datos->nombre ?>
                      <?php echo $datos->apellido_paterno ?>
                    </td>
                    <td>
                      <?= $datos->dni ?>
                    </td>
                    <td>
                      <?= $datos->nom_cargo ?>
                    </td>
                  </tr>
                <?php }
                ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-lg-5 col-md-12">
        <div class="card" style="min-height: 485px">
          <div class="card-header card-header-text">
            <h4 class="card-title">Actividad reciente</h4>
          </div>
          <div class="card-content">
            <div class="streamline">
              <?php
              $sql = $conexion->query("SELECT asistencia.entrada, personal.nombre, personal.apellido_paterno, cargo.nombre as nom_cargo, asistencia.salida from asistencia inner join personal on asistencia.id_personal = personal.id_personal inner join cargo on personal.cargo=cargo.id_cargo where date(entrada) = date(now()) order by entrada desc limit 5");
              ?>
              <?php while ($datos = $sql->fetch_object()) { ?>

                <div class="sl-item sl-primary">
                  <div class="sl-content">
                    <p>
                      <small class="text-muted">
                        <?php echo "Entrada: $datos->entrada" ?>
                      </small>
                    <p>
                      <?php echo "Nombre: $datos->nombre" ?>
                      <?php echo $datos->apellido_paterno ?>
                    </p>
                    <p>
                      <?php echo "Cargo: $datos->nom_cargo" ?>
                    </p>
                    <small class="text-muted">
                      <?php echo "Salida: $datos->salida" ?>
                    </small>
                  </div>
                </div>
              <?php } ?>

            </div>
          </div>

        </div>
      </div>
    </div>


  </div>

</div>
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../../backend/js/jquery-3.3.1.slim.min.js"></script>
<script src="../../backend/js/popper.min.js"></script>
<script src="../../backend/js/bootstrap.min.js"></script>
<script src="../../backend/js/jquery-3.3.1.min.js"></script>


<script type="text/javascript">
  $(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
      $('#sidebar').toggleClass('active');
      $('#content').toggleClass('active');
    });

    $('.more-button,.body-overlay').on('click', function () {
      $('#sidebar,.body-overlay').toggleClass('show-nav');
    });

  });

</script>

</div>



<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>