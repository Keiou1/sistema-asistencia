<?php
  
  if(isset($_POST['stdelcar']))
{
    $idcar = $_POST['txtidcag'];
    
    try {

        $query = "UPDATE cargo SET  estado='Inactivo' WHERE idcar=:idcar LIMIT 1";
        $statement = $connect->prepare($query);

        $data = [
            
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