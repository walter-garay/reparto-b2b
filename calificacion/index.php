<?php
require_once "../layouts/header.php";
require_once "../controladores/CalificacionController.php";

$cc = new CalificacionControlador();
$calificaciones = $cc->obtenerCalificaciones();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $resultado = $cc->eliminar($_POST['id']);
    if ($resultado) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}
?>

<div class="container pt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="fs-5 mb-0">Calificaciones</h1>
        <a href="calificacionRegistrar.php" class="rounded-2 btn btn-primary btn-sm">Agregar Calificación</a>
    </div>

    <div class="table-responsive table-bordered">
        <table class="table rounded-circle">
            <thead class="table" style="background-color: aqua;">
                <tr>
                    <th class="fw-medium" scope="col">#</th>
                    <th class="fw-medium" scope="col">Calificación</th>
                    <th class="fw-medium" scope="col">Comentario</th>
                    <th class="fw-medium" scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($calificaciones as $calificacion): ?>
                    <tr>
                        <td><?php echo $calificacion['id']; ?></td>
                        <td><?php echo $calificacion['puntaje']; ?></td>
                        <td><?php echo $calificacion['comentario']; ?></td>
                        <td class="d-flex gap-1">
                            <a href="calificacionEditar.php?id=<?php echo $calificacion['id']; ?>" class="btn rounded-circle p-0 btn-custom edit">
                                <i class="bi bi-pencil icon edit d-flex justify-content-center align-items-center"></i>
                            </a>
                            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="d-flex">
                                <input type="hidden" name="id" value="<?php echo $calificacion['id']; ?>">
                                <button type="submit" class="btn p-0 btn-custom delete rounded-circle" onclick="return confirm('¿Estás seguro de que deseas eliminar esta calificación?');">
                                    <i class="bi bi-trash3 icon delete d-flex justify-content-center align-items-center"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>