<?php
  
  if(isset($_POST['stdelasis']))
{
    $idasi = $_POST['txtida'];
    
    try {

        $query = "UPDATE asistencia SET  estado='Inactivo' WHERE idasi=:idasi LIMIT 1";
        $statement = $connect->prepare($query);

        $data = [
            
            ':idasi' => $idasi
        ];
        $query_execute = $statement->execute($data);

        if($query_execute)
        {

         echo '<script type="text/javascript">
swal("¡Actualizado!", "Actualizado correctamente", "success").then(function() {
            window.location = "../asistencia/mostrar.php";
        });
        </script>';

            exit(0);
        }
        else
        {
           echo '<script type="text/javascript">
swal("Error!", "Error al actualizar", "error").then(function() {
            window.location = "../asistencia/mostrar.php";
        });
        </script>';
            exit(0);
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


?>