<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery</title>
</head>
<body>
    <h1>Pagina Principal</h1>
</body>
</html>
<?php
    session_start();
    if(!isset($_SESSION["id"])){
        header("Location: vistas/Login/login.php");
    }
?>

<a href="../reparto-b2b/modelos/Logout.php">Salir</a>
