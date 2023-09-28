<?php
if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["txtid"]) and !empty($_POST["txtnombre"]) and !empty($_POST["txtapellidopaterno"]) and !empty($_POST["txtapellidomaterno"]) and !empty($_POST["txtdni"]) and !empty($_POST["txtcargo"])) {
        $id = $_POST["txtid"];
        $nombre = $_POST["txtnombre"];
        $apellidopaterno = $_POST["txtapellidopaterno"];
        $apellidomaterno = $_POST["txtapellidomaterno"];
        $dni = $_POST["txtdni"];
        $cargo = $_POST["txtcargo"];
        $sql = $conexion->query(" select count(*) as 'total' from personal where dni = '$dni' and id_personal!=$id ");
        if ($sql->fetch_object()->total > 0) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "ERROR",
                        type: "error",
                        text: "El Dni <?= $dni ?> ya existe",
                        styling: "bootstrap3"
                    })
                })
            </script>
        <?php } else {
            $modificar = $conexion->query(" update personal set nombre='$nombre', apellido_paterno='$apellidopaterno', apellido_materno='$apellidomaterno', dni='$dni', cargo=$cargo  where id_personal=$id ");
            if ($modificar == true) { ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "Los datos del personal se han modificado correctamente",
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
                            text: "Error al modificar datos del personal",
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
                    text: "Complete todos los campos",
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