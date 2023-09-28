<?php
  

  if(isset($_POST['stupdprofpsd']))
{
    $id = $_POST['txtidadm'];
    $clave=MD5($_POST['txtnew']);

    try {

        $query = "UPDATE usuarios SET  clave=:clave WHERE id=:id LIMIT 1";
        $statement = $connect->prepare($query);

        $data = [
            ':clave' => $clave,
            ':id' => $id
        ];
        $query_execute = $statement->execute($data);

        if($query_execute)
        {

         echo '<script type="text/javascript">
swal("¡Actualizado!", "Contraseña actualizada correctamente", "success").then(function() {
            window.location = "../configuracion/configuracion.php";
        });
        </script>';

            exit(0);
        }
        else
        {
           echo '<script type="text/javascript">
swal("Error!", "Error al actualizar", "error").then(function() {
            window.location = "../configuracion/configuracion.php";
        });
        </script>';
            exit(0);
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


?>