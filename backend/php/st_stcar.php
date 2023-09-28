<?php  
require_once('../../backend/bd/ctconex.php');
 if(isset($_POST['staddcar']))
 {
  
    $nomcar=$_POST['txtnacag'];
    $estado=$_POST['txtest'];
    
  if(empty($nomcar)){
   $errMSG = "Please enter your inicio.";
  }

  $stmt = "SELECT * FROM cargo  WHERE nomcar='$nomcar'";


   if(empty($nomcar)) {
             echo '<script type="text/javascript">
swal("Error!", "Ya existe el registro a agregar!", "error").then(function() {
            window.location = "../cargo/mostrar.php";
        });
        </script>';
         }

         else
         {  // Validaremos primero que el document no exista
            $sql="SELECT * FROM cargo  WHERE nomcar='$nomcar'";
            

            $stmt = $connect->prepare($sql);
            $stmt->execute();

            if ($stmt->fetchColumn() == 0) // Si $row_cnt es mayor de 0 es porque existe el registro
            {
                if(!isset($errMSG))
  {
   $stmt = $connect->prepare("INSERT INTO cargo(nomcar, estado) VALUES(:nomcar, :estado)");
   $stmt->bindParam(':nomcar',$nomcar);
   $stmt->bindParam(':estado',$estado);
   if($stmt->execute())
   {
    echo '<script type="text/javascript">
swal("¡Registrado!", "Agregado correctamente", "success").then(function() {
            window.location = "../cargo/mostrar.php";
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