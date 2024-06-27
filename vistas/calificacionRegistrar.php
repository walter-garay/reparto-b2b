<form method="post" action=<?php echo $_SERVER["PHP_SELF"]; ?>>
    <input type="number" name="calificacion" placeholder="Ingrese Calificacion"><br>
    <input type="text" name="comentario" placeholder="Ingrese Comentario"><br>
    <input type="submit" name="submit" value="submit">
</form>

<?php

if(isset($_POST["submit"])) {
    $calificacion = $_POST["calificacion"];
    $comentario = $_POST["comentario"];
    
    require_once '../controladores/CalificacionController.php';    
    $cc = new CalificacionController();
    $cc->guardar($calificacion, $comentario);
}