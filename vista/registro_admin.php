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

  <h4 class="text-center text-secondary">REGISTRO DE ADMINISTRADORES</h4>

  <?php
  include "../modelo/conexion.php";
  include "../controlador/registrar_admin.php"
    ?>

  <div class="row">
    <form action="" method="POST">
      <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
        <input type="text" placeholder="Nombre" onkeypress="return soloLetras(event)" class="input input_text"
          name="txtnombre">
      </div>
      <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
        <input type="text" placeholder="Apellidos" onkeypress="return soloLetras(event)" class="input input_text"
          name="txtapellidos">
      </div>
      <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
        <input type="text" placeholder="Puesto" onkeypress="return soloLetras(event)" class="input input_text"
          name="txtpuesto">
      </div>
      <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
        <input type="text" placeholder="Correo" class="input input_text" name="txtcorreo">
      </div>
      <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
        <input type="text" placeholder="Telefono" onkeypress="return numeros(event)" class="input input_text"
          minlength="7" maxlength="9" name="txttelefono">
      </div>
      <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
        <input type="text" placeholder="Usuario" onkeypress="return soloLetrasNumeros(event)" class="input input_text"
          maxlength="8" name="txtusuario">
      </div>
      <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
        <input type="password" placeholder="Password" class="input input_text" maxlength="10" name="txtpassword">
      </div>
      <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
        <input type="password" placeholder="Confirmar Password" class="input input_text" maxlength="10"
          name="txtpassword2">
      </div>
      <div class="text-center p-4">
        <a href="admin.php" class="btn btn-secondary btn-rounded">Atras</a>
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