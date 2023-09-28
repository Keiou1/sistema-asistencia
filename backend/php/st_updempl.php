<?php
  
  if(isset($_POST['stupdempl']))
{
    $idemp = $_POST['txtidemp'];
    $dniem = $_POST['txtnume'];
    $nomem = $_POST['txtnome'];
    $apeem = $_POST['txtapell'];
    $naci = $_POST['txtnac'];
    $celu = $_POST['txtcel'];
    $idcar = $_POST['txtcar'];
    $estado = $_POST['txtest'];

    try {

        $query = "UPDATE empleado SET dniem=:dniem, nomem=:nomem,apeem=:apeem,idcar=:idcar,naci=:naci,celu=:celu,estado=:estado WHERE idemp=:idemp LIMIT 1";
        $statement = $connect->prepare($query);

        $data = [
            ':dniem' => $dniem,
            ':nomem' => $nomem,
            ':apeem' => $apeem,
            ':idcar' => $idcar,
            ':naci' => $naci,
            ':celu' => $celu,
            ':estado' => $estado,
            
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