<?php
session_start();
require_once "../controladores/DeliveryControlador.php";

$dc = new DeliveryControlador();
$deliverys = $dc->obtenerDeliverysDetallados();
$entrantes = [];

foreach ($deliverys as $delivery) {
    if ($delivery['recojo']->getEstado() == 'Sin repartidor' || $delivery['entrega']->getEstado() == 'Sin repartidor') {
        $entrantes[] = $delivery;
    }
}

if (isset($_POST["submit"])) {
    $id = $_POST['delivery_id'];
    $accion = $_POST['accion'];
    
    if ($accion == 'tomar_recojo') {
        $dc->asignarRecojo($id, $_SESSION['usuario_id']);
    } elseif ($accion == 'tomar_entrega') {
        $dc->asignarEntrega($id, $_SESSION['usuario_id']);
    }
    
    header('Location: entrantes.php');
    exit; 
}

require_once "../layouts/header.php";
?>

<div class="py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="fs-5 mb-0">Entrantes</h1>
    </div>
    <div class="table-responsive table-bordered">
        <table class="table rounded-circle">
            <thead class="table" style="background-color: aqua;">
                <tr>
                    <th class="fw-medium" scope="col">#</th>
                    <th class="fw-medium" scope="col">Dirección Recojo</th>
                    <th class="fw-medium" scope="col">Fecha y Hora Recojo</th>
                    <th class="fw-medium" scope="col">Dirección Entrega</th>
                    <th class="fw-medium" scope="col">Fecha y Hora Entrega</th>
                    <th class="fw-medium" scope="col">Contraentrega</th>
                    <th class="fw-medium" scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($entrantes as $delivery): ?>
                    <tr>
                        <td><?php echo $delivery['delivery']->getId(); ?></td>
                        <td class="fw-light"><?php echo $delivery['recojo']->getDireccion(); ?></td>
                        <td class="fw-light"><?php echo $delivery['recojo']->getFecha()->format('d/m/Y'); ?> <?php echo $delivery['recojo']->getHora(); ?></td>
                        <td class="fw-light"><?php echo $delivery['entrega']->getDireccion(); ?></td>
                        <td class="fw-light"><?php echo $delivery['entrega']->getFecha()->format('d/m/Y'); ?> <?php echo $delivery['entrega']->getHora(); ?></td>
                        <td class="fw-light">
                            <?php
                            $costo_delivery = $delivery['contraentrega']->getCostoDelivery();
                            $costo_pedido = $delivery['contraentrega']->getCostoPedido();
                            if ($costo_delivery > 0 && $costo_pedido > 0) {
                                echo 'Cobrar ambos';
                            } elseif ($costo_delivery > 0) {
                                echo 'Cobrar delivery';
                            } elseif ($costo_pedido > 0) {
                                echo 'Cobrar pedido';
                            } else {
                                echo 'No cobrar';
                            }
                            ?>
                        </td>
                        <td class="d-flex gap-2">
                            <?php if ($delivery['recojo']->getEstado() == 'Sin repartidor'): ?>
                                <form method="POST" action="deliverys-entrantes.php" class="d-flex">
                                    <input type="hidden" name="delivery_id" value="<?php echo $delivery['delivery']->getId(); ?>">
                                    <input type="hidden" name="accion" value="tomar_recojo">
                                    <button type="submit" name="submit" class="btn btn-primary btn-sm">Tomar Recojo</button>
                                </form>
                            <?php endif; ?>
                            <?php if ($delivery['entrega']->getEstado() == 'Sin repartidor'): ?>
                                <form method="POST" action="deliverys-entrantes.php" class="d-flex">
                                    <input type="hidden" name="delivery_id" value="<?php echo $delivery['delivery']->getId(); ?>">
                                    <input type="hidden" name="accion" value="tomar_entrega">
                                    <button type="submit" name="submit" class="btn btn-secondary btn-sm">Tomar Entrega</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php 
require_once "../layouts/footer.php"; 
?>
