<?php
if(isset($_POST['staddasem'])){
///////////// Informacion enviada por el formulario /////////////
    $idemp=trim($_POST['txtemp']);
    $idasi=trim($_POST['txtasis']);
    $fere=trim($_POST['txtfec']);
    $estado=trim($_POST['txtest']);

///////// Fin informacion enviada por el formulario /// 

////////////// Insertar a la tabla la informacion generada /////////
$sql="insert into asis_empl(idasi,idemp,fere,estado) 
values(:idasi,:idemp,:fere,:estado)";
    
$sql = $connect->prepare($sql);
    
$sql->bindParam(':idasi',$idasi,PDO::PARAM_STR, 25);
$sql->bindParam(':idemp',$idemp,PDO::PARAM_STR, 25);
$sql->bindParam(':fere',$fere,PDO::PARAM_STR,25);
$sql->bindParam(':estado',$estado,PDO::PARAM_STR,25);

    
$sql->execute();

$lastInsertId = $connect->lastInsertId();
if($lastInsertId>0){
            echo '<script type="text/javascript">
swal("¡Registrado!", "Agregado correctamente", "success").then(function() {
            window.location = "../asistencia/mostrar.php";
        });
        </script>';

}
else{

        echo '<script type="text/javascript">
swal("Error!", "Error!", "error").then(function() {
            window.location = "../asistencia/mostrar.php";
        });
        </script>';

print_r($sql->errorInfo()); 
}
}// Cierra envio de guardado
?>