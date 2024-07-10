<?php
require_once "../controladores/CalificacionController.php";
$cc = new CalificacionController();
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$calificacion = '';
$comentario = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $id = intval($_POST['id']);
    $calificacion = $_POST['calificacion'];
    $comentario = $_POST['comentario'];
    
    $resultado = $cc->editar($id, $calificacion, $comentario); 
    if ($resultado) {
        header("Location: calificacionMostrar.php"); 
        exit();
    } else {
        echo "<p>Error al actualizar la calificación.</p>";
    }
} else {
    $calificacionData = $cc->buscar($id);
    if ($calificacionData) {
        $calificacion = $calificacionData['puntaje'];
        $comentario = $calificacionData['comentario'];
    } else {
        echo "<p>Calificación no encontrada.</p>";
        exit;
    }
}
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $id; ?>">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <label for="calificacion">Calificación:</label>
    <input type="number" name="calificacion" value="<?php echo $calificacion; ?>" required><br>
    <label for="comentario">Comentario:</label>
    <input type="text" name="comentario" value="<?php echo $comentario; ?>" required><br>
    <input type="submit" name="submit" value="Actualizar">
</form>
