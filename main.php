
<?php
require_once "layouts/header.php";
    session_start();
    if(!isset($_SESSION["id"])){
        header("Location: vistas/Login/login.php");
    }
?>


<a href="../reparto-b2b/modelos/Logout.php">Salir</a>
