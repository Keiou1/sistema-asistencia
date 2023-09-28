<?php
session_start();
if (empty($_SESSION['nombre']) and empty($_SESSION['apellidos'])) {
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

  <h4 class="text-center text-secondary">REGISTRO DE PERSONAL</h4>

  <?php
  include "../modelo/conexion.php";
  include "../controlador/registrar_personal.php"
    ?>


  <div class="row">
    <form action="" method="POST">
      <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
        <input type="text" placeholder="Nombre" onkeypress="return soloLetras(event)" class="input input_text"
          name="txtnombre">
      </div>
      <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
        <input type="text" placeholder="Apellido Paterno" onkeypress="return soloLetras(event)" class="input input_text"
          name="txtapellidopaterno">
      </div>
      <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
        <input type="text" placeholder="Apellido Materno" onkeypress="return soloLetras(event)" class="input input_text"
          name="txtapellidomaterno">
      </div>
      <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
        <input type="text" placeholder="Dni" onkeypress="return numeros(event)" class="input input_text" name="txtdni"
          maxlength="8">
      </div>
      <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
        <select name="txtcargo" class="input input__select">
          <option value="">Seleccionar...</option>
          <?php
          $sql = $conexion->query("select * from cargo");
          while ($datos = $sql->fetch_object()) { ?>
            <option value="<?= $datos->id_cargo ?>"><?= $datos->nombre ?></option>
          <?php }
          ?>
        </select>
      </div>
      <div class="text-right p-4">
        <a href="personal.php" class="btn btn-secondary btn-rounded">Atras</a>
        <button type="submit" value="ok" name="btnregistrar" class="btn btn-primary btn-rounded">Registrar</button>
      </div>

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