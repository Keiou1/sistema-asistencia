<?php
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asistencia</title>
    <link rel="stylesheet" href="public/estilos/estilos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,300;6..12,400&display=swap"
        rel="stylesheet">
    <link rel="shortcut icon" href="backend/img/romboazul.svg" />
    <!-- pNotify -->
    <link href="public/pnotify/css/pnotify.css" rel="stylesheet" />
    <link href="public/pnotify/css/pnotify.buttons.css" rel="stylesheet" />
    <link href="public/pnotify/css/custom.min.css" rel="stylesheet" />
    <!-- pnotify -->
    <script src="public/pnotify/js/jquery.min.js">
    </script>
    <script src="public/pnotify/js/pnotify.js">
    </script>
    <script src="public/pnotify/js/pnotify.buttons.js">
    </script>
</head>

<body>
    <?php
    date_default_timezone_set("America/Lima");
    ?>
    <h1>Bienvenido, por favor registre su asistencia</h1>
    <div class="image">
        <img src="public/images/romboazul.png" class="img-inicio" alt="">
    </div>
    <h2 id="fecha">
        <?= date("d/m/Y, h:i:s") ?>
    </h2>
    <?php
    include "modelo/conexion.php";
    include "controlador/registrar_asistencia.php"
        ?>
    <div class="container">
        <a class="acceso" href="vista/login/login.php">Ingresar al sistema</a>
        <p class="dni">Ingrese su DNI</p>
        <form action="" method="POST">
            <input type="text" placeholder="Ingresar DNI" onkeypress="return numeros(event)" name="txtdni"
                maxlength="8">
            <div class="botones">

                <button class="entrada" type="submit" name="btnentrada" value="ok">Entrada</button>
                <button class="salida" type="submit" name="btnsalida" value="ok">Salida</button>
            </div>
        </form>
    </div>


    <script>
        setInterval(() => {
            let fecha = new Date();
            let fechaHora = fecha.toLocaleString();
            document.getElementById("fecha").textContent = fechaHora;
        }, 1000);
    </script>

    <script src="js/fontawesome.js"></script>
    <script src="js/main.js"></script>
    <script src="js/main2.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.bundle.js"></script>

    <script>
        function numeros(e) {
            key = e.keyCode || e.which;
            tecla = String.fromCharCode(key).toLowerCase();
            letras = " 0123456789";
            especiales = [8, 37, 39, 46];

            tecla_especial = false
            for (var i in especiales) {
                if (key == especiales[i]) {
                    tecla_especial = true;
                    break;
                }
            }

            if (letras.indexOf(tecla) == -1 && !tecla_especial)
                return false;
        }
    </script>

</body>

</html>