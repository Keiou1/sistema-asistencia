<?php
  
  if(isset($_POST['stupdprof']))
{
    $id = $_POST['txtidadm'];
    $nombre = $_POST['txtnaad'];
    $usuario = $_POST['txtusr'];
    $email = $_POST['txtcorr'];
    $cargo = $_POST['txtcarr'];
    $estado = $_POST['txtest'];
    try {

        $query = "UPDATE usuarios SET nombre=:nombre, usuario=:usuario,email=:email,cargo=:cargo,estado=:estado WHERE id=:id LIMIT 1";
        $statement = $connect->prepare($query);

        $data = [
            ':nombre' => $nombre,
            ':usuario' => $usuario,
            ':email' => $email,
            ':cargo' => $cargo,
            ':estado' => $estado,
            
            ':id' => $id
        ];
        $query_execute = $statement->execute($data);

        if($query_execute)
        {

         echo '<script type="text/javascript">
swal("¡Actualizado!", "Actualizado correctamente", "success").then(function() {
            window.location = "../configuracion/perfil.php";
        });
        </script>';

            exit(0);
        }
        else
        {
           echo '<script type="text/javascript">
swal("Error!", "Error al actualizar", "error").then(function() {
            window.location = "../configuracion/perfil.php";
        });
        </script>';
            exit(0);
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


?>