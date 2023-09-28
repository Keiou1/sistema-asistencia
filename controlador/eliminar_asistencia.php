<?php
if (!empty($_GET["id"])) {
    $id=$_GET["id"];
    $sql=$conexion->query(" delete from asistencia where id_asistencia=$id ");
    if ($sql == true) {?>
        <script>
            $(function notificacion(){
                new PNotify({
                    title:"CORRECTO", 
                    type: "success",
                    text: "Datos de la asistencia eliminado de manera correcta",
                    styling: "bootstrap3"
                })
            })
        </script>
    <?php } else { ?>
        <script>
            $(function notificacion(){
                new PNotify({
                    title:"INCORRECTO", 
                    type: "error",
                    text: "Error al eliminar datos de la asistencia",
                    styling: "bootstrap3"
                })
            })
        </script>
<?php } ?>

<script>
    setTimeout(() => {
       window.history.replaceState(null,null,window.location.pathname); 
    }, 0);
</script>

<?php }
