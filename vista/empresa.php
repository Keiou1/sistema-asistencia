<?php
session_start();
if (empty($_SESSION['nombre']) and empty($_SESSION['apellidos'])) {
  header('location:login/login.php');
}

?>

<style>
  ul li:nth-child(6) .activo {
    background: rgb(11, 150, 214) !important;
  }
</style>

<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

  <h4 class="text-center text-secondary">DATOS DE LA EMPRESA</h4>

  <?php
  include "../modelo/conexion.php";
  include "../controlador/modificar_empresa.php";
  $sql = $conexion->query("select * from empresa")
    ?>


  <div class="row">
    <form action="" method="POST">
      <?php
      while ($datos = $sql->fetch_object()) { ?>
        <div hidden class="fl-flex-label mb-4 px-2 col-12 col-md-6">
          <input type="text" placeholder="id" class="input input_text" name="txtid" value="<?= $datos->id_empresa ?>">
        </div>
        <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
          <input type="text" placeholder="Razon Social" class="input input_text" name="txtnombre" readonly="readonly"
            value="<?= $datos->nombre ?>">
        </div>
        <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
          <input type="text" placeholder="Telefono" class="input input_text" name="txttelefono" readonly="readonly"
            value="<?= $datos->telefono ?>">
        </div>
        <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
          <input type="text" placeholder="Provincia" class="input input_text" name="txtprovincia" readonly="readonly"
            value="<?= $datos->provincia ?>">
        </div>
        <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
          <input type="text" placeholder="Distrito" class="input input_text" name="txtciudad" readonly="readonly"
            value="<?= $datos->ciudad ?>">
        </div>
        <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
          <input type="text" placeholder="Ubicacion" class="input input_text" name="txtubicacion" readonly="readonly"
            value="<?= $datos->ubicacion ?>">
        </div>
        <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
          <input type="text" placeholder="RUC" class="input input_text" name="txtruc" readonly="readonly"
            value="<?= $datos->ruc ?>">
        </div>
        <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
          <input type="text" placeholder="URL" class="input input_text" name="txturl" readonly="readonly"
            value="<?= $datos->url ?>">
        </div>
        <div class="text-right p-4">
          <!-- <a href="admin.php" class="btn btn-secondary btn-rounded">Atras</a> -->
          <a href="" data-toggle="modal" data-target="#exampleModal<?= $datos->id_empresa ?>"
            class="btn btn-primary btn-rounded">Modificar</a>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal<?= $datos->id_empresa ?>" tabindex="-1"
          aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header d-flex justify-content-between">
                <h5 class="modal-title w-100" id="exampleModalLabel">Modificar Datos Empresa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="" method="POST">
                  <div hidden class="fl-flex-label mb-4 px-2 col-12">
                    <input type="text" placeholder="Id" class="input input_text" name="txtid"
                      value="<?= $datos->id_empresa ?>">
                  </div>
                  <div class="fl-flex-label mb-4 px-2 col-12">
                    <input type="text" placeholder="Nombre" onkeypress="return soloLetras(event)" class="input input_text"
                      name="txtnombre" value="<?= $datos->nombre ?>">
                  </div>
                  <div class="fl-flex-label mb-4 px-2 col-12">
                    <input type="text" placeholder="Telefono" onkeypress="return numeros(event)" class="input input_text"
                      name="txttelefono" maxlength="9" value="<?= $datos->telefono ?>">
                  </div>
                  <div class="fl-flex-label mb-4 px-2 col-12">
                    <input type="text" placeholder="Provincia" onkeypress="return soloLetras(event)"
                      class="input input_text" name="txtprovincia" value="<?= $datos->provincia ?>">
                  </div>
                  <div class="fl-flex-label mb-4 px-2 col-12">
                    <input type="text" placeholder="Ciudad" onkeypress="return soloLetras(event)" class="input input_text"
                      name="txtciudad" value="<?= $datos->ciudad ?>">
                  </div>
                  <div class="fl-flex-label mb-4 px-2 col-12">
                    <input type="text" placeholder="Ubicacion" class="input input_text" name="txtubicacion"
                      value="<?= $datos->ubicacion ?>">
                  </div>
                  <div class="fl-flex-label mb-4 px-2 col-12">
                    <input type="text" placeholder="RUC" onkeypress="return numeros(event)" class="input input_text"
                      name="txtruc" maxlength="11" value="<?= $datos->ruc ?>">
                  </div>
                  <div class="fl-flex-label mb-4 px-2 col-12">
                    <input type="text" placeholder="URL" class="input input_text" name="txturl"
                      value="<?= $datos->url ?>">
                  </div>
                  <div class="text-right p-4">
                    <a href="empresa.php" class="btn btn-secondary btn-rounded">Atras</a>
                    <button type="submit" value="ok" name="btnmodificar"
                      class="btn btn-primary btn-rounded">Modificar</button>
                  </div>

                </form>
              </div>
            </div>
          </div>

        <?php }
      ?>

    </form>

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