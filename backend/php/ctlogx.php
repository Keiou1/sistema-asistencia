<?php 
    require '../backend/bd/ctconex.php';

    if(isset($_POST['ctxlog'])) {
    $errMsg = '';

    // Get data from FORM
    $usuario = $_POST['usuario'];
    
    $clave = MD5($_POST['clave']);

    if($usuario == '')
      $errMsg = 'Digite su usuario';
    if($clave == '')
      $errMsg = 'Digite su contraseña';

    if($errMsg == '') {
      try {
$stmt = $connect->prepare('SELECT id, nombre,usuario, email,clave, cargo,estado FROM usuarios WHERE usuario = :usuario');


        $stmt->execute(array(
          ':usuario' => $usuario
          
          
          ));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if($data == false){
          $errMsg = "El nombre de usuario: $usuario no se encuentra , puede solicitarlo con el administrador.";
        }
        else {
          if($clave == $data['clave']) {

            $_SESSION['id'] = $data['id'];
            $_SESSION['nombre'] = $data['nombre'];
            $_SESSION['usuario'] = $data['usuario'];
            
            $_SESSION['email'] = $data['email'];
            $_SESSION['clave'] = $data['clave'];
            $_SESSION['cargo'] = $data['cargo'];
            $_SESSION['estado'] = $data['estado'];
            
    

          if($_SESSION['cargo'] == 1){
                header('Location: administrador/escritorio.php');
              }
                  exit;
                }
                  else
            $errMsg = 'Contraseña incorrecta.';
        }
      }
      catch(PDOException $e) {
        $errMsg = $e->getMessage();
      }
    }
  }
 ?>