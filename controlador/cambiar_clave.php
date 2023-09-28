<?php
if (!empty($_POST["btnactualizar"])) {
    if (!empty($_POST["txtactual"]) and !empty($_POST["txtnueva"]) and !empty($_POST["txtnueva2"]) and !empty($_POST["txtid"])) {
        $claveactual = md5($_POST["txtactual"]);
        $clavenueva = md5($_POST["txtnueva"]);
        $clavenueva2 = md5($_POST["txtnueva2"]);
        $id = $_POST["txtid"];

        if ($clavenueva == $clavenueva2) {
            $verificarClaveActual = $conexion->query(" select password from admin where id_admin = $id");
            if ($verificarClaveActual->fetch_object()->password == $claveactual) {
                $sql = $conexion->query("update admin set password='$clavenueva' where id_admin=$id");
                if ($sql == true) { ?>
                    <script>
                        $(function notificacion() {
                            new PNotify({
                                title: "ACTUALIZADO",
                                type: "success",
                                text: "La contraseña se ha modificado de manera correcta",
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
                                text: "Error al modificar la contraseña",
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
                            text: "La contraseña actual es incorrecta",
                            styling: "bootstrap3"
                        })
                    })
                </script>
            <?php }
        } else { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "UPS!!",
                        type: "error",
                        text: "La contraseña nueva no coincide",
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
                    text: "Los campos estan vacios",
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