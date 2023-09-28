<?php
if (!empty($_POST["btnmodificar"])) {
    if (!empty($_POST["txtid"] and !empty($_POST["txtnombre"]) and !empty($_POST["txttelefono"]) and !empty($_POST["txtubicacion"]) and !empty($_POST["txtprovincia"]) and !empty($_POST["txtciudad"]) and !empty($_POST["txturl"]) and !empty($_POST["txtruc"]))) {
        $id = $_POST["txtid"];
        $nombre = $_POST["txtnombre"];
        $telefono = $_POST["txttelefono"];
        $ubicacion = $_POST["txtubicacion"];
        $provincia = $_POST["txtprovincia"];
        $ciudad = $_POST["txtciudad"];
        $url = $_POST["txturl"];
        $ruc = $_POST["txtruc"];

        $sql = $conexion->query(" update empresa set nombre='$nombre', telefono='$telefono', ubicacion='$ubicacion', provincia='$provincia', ciudad='$ciudad', url='$url', ruc='$ruc' where id_empresa=$id");
        if ($sql == true) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "CORRECTO",
                        type: "success",
                        text: "Los datos de la empresa se ha modificado correctamente",
                        styling: "bootstrap3"
                    })
                })
            </script>
        <?php } else { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "INCORRECTO",
                        type: "error",
                        text: "Error al modificar datos de la empresa",
                        styling: "bootstrap3"
                    })
                })
            </script>
        <?php }
    } else { ?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "ERROR",
                    type: "error",
                    text: "Complete todos los datos",
                    styling: "bootstrap3"
                })
            })
        </script>
    <?php } ?>

    <script>
        setTimeout(() => {
            window.history.replaceState(null, null, window.location.pathname);
        }, 0);
    </script>

<?php }
?>