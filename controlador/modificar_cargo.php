<?php
if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["txtid"]) and !empty($_POST["txtnombre"])) {
        $nombre = $_POST["txtnombre"];
        $id = $_POST["txtid"];

        $sql = $conexion->query(" select count(*) as 'total' from cargo where nombre = '$nombre' and id_cargo!=$id");
        if ($sql->fetch_object()->total > 0) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "ERROR",
                        type: "error",
                        text: "El cargo <?= $nombre ?> ya existe",
                        styling: "bootstrap3"
                    })
                })
            </script>
        <?php } else {
            $modificar = $conexion->query(" update cargo set nombre='$nombre' where id_cargo=$id ");
            if ($modificar == true) { ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "Los nombre del cargo se ha modificado correctamente",
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
                            text: "Error al modificar datos del cargo",
                            styling: "bootstrap3"
                        })
                    })
                </script>
            <?php }

        }

    } else { ?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "ERROR",
                    type: "error",
                    text: "El campo esta vacio",
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