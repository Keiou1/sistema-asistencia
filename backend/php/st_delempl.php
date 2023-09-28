<?php
  
  if(isset($_POST['studelempl']))
{
    $idemp = $_POST['txtidemp'];
    
    try {

        $query = "UPDATE empleado SET  estado='Inactivo' WHERE idemp=:idemp LIMIT 1";
        $statement = $connect->prepare($query);

        $data = [
            
            ':idemp' => $idemp
        ];
        $query_execute = $statement->execute($data);

        if($query_execute)
        {

         echo '<script type="text/javascript">
swal("¡Actualizado!", "Actualizado correctamente", "success").then(function() {
            window.location = "../empleado/mostrar.php";
        });
        </script>';

            exit(0);
        }
        else
        {
           echo '<script type="text/javascript">
swal("Error!", "Error al actualizar", "error").then(function() {
            window.location = "../empleado/mostrar.php";
        });
        </script>';
            exit(0);
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


?>