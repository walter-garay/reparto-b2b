<?php
session_start();
require_once "../controladores/RepartidorControlador.php";
require_once "../layouts/header.php";

    $rc = new RepartidorControlador();
    $repartidores = $rc->obtenerRepartidores();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminar_id'])) {
    $id = $_POST['eliminar_id'];
    $rc->eliminarRepartidor($id);
    header('Location: index.php');
}
?>

<div class="container pt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="fs-5 mb-0">Repartidores</h1>
        <a href="crear.php" class="rounded-2 btn btn-primary btn-sm">Agregar repartidor</a>
    </div>

    <div class="table-responsive table-bordered">
        <table class="table rounded-circle">
            <thead class="table" style="background-color: aqua;">
                <tr>
                    <th class="fw-medium" scope="col">#</th>
                    <th class="fw-medium" scope="col">Nombres</th>
                    <th class="fw-medium" scope="col">Apellidos</th>
                    <th class="fw-medium" scope="col">Email</th>
                    <th class="fw-medium" scope="col">Celular</th>
                    <th class="fw-medium" scope="col">Tipo Transporte</th>
                    <th class="fw-medium" scope="col">Placa</th>
                    <th class="fw-medium" scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($repartidores as $repartidor): ?>
                    <tr>
                        <td><?php echo $repartidor->getId(); ?></td>
                        <td><?php echo $repartidor->getNombres(); ?></td>
                        <td><?php echo $repartidor->getApellidos(); ?></td>
                        <td><?php echo $repartidor->getEmail(); ?></td>
                        <td><?php echo $repartidor->getCelular(); ?></td>
                        <td><?php echo $repartidor->getTipoTransporte(); ?></td>
                        <td><?php echo $repartidor->getPlaca(); ?></td>
                        <td class="d-flex gap-1">
                            <a href="editar.php?id=<?php echo $repartidor->getId(); ?>" class="btn rounded-circle p-0 btn-custom edit">
                                <i class="bi bi-pencil icon edit d-flex justify-content-center align-items-center"></i>                                
                            </a>
                            <form method="POST" action="index.php" class="d-flex">
                                <input type="hidden" name="eliminar_id" value="<?php echo $repartidor->getId(); ?>">
                                <button type="submit" class="btn p-0 btn-custom delete rounded-circle" onclick="return confirm('¿Está seguro de que desea eliminar este repartidor?');">
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

<?php require_once __DIR__."/../layouts/footer.php"; ?>
