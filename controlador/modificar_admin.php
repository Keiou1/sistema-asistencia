<?php
if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["txtid"]) and !empty($_POST["txtnombre"]) and !empty($_POST["txtapellidos"]) and !empty($_POST["txtpuesto"]) and !empty($_POST["txtcorreo"]) and !empty($_POST["txttelefono"]) and !empty($_POST["txtusuario"])) {
        $nombre = $_POST["txtnombre"]; 
        $apellidos = $_POST["txtapellidos"];
        $puesto = $_POST["txtpuesto"];
        $correo = $_POST["txtcorreo"];
        $telefono = $_POST["txttelefono"];
        $usuario = $_POST["txtusuario"];
        $id = $_POST["txtid"];
        $sql = $conexion->query(" select count(*) as 'total' from admin where usuario = '$usuario' and id_admin!=$id");
        if ($sql->fetch_object()->total > 0) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "ERROR",
                        type: "error",
                        text: "El usuario <?= $usuario ?> ya existe",
                        styling: "bootstrap3"
                    })
                })  
            </script>
        <?php } else {
            $modificar = $conexion->query(" update admin set nombre='$nombre', apellidos='$apellidos', puesto='$puesto', correo='$correo', telefono='$telefono', usuario='$usuario' where id_admin=$id ");
            if ($modificar == true) { ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "Los datos del Administrador se han modificado correctamente",
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
                            text: "Error al modificar datos de Administrador",
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