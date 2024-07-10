<?php
require_once "../layouts/header.php";
require_once "../controladores/CalificacionController.php";

$cc = new CalificacionController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $puntaje = $_POST['calificacion'];
    $comentario = $_POST['comentario'];

    $cc->guardar($puntaje, $comentario);

    header("Location: calificacionMostrar.php");
    exit;
}
?>

<div class="container d-flex justify-content-center align-items-center w-100 h-100">
    <div class="container rounded-4 shadow-sm col-lg-6 col-md-12 p-4" style="background-color: white;">
        <h1 class="mb-4 fs-5">Agregar Calificación</h1>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="calificacion">Calificación</label>
                <input type="number" class="form-control" id="calificacion" name="calificacion" required>
            </div>
            <div class="mb-3">
                <label for="comentario">Comentario</label>
                <input type="text" class="form-control" id="comentario" name="comentario" required>
            </div>
            <div class="d-flex justify-content-end pt-2 gap-2">
                <a href="calificacionMostrar.php" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>
        </form>
    </div>
</div>