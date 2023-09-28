<?php
session_start();
if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
  header('location:login/login.php');
}

?>

<style>
  ul li:nth-child(3) .activo {
    background: rgb(11, 150, 214) !important;
  }
</style>

<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

  <h4 class="text-center text-secondary">LISTA DE PERSONAL</h4>

  <?php
  include "../modelo/conexion.php";
  include "../controlador/modificar_personal.php";
  include "../controlador/eliminar_personal.php";

  $sql = $conexion->query(" SELECT 
  personal.id_personal, 
  personal.nombre,
  personal.apellido_paterno,
  personal.apellido_materno,
  personal.dni,
  personal.cargo,
  cargo.nombre as 'nom_cargo'
  FROM 
  personal
  INNER JOIN cargo ON personal.cargo = cargo.id_cargo");
  ?>

  <a href="registro_personal.php" class="btn btn-primary btn-rounded mb-2"><i class="fa-solid fa-plus"></i>&nbsp;
    Registrar</a>
  <table class="table table-bordered' table-hover col-md-12" id="example">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">NOMBRE</th>
        <th scope="col">APELLIDO PARTERNO</th>
        <th scope="col">APELLIDO MATERNO</th>
        <th scope="col">DNI</th>
        <th scope="col">CARGO</th>
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
          </td>
          <td>
            <?= $datos->apellido_paterno ?>
          </td>
          <td>
            <?= $datos->apellido_materno ?>
          </td>
          <td>
            <?= $datos->dni ?>
          </td>
          <td>
            <?= $datos->nom_cargo ?>
          </td>
          <td>
            <a href="" data-toggle="modal" data-target="#exampleModal<?= $datos->id_personal ?>"
              class="btn btn-warning btn-sm"><i class="fa-solid fa-file-pen"></i></a>
            <a href="personal.php?id=<?= $datos->id_personal ?>" onclick="advertencia(event)" class="btn btn-sm"><i
                class="fa-solid fa-trash"></i></a>
          </td>
        </tr>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal<?= $datos->id_personal ?>" tabindex="-1"
          aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header d-flex justify-content-between">
                <h5 class="modal-title w-100" id="exampleModalLabel">Modificar personal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="" method="POST">
                  <div hidden class="fl-flex-label mb-4 px-2 col-12">
                    <input type="text" placeholder="Id" class="input input_text" name="txtid"
                      value="<?= $datos->id_personal ?>">
                  </div>
                  <div class="fl-flex-label mb-4 px-2 col-12">
                    <input type="text" placeholder="Nombre" onkeypress="return soloLetras(event)" class="input input_text"
                      name="txtnombre" value="<?= $datos->nombre ?>">
                  </div>
                  <div class="fl-flex-label mb-4 px-2 col-12">
                    <input type="text" placeholder="Apellido Paterno" onkeypress="return soloLetras(event)"
                      class="input input_text" name="txtapellidopaterno" value="<?= $datos->apellido_paterno ?>">
                  </div>
                  <div class="fl-flex-label mb-4 px-2 col-12">
                    <input type="text" placeholder="Apellido Materno" onkeypress="return soloLetras(event)"
                      class="input input_text" name="txtapellidomaterno" value="<?= $datos->apellido_materno ?>">
                  </div>
                  <div class="fl-flex-label mb-4 px-2 col-12">
                    <input type="text" placeholder="Dni" onkeypress="return numeros(event)" class="input input_text"
                      name="txtdni" maxlength="8" value="<?= $datos->dni ?>">
                  </div>
                  <div class="fl-flex-label mb-4 px-2 col-12">
                    <select name="txtcargo" class="input input__select">
                      <?php
                      $sql2 = $conexion->query(" select * from cargo");
                      while ($datos2 = $sql2->fetch_object()) { ?>
                        <option <?= $datos->cargo == $datos2->id_cargo ? 'selected' : '' ?> value="<?= $datos2->id_cargo ?>">
                          <?= $datos2->nombre ?></option>
                      <?php }
                      ?>
                    </select>
                  </div>
                  <div class="text-right p-4">
                    <a href="personal.php" class="btn btn-secondary btn-rounded">Atras</a>
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
  function soloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "abcdefghijklmnopqrstuvwxyz";
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

<script>
  function numeros(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " 0123456789";
    especiales = [8, 37, 39, 46];

    tecla_especial = false
    for (var i in especiales) {
      if (key == especiales[i]) {
        tecla_especial = true;
        break;
      }
    }

    if (letras.indexOf(tecla) == -1 && !tecla_especial)
      return false;
  }
</script>

<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>