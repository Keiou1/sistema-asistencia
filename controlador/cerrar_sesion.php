<?php
session_start();
session_destroy();
header("location:../vista/login/login.php");
?>