<?php
if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["txtnombre"])) {
        $nombre = $_POST["txtnombre"];

        $sql = $conexion->query(" select count(*) as 'total' from cargo where nombre = '$nombre'");
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
            $registro = $conexion->query(" insert into cargo(nombre) values('$nombre') ");
            if ($registro == true) { ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "El nuevo cargo se ha registrado correctamente",
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
                            text: "Error al registrar el nuevo cargo",
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