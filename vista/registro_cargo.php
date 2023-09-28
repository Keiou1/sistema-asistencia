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

  <h4 class="text-center text-secondary">REGISTRO DE CARGOS</h4>

  <?php
  include "../modelo/conexion.php";
  include "../controlador/registrar_cargo.php"
    ?>


  <div class="row">
    <form action="" method="POST">
      <div class="fl-flex-label mb-4 px-2 col-12">
        <input type="text" placeholder="Nombre" onkeypress="return soloLetrasNumeros(event)" class="input input_text"
          maxlength="100" name="txtnombre">
      </div>

      <div class="text-right p-4">
        <a href="cargo.php" class="btn btn-secondary btn-rounded">Atras</a>
        <button type="submit" value="ok" name="btnregistrar" class="btn btn-primary btn-rounded">Registrar</button>
      </div>

    </form>

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