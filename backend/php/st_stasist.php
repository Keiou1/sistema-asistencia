<?php  
require_once('../../backend/bd/ctconex.php');
 if(isset($_POST['staddasis']))
 {
  
    $nomas=$_POST['txtnamea'];
    $estado=$_POST['txtest'];
    
  if(empty($nomas)){
   $errMSG = "Please enter your inicio.";
  }

  $stmt = "SELECT * FROM asistencia  WHERE nomas='$nomas'";


   if(empty($nomas)) {
             echo '<script type="text/javascript">
swal("Error!", "Ya existe el registro a agregar!", "error").then(function() {
            window.location = "../asistencia/mostrar.php";
        });
        </script>';
         }

         else
         {  // Validaremos primero que el document no exista
            $sql="SELECT * FROM asistencia  WHERE nomas='$nomas'";
            

            $stmt = $connect->prepare($sql);
            $stmt->execute();

            if ($stmt->fetchColumn() == 0) // Si $row_cnt es mayor de 0 es porque existe el registro
            {
                if(!isset($errMSG))
  {
   $stmt = $connect->prepare("INSERT INTO asistencia(nomas, estado) VALUES(:nomas, :estado)");
   $stmt->bindParam(':nomas',$nomas);
   $stmt->bindParam(':estado',$estado);
   if($stmt->execute())
   {
    echo '<script type="text/javascript">
swal("¡Registrado!", "Agregado correctamente", "success").then(function() {
            window.location = "../asistencia/mostrar.php";
        });
        </script>';
   }
   else
   {
    $errMSG = "error while inserting....";
   }

  } 
            }

                else{

                     echo '<script type="text/javascript">
swal("Error!", "ya existe el registro!", "error").then(function() {
            window.location = "../cargo/mostrar.php";
        });
        </script>';

 // if no error occured, continue ....

}
  

  }
 
 }
?>