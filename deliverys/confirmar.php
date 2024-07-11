<?php
session_start();
require_once "../layouts/header.php";
require_once "../controladores/DeliveryControlador.php";
$dc = new DeliveryControlador();

$deliveryDetallado = null;

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $deliveryDetallado = $dc->obtenerDeliveryDetalladoPorId($_GET['id']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delivery_id'])) {
    $id = $_POST['delivery_id'];
    $foto_entrega = null;

    if (isset($_FILES['foto_entrega']) && $_FILES['foto_entrega']['error'] === UPLOAD_ERR_OK) {
        $foto_entrega = basename($_FILES['foto_entrega']['name']);
        $uploadDir = '../uploads/';
        $uploadFile = $uploadDir . $foto_entrega;
        move_uploaded_file($_FILES['foto_entrega']['tmp_name'], $uploadFile);
    }

    $calificacion = [
        'puntaje' => $_POST['puntaje'],
        'comentario' => $_POST['comentario']
    ];

    $dc->confirmarEntrega($id, $_SESSION['usuario_id'], $foto_entrega, $calificacion);
    header('Location: deliverys.php');
    exit;
}
?>

<div class="container d-flex flex-column justify-content-center align-items-center w-100 h-100">
    <div class="container rounded-4 shadow-sm col-lg-6 col-md-12 p-4" style="background-color: white;">
        <h1 class="mb-4 fs-5">Confirmar Entrega</h1>

        <?php if ($deliveryDetallado): ?>
            <div class="container rounded-4 shadow-sm col-lg-6 col-md-12 p-4 mt-4" style="background-color: white;">
                <h2 class="mb-4 fs-5">Pedido encontrado</h2>
                <form method="POST" action="confirmar-delivery.php" enctype="multipart/form-data">
                    <input type="hidden" name="delivery_id" value="<?php echo $deliveryDetallado['delivery']->getId(); ?>">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="descripcion" class="form-label fw-normal">Descripción</label>
                            <input type="text" class="form-control" id="descripcion" value="<?php echo $deliveryDetallado['delivery']->getDescripcion(); ?>" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="direccion_recojo" class="form-label fw-normal">Dirección de Recojo</label>
                            <input type="text" class="form-control" id="direccion_recojo" value="<?php echo $deliveryDetallado['recojo']->getDireccion(); ?>" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fecha_hora_recojo" class="form-label fw-normal">Fecha y Hora de Recojo</label>
                            <input type="text" class="form-control" id="fecha_hora_recojo" value="<?php echo $deliveryDetallado['recojo']->getFecha() . ' ' . $deliveryDetallado['recojo']->getHora(); ?>" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="direccion_entrega" class="form-label fw-normal">Dirección de Entrega</label>
                            <input type="text" class="form-control" id="direccion_entrega" value="<?php echo $deliveryDetallado['entrega']->getDireccion(); ?>" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fecha_hora_entrega" class="form-label fw-normal">Fecha y Hora de Entrega</label>
                            <input type="text" class="form-control" id="fecha_hora_entrega" value="<?php echo $deliveryDetallado['entrega']->getFecha() . ' ' . $deliveryDetallado['entrega']->getHora(); ?>" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="destinatario" class="form-label fw-normal">Destinatario</label>
                            <input type="text" class="form-control" id="destinatario" value="<?php echo $deliveryDetallado['destinatario']->getNombres() . ' ' . $deliveryDetallado['destinatario']->getApellidos(); ?>" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="contraentrega" class="form-label fw-normal">Contraentrega</label>
                            <input type="text" class="form-control" id="contraentrega" value="<?php echo 'Delivery: S/ ' . $deliveryDetallado['contraentrega']->getCostoDelivery() . ', Pedido: S/ ' . $deliveryDetallado['contraentrega']->getCostoPedido(); ?>" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="foto_entrega" class="form-label fw-normal">Foto de Entrega</label>
                            <input type="file" class="form-control" id="foto_entrega" name="foto_entrega" accept="image/*">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="puntaje" class="form-label fw-normal">Puntaje</label>
                            <input type="number" class="form-control" id="puntaje" name="puntaje" min="1" max="5" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="comentario" class="form-label fw-normal">Comentario</label>
                            <textarea class="form-control" id="comentario" name="comentario" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end pt-2 gap-2">
                        <button type="submit" class="btn btn-success">Confirmar Entrega</button>
                    </div>
                </form>
            </div>
        <?php else: ?>
            <div class="alert alert-danger">No se encontró el delivery con el ID proporcionado.</div>
        <?php endif; ?>
    </div>
</div>

<?php
require_once "../layouts/footer.php";
?>
