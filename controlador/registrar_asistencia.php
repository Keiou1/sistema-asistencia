<?php
if (!empty($_POST["btnentrada"])) {

    if (!empty($_POST["txtdni"])) {
        $dni = $_POST["txtdni"];

        $consulta = $conexion->query(" select count(*) as 'total' from personal where dni = '$dni'");
        $id = $conexion->query(" select id_personal from personal where dni = '$dni'");
        if ($consulta->fetch_object()->total > 0) {

            $fecha = date("Y-m-d h:i:s");
            $id_personal = $id->fetch_object()->id_personal;

            $consultafecha = $conexion->query(" select entrada from asistencia where id_personal=$id_personal order by id_asistencia desc limit 1");
            $fechaBD = $consultafecha->fetch_object()->entrada;

            if (substr($fecha, 0, 10) == substr($fechaBD, 0, 10)) { ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "ERROR",
                            type: "error",
                            text: "Ya registraste tu entrada",
                            styling: "bootstrap3"
                        })
                    })
                </script>
            <?php } else {
                $sql = $conexion->query(" insert into asistencia(id_personal,entrada) values($id_personal,'$fecha') ");
                if ($sql == true) { ?>
                    <script>
                        $(function notificacion() {
                            new PNotify({
                                title: "BIENVENIDO",
                                type: "success",
                                text: "Gracias por tu asistencia",
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
                                text: "Error al registrar entrada",
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
                        title: "INCORRECTO",
                        type: "error",
                        text: "El Dni ingresado no existe",
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
                    text: "Ingrese el Dni",
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

<!--REGISTRO DE SALIDA-->

<?php
if (!empty($_POST["btnsalida"])) {

    if (!empty($_POST["txtdni"])) {
        $dni = $_POST["txtdni"];

        $consulta = $conexion->query(" select count(*) as 'total' from personal where dni = '$dni'");
        $id = $conexion->query(" select id_personal from personal where dni = '$dni'");
        if ($consulta->fetch_object()->total > 0) {

            $fecha = date("Y-m-d h:i:s");
            $id_personal = $id->fetch_object()->id_personal;
            $busqueda = $conexion->query(" select id_asistencia,entrada from asistencia where id_personal=$id_personal order by id_asistencia desc limit 1 ");

            while ($datos = $busqueda->fetch_object()) {
                $id_asistencia = $datos->id_asistencia;
                $entradaBD = $datos->entrada;
            }

            if (substr($fecha, 0, 10) != substr($entradaBD, 0, 10)) { ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "ERROR",
                            type: "error",
                            text: "Primero debes ingresar tu entrada",
                            styling: "bootstrap3"
                        })
                    })
                </script>
            <?php } else {
                $consultafecha = $conexion->query(" select salida from asistencia where id_personal=$id_personal order by id_asistencia desc limit 1");
                $fechaBD = $consultafecha->fetch_object()->salida;
                if (substr($fecha, 0, 10) == substr($fechaBD, 0, 10)) { ?>
                    <script>
                        $(function notificacion() {
                            new PNotify({
                                title: "ERROR",
                                type: "error",
                                text: "Ya registraste tu salida",
                                styling: "bootstrap3"
                            })
                        })
                    </script>
                <?php } else {
                    $sql = $conexion->query(" update asistencia set salida='$fecha' where id_asistencia=$id_asistencia");
                    if ($sql == true) { ?>
                        <script>
                            $(function notificacion() {
                                new PNotify({
                                    title: "ADIOS VUELVE PRONTO",
                                    type: "success",
                                    text: "Gracias por marcar su salida",
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
                                    text: "Error al registrar su salida",
                                    styling: "bootstrap3"
                                })
                            })
                        </script>
                    <?php }
                }
            }
        } else { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "INCORRECTO",
                        type: "error",
                        text: "El Dni ingresado no existe",
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
                    text: "Ingrese el Dni",
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