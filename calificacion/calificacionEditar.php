<?php
require_once "../../layouts/header.php";
require_once "../../controladores/CalificacionController.php";

$cc = new CalificacionController();
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$calificacion = '';
$comentario = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $id = intval($_POST['id']);
    $puntaje = $_POST['calificacion'];
    $comentario = $_POST['comentario'];

    $resultado = $cc->editar($id, $puntaje, $comentario);
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

<div class="container d-flex justify-content-center align-items-center w-100 h-100">
    <div class="container rounded-4 shadow-sm col-lg-6 col-md-12 p-4" style="background-color: white;">
        <h1 class="mb-4 fs-5">Editar Calificación #<?php echo $id?></h1>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $id; ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="mb-3">
                <label for="calificacion">Calificación</label>
                <input type="number" class="form-control" id="calificacion" name="calificacion" value="<?php echo $calificacion; ?>" required>
            </div>
            <div class="mb-3">
                <label for="comentario">Comentario</label>
                <input type="text" class="form-control" id="comentario" name="comentario" value="<?php echo $comentario; ?>" required>
            </div>
            <div class="d-flex justify-content-end pt-2 gap-2">
                <a href="calificacionMostrar.php" class="btn btn-secondary">Cancelar</a>
                <button type="submit" name="submit" class="btn btn-primary">Guardar cambios</button>
            </div>
        </form>
    </div>
</div>
