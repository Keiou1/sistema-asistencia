<?php

session_start();

if (!empty($_POST["btningresar"])) {
    if (!empty($_POST["usuario"]) and !empty($_POST["password"])) {
        $usuario = $_POST["usuario"];
        $password = md5($_POST["password"]);
        $campos = array();
        $sql = $conexion->query(" select * from admin where usuario='$usuario' and password='$password' ");
        if (isset($_COOKIE["block" . $usuario])) {
            echo "<div class ='alert alert-danger'> El Usuario $usuario esta bloqueado por 5 minutos </div>";
        } else {
            if ($datos = $sql->fetch_object()) {
                $_SESSION["nombre"] = $datos->nombre;
                $_SESSION["apellidos"] = $datos->apellidos;
                $_SESSION["id"] = $datos->id_admin;
                header("location:../house.php");
            } else {
                echo "<div class ='alert alert-danger'> Usuario o clave incorrecta </div>";
                if (isset($_COOKIE["$usuario"])) {
                    $cont = $_COOKIE["$usuario"];
                    $cont++;
                    setcookie($usuario, $cont, time() + 120);
                    if ($cont >= 3) {
                        setcookie("block" . $usuario, $cont, time() + 300);
                    }
                    if ($cont == 2) {
                        echo "<div class ='alert alert-danger'> Al 3er intento incorrecto el usuario sera bloqueado por 5 minutos </div>";
                    }
                } else {
                    setcookie($usuario, 1, time() + 120);
                }

            }
        }
    } else {
        if ($_POST["usuario"] == "") {
            echo "<div class ='alert alert-danger'> El campo usuario esta vacio </div>";
        }
        if ($_POST["password"] == "") {
            echo "<div class ='alert alert-danger'> El campo password esta vacio </div>";
        }
    }
}

?>