

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Destinatario</title>
</head>
<form method="POST" action=<?php echo $_SERVER["PHP_SELF"]; ?>>
    <label for="nombres">Nombres:</label><br>
    <input type="text" name="nombresDesti"><br><br>
        
    <label for="apellidos">Apellidos:</label><br>
    <input type="text" name="apellidosDesti" ><br><br>
        
    <label for="email">Email:</label><br>
    <input type="email"name="emailDesti" ><br><br>
        
    <label for="numero">Número:</label><br>
    <input type="text" name="numeroDesti" ><br><br>
        
    <input type="submit" value="Actualizar">
</form>
<?
if(isset($_POST["submit"])){
    $nombresDesti = $_POST["nombresDesti"];
    $apellidosDesti = $_POST["apellidosDesti"];
    $emailDesti = $_POST["emailDesti"];
    $numeroDesti = $_POST["numeroDesti"];
    require_once "controladores/DestinatarioControlador.php";
    $controller ->actualizarDestinatario($id,$nombresDesti,$apellidosDesti,$emailDesti,$numeroDesti);

    header("Location: destinatarioMostrar.php");
}



?>

