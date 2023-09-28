<?php
if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["txtnombre"]) and !empty($_POST["txtapellidopaterno"]) and !empty($_POST["txtapellidomaterno"]) and !empty($_POST["txtdni"]) and !empty($_POST["txtcargo"])) {
        $nombre = $_POST["txtnombre"];
        $apellidopaterno = $_POST["txtapellidopaterno"];
        $apellidomaterno = $_POST["txtapellidomaterno"];
        $dni = $_POST["txtdni"];
        $cargo = $_POST["txtcargo"];

        $sql = $conexion->query(" select count(*) as 'total' from personal where dni = '$dni'");
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
            $registro = $conexion->query(" insert into personal(nombre,apellido_paterno,apellido_materno,dni,cargo) values('$nombre','$apellidopaterno','$apellidomaterno','$dni',$cargo) ");
            if ($registro == true) { ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "El personal se ha registrado correctamente",
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
                            text: "Error al registrar personal",
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