<?php
if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["txtnombre"]) and !empty($_POST["txtapellidos"]) and !empty($_POST["txtpuesto"]) and !empty($_POST["txtcorreo"]) and !empty($_POST["txttelefono"]) and !empty($_POST["txtusuario"]) and !empty($_POST["txtpassword"]) and !empty($_POST["txtpassword2"])) {
        $nombre = $_POST["txtnombre"];
        $apellidos = $_POST["txtapellidos"];
        $puesto = $_POST["txtpuesto"];
        $correo = $_POST["txtcorreo"];
        $telefono = $_POST["txttelefono"];
        $usuario = $_POST["txtusuario"];
        $password = md5($_POST["txtpassword"]);
        $password2 = md5($_POST["txtpassword2"]);


        if ($password == $password2) {
            $sql = $conexion->query(" select count(*) as 'total' from admin where usuario = '$usuario'");
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
                $registro = $conexion->query(" insert into admin(nombre,apellidos,puesto,correo,telefono,usuario,password) values('$nombre','$apellidos','$puesto','$correo','$telefono','$usuario','$password') ");
                if ($registro == true) { ?>
                    <script>
                        $(function notificacion() {
                            new PNotify({
                                title: "CORRECTO",
                                type: "success",
                                text: "El administrador se ha registrado correctamente",
                                styling: "bootstrap3"
                            })
                        })
                    </script>
                <?php } else { ?>
                    <script>
                        $(function notificacion() {
                            new PNotify({
                                title: "ERROR",
                                type: "error",
                                text: "Error al registrar administrador",
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
                        title: "UPS!!",
                        type: "error",
                        text: "Las contraseñas no coinciden",
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