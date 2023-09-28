<?php
session_start();
if (empty($_SESSION['nombre']) and empty($_SESSION['apellidos'])) {
  header('location:login/login.php');
}

?>

<style>
  ul li:nth-child(5) .activo {
    background: rgb(11, 150, 214) !important;
  }
</style>

<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

  <h4 class="text-center text-secondary">ADMINISTRADORES</h4>

  <?php
  include "../modelo/conexion.php";
  include "../controlador/modificar_admin.php";
  include "../controlador/eliminar_admin.php";

  $sql = $conexion->query(" SELECT * FROM admin ");
  ?>

  <a href="registro_admin.php" class="btn btn-primary btn-rounded mb-2"><i class="fa-solid fa-plus"></i>&nbsp;
    Registrar</a>
  <table class="table table-bordered' table-hover col-md-12" id="example">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">NOMBRE</th>
        <th scope="col">APELLIDOS</th>
        <th scope="col">USUARIO</th>
        <th scope="col">PUESTO</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
      while ($datos = $sql->fetch_object()) { ?>
        <tr>
          <td>
            <?= $datos->id_admin ?>
          </td>
          <td>
            <?= $datos->nombre ?>
          </td>
          <td>
            <?= $datos->apellidos ?>
          </td>
          <td>
            <?= $datos->usuario ?>
          </td>
          <td>
            <?= $datos->puesto ?>
          </td>
          <td>
            <!-- <a href="" data-toggle="modal" data-target="#exampleModal<?= $datos->id_admin ?>"
              class="btn btn-warning btn-sm"><i class="fa-solid fa-file-pen"></i></a> -->
            <a href="admin.php?id=<?= $datos->id_admin ?>" onclick="advertencia(event)" class="btn btn-sm"><i
                class="fa-solid fa-trash"></i></a>
          </td>
        </tr>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal<?= $datos->id_admin ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header d-flex justify-content-between">
                <h5 class="modal-title w-100" id="exampleModalLabel">Modificar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="" method="POST">
                  <div hidden class="fl-flex-label mb-4 px-2 col-12">
                    <input type="text" placeholder="Id" class="input input_text" name="txtid"
                      value="<?= $datos->id_admin ?>">
                  </div>
                  <div class="fl-flex-label mb-4 px-2 col-12">
                    <input type="text" placeholder="Nombre" class="input input_text" name="txtnombre"
                      value="<?= $datos->nombre ?>">
                  </div>
                  <div class="fl-flex-label mb-4 px-2 col-12">
                    <input type="text" placeholder="Apellidos" class="input input_text" name="txtapellidos"
                      value="<?= $datos->apellidos ?>">
                  </div>
                  <div class="fl-flex-label mb-4 px-2 col-12">
                    <input type="text" placeholder="Puesto" class="input input_text" name="txtpuesto"
                      value="<?= $datos->puesto ?>">
                  </div>
                  <div class="fl-flex-label mb-4 px-2 col-12">
                    <input type="text" placeholder="Correo" class="input input_text" name="txtcorreo"
                      value="<?= $datos->correo ?>">
                  </div>
                  <div class="fl-flex-label mb-4 px-2 col-12">
                    <input type="text" placeholder="Telefono" class="input input_text" name="txttelefono"
                      value="<?= $datos->telefono ?>">
                  </div>
                  <div class="fl-flex-label mb-4 px-2 col-12">
                    <input type="text" placeholder="Usuario" class="input input_text" name="txtusuario"
                      value="<?= $datos->usuario ?>">
                  </div>
                  <div class="text-right p-4">
                    <a href="admin.php" class="btn btn-secondary btn-rounded">Atras</a>
                    <button type="submit" value="ok" name="btnregistrar"
                      class="btn btn-primary btn-rounded">Modificar</button>
                  </div>

                </form>
              </div>
            </div>
          </div>
        <?php }
      ?>

    </tbody>
  </table>

</div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>