<?php
  
  if(isset($_POST['stupdcar']))
{
    $idcar = $_POST['txtidcag'];
    $nomcar = $_POST['txtnacag'];
    $estado = $_POST['txtest'];
    try {

        $query = "UPDATE cargo SET nomcar=:nomcar, estado=:estado WHERE idcar=:idcar LIMIT 1";
        $statement = $connect->prepare($query);

        $data = [
            ':nomcar' => $nomcar,
            ':estado' => $estado,
            
            ':idcar' => $idcar
        ];
        $query_execute = $statement->execute($data);

        if($query_execute)
        {

         echo '<script type="text/javascript">
swal("¡Actualizado!", "Actualizado correctamente", "success").then(function() {
            window.location = "../cargo/mostrar.php";
        });
        </script>';

            exit(0);
        }
        else
        {
           echo '<script type="text/javascript">
swal("Error!", "Error al actualizar", "error").then(function() {
            window.location = "../cargo/mostrar.php";
        });
        </script>';
            exit(0);
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


?>