<?php
if(isset($_POST['staddasist'])){
///////////// Informacion enviada por el formulario /////////////
    $idemp=trim($_POST['titulo']);
    $idasi=trim($_POST['txtass']);
    $fere=trim($_POST['txtora']);


///////// Fin informacion enviada por el formulario /// 

////////////// Insertar a la tabla la informacion generada /////////
$sql="insert into asis_empl(idasi,idemp,fere,estado) 
values(:idasi,:idemp,:fere,'Activo')";
    
$sql = $connect->prepare($sql);
    
$sql->bindParam(':idasi',$idasi,PDO::PARAM_STR, 25);
$sql->bindParam(':idemp',$idemp,PDO::PARAM_STR, 25);
$sql->bindParam(':fere',$fere,PDO::PARAM_STR,25);


    
$sql->execute();

$lastInsertId = $connect->lastInsertId();
if($lastInsertId>0){
            echo '<script type="text/javascript">
swal("¡Registrado!", "Se tomo la asistencia correctamente", "success").then(function() {
            window.location = "../administrador_empleado/index.php";
        });
        </script>';

}
else{

        echo '<script type="text/javascript">
swal("Error!", "Error!", "error").then(function() {
            window.location = "../administrador_empleado/index.php";
        });
        </script>';

print_r($sql->errorInfo()); 
}
}// Cierra envio de guardado
?>