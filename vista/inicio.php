<?php
session_start();
if (empty($_SESSION['nombre']) and empty($_SESSION['apellidos'])) {
  header('location:login/login.php');
}

?>

<style>
  ul li:nth-child(2) .activo {
    background: rgb(11, 150, 214) !important;
  }
</style>

<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

  <h4 class="text-center text-secondary">LISTA DE ASISTENCIA</h4>

  <?php
  include "../modelo/conexion.php";
  include "../controlador/eliminar_asistencia.php";

  $sql = $conexion->query(" SELECT 
    asistencia.id_asistencia,
    asistencia.id_personal,
    asistencia.entrada,
    asistencia.salida,
    personal.id_personal,
    personal.nombre as 'nom_personal', 
    personal.apellido_paterno,
    personal.apellido_materno,
    personal.dni,
    personal.cargo,
    cargo.id_cargo,
    cargo.nombre as 'nom_cargo'
    FROM
    asistencia
    INNER JOIN personal ON asistencia.id_personal=personal.id_personal
    INNER JOIN cargo ON personal.cargo=cargo.id_cargo ");

  ?>

  <div class="text-right mb-2">
    <a href="fpdf/ReporteAsistencia.php" target="_blank" class="btn btn-success"><i class="fas fa-file-pdf"></i> Generar Reporte
    </a>
  </div>

  <table class="table table-bordered' table-hover col-md-12" id="example">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">PERSONAL</th>
        <th scope="col">DNI</th>
        <th scope="col">CARGO</th>
        <th scope="col">ENTRADA</th>
        <th scope="col">SALIDA</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
      while ($datos = $sql->fetch_object()) { ?>
        <tr>
          <td>
            <?= $datos->id_asistencia ?>
          </td>
          <td>
            <?= $datos->nom_personal . " " . $datos->apellido_paterno . " " . $datos->apellido_materno ?>
          </td>
          <td>
            <?= $datos->dni ?>
          </td>
          <td>
            <?= $datos->nom_cargo ?>
          </td>
          <td>
            <?= $datos->entrada ?>
          </td>
          <td>
            <?= $datos->salida ?>
          </td>
          <td>
            <a href="inicio.php?id=<?= $datos->id_asistencia ?>" onclick="advertencia(event)" class="btn btn-sm"><i
                class="fa-solid fa-trash"></i></a>
          </td>
        </tr>
      <?php }
      ?>

    </tbody>
  </table>

</div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>