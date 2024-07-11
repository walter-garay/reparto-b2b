<?php
require_once "../layouts/header.php";
require_once "../controladores/DeliveryControlador.php";
$dc = new DeliveryControlador();

$deliveryDetallado = null;

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['cod_seguimiento'])) {
    $deliveryDetallado = $dc->obtenerDeliveryDetalladoPorCodigo($_GET['cod_seguimiento']);
}
?>

<div class="container d-flex flex-column justify-content-center align-items-center w-100 h-100 my-4">
    <div class="container rounded-4 shadow-sm col-lg-6 col-md-12 p-4" style="background-color: white;">
        <form id="searchForm" method="GET" action="">
            <div class="mb-3">
                <label for="cod_seguimiento">Ingrese su código de seguimiento</label>
                <div class="d-flex gap-2">
                    <input type="text" class="form-control" id="cod_seguimiento" name="cod_seguimiento" required>
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </div>
        </form>
    </div>

    <?php if ($deliveryDetallado): ?>
        <div class="container rounded-4 shadow-sm col-lg-6 col-md-12 p-4 mt-4" style="background-color: white;">
            <h2 class="mb-4 fs-5">Pedido encontrado</h2>
            <form>
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
                <div class="col-md-12">
                    <label for="contraentrega" class="form-label fw-normal">Contraentrega</label>
                    <input type="text" class="form-control" id="contraentrega" value="<?php echo 'Delivery: S/ ' . $deliveryDetallado['contraentrega']->getCostoDelivery() . ', Pedido: S/ ' . $deliveryDetallado['contraentrega']->getCostoPedido(); ?>" disabled>
                </div>
                <div class="d-flex justify-content-end pt-4 ">
                    <a href="confirmar-delivery.php?id=<?php echo $deliveryDetallado['delivery']->getId(); ?>" class="btn btn-success">Confirmar Entrega</a>
                </div>
            </form>
        </div>
    <?php endif; ?>
</div>

<?php
require_once "../layouts/footer.php";
?>
