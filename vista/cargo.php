<?php
session_start();
if (empty($_SESSION['nombre']) and empty($_SESSION['apellidos'])) {
  header('location:login/login.php');
}

?>

<style>
  ul li:nth-child(4) .activo {
    background: rgb(11, 150, 214) !important;
  }
</style>

<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

  <h4 class="text-center text-secondary">LISTA DE CARGOS</h4>

  <?php
  include "../modelo/conexion.php";
  include "../controlador/modificar_cargo.php";
  include "../controlador/eliminar_cargo.php";

  $sql = $conexion->query(" SELECT * FROM cargo ");
  ?>

  <a href="registro_cargo.php" class="btn btn-primary btn-rounded mb-2"><i class="fa-solid fa-plus"></i>&nbsp;
    Registrar</a>
  <table class="table table-bordered' table-hover col-md-12" id="example">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">CARGO</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
      while ($datos = $sql->fetch_object()) { ?>
        <tr>
          <td>
            <?= $datos->id_cargo ?>
          </td>
          <td>
            <?= $datos->nombre ?>
          </td>
          <td>
            <a href="" data-toggle="modal" data-target="#exampleModal<?= $datos->id_cargo ?>"
              class="btn btn-warning btn-sm"><i class="fa-solid fa-file-pen"></i></a>
            <a href="cargo.php?id=<?= $datos->id_cargo ?>" onclick="advertencia(event)" class="btn btn-sm"><i
                class="fa-solid fa-trash"></i></a>
          </td>
        </tr>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal<?= $datos->id_cargo ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header d-flex justify-content-between">
                <h5 class="modal-title w-100" id="exampleModalLabel">Modificar cargo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="" method="POST">
                  <div hidden class="fl-flex-label mb-4 px-2 col-12">
                    <input type="text" placeholder="Id" class="input input_text" name="txtid"
                      value="<?= $datos->id_cargo ?>">
                  </div>
                  <div class="fl-flex-label mb-4 px-2 col-12">
                    <input type="text" placeholder="Nombre" onkeypress="return soloLetrasNumeros(event)"
                      class="input input_text" maxlength="100" name="txtnombre" value="<?= $datos->nombre ?>">
                  </div>

                  <div class="text-right p-4">
                    <a href="cargo.php" class="btn btn-secondary btn-rounded">Atras</a>
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

<script>
  function soloLetrasNumeros(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "abcdefghijklmnopqrstuvwxyz1234567890";
    especiales = "8-37-39-46";

    tecla_especial = false
    for (var i in especiales) {
      if (key == especiales[i]) {
        tecla_especial = true;
        break;
      }
    }

    if (letras.indexOf(tecla) == -1 && !tecla_especial) {
      //document.frmcontactenos.nick.value="";			
      return false;
    }
  }
</script>

<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>