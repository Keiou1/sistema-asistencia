<?php
session_start();
if (empty($_SESSION['nombre']) and empty($_SESSION['apellidos'])) {
  header('location:login/login.php');
}
$id = $_SESSION["id"];
?>


<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

  <h4 class="text-center text-secondary">Cambiar Contraseña</h4>

  <?php
  include "../modelo/conexion.php";
  include "../controlador/cambiar_clave.php";
  $sql = $conexion->query("select * from admin where id_admin = $id")
    ?>


  <div class="row">
    <form action="" method="POST">
      <?php
      while ($datos = $sql->fetch_object()) { ?>
        <div hidden class="fl-flex-label mb-4 px-2 col-12 col-md-6">
          <input type="text" placeholder="id" class="input input_text" name="txtid" value="<?= $datos->id_admin ?>">
        </div>
        <div class="fl-flex-label mb-4 px-2 col-12">
          <input type="password" placeholder="Contraseña Actual" class="input input_text" maxlength="10" name="txtactual"
            value="">
        </div>
        <div class="fl-flex-label mb-4 px-2 col-12">
          <input type="password" placeholder="Contraseña Nueva" class="input input_text" maxlength="10" name="txtnueva"
            value="">
        </div>
        <div class="fl-flex-label mb-4 px-2 col-12">
          <input type="password" placeholder="Confirmar Contraseña" class="input input_text" maxlength="10"
            name="txtnueva2" value="">
        </div>

        <div class="text-right p-4">
          <!-- <a href="admin.php" class="btn btn-secondary btn-rounded">Atras</a> -->
          <button type="submit" value="ok" name="btnactualizar" class="btn btn-primary btn-rounded">Actualizar</button>
        </div>


      <?php }
      ?>

    </form>

  </div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>