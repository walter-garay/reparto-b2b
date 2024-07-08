<?php
session_start();
require_once "../controladores/DeliveryControlador.php";
require_once "../layouts/header.php";

$dc = new DeliveryControlador();
$deliverys = $dc->obtenerDeliverysDetallados();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminar_id'])) {
    $id = $_POST['eliminar_id'];
    $dc->eliminarDelivery($id);
    header('Location: index.php');
}
?>

<div class="py-4 px-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="fs-5 mb-0">Deliverys</h1>
        <a href="solicitud.php" class="rounded-2 btn btn-primary btn-sm">Agregar delivery</a>
    </div>
    <div class="table-responsive table-bordered">
        <table class="table rounded-circle">
            <thead class="table" style="background-color: aqua;">
                <tr>
                    <th class="fw-medium" scope="col">#</th>
                    <th class="fw-medium" scope="col">Descripción</th>
                    <th class="fw-medium" scope="col">Recojo</th>
                    <th class="fw-medium" scope="col">Entrega</th>
                    <th class="fw-medium" scope="col">Solicitado</th>
                    <th class="fw-medium" scope="col">Cliente</th>
                    <th class="fw-medium" scope="col">Costo</th>
                    <th class="fw-medium" scope="col">Contraentrega</th>
                    <th class="fw-medium" scope="col">Destinatario</th>
                    <th class="fw-medium" scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($deliverys as $delivery): 
                    // Contraentrega styling
                    $costo_delivery = $delivery['contraentrega']->getCostoDelivery();
                    $costo_pedido = $delivery['contraentrega']->getCostoPedido();
                    $contraentrega_text = '';
                    $contraentrega_class = '';

                    if ($costo_delivery > 0 && $costo_pedido > 0) {
                        $contraentrega_text = 'Cobrar ambos';
                        $contraentrega_class = 'badge text-bg-success';
                    } elseif ($costo_delivery > 0 && ($costo_pedido == null || $costo_pedido == 0)) {
                        $contraentrega_text = 'Cobrar delivery';
                        $contraentrega_class = 'badge text-bg-primary';
                    } elseif ($costo_pedido > 0 && ($costo_delivery == null || $costo_delivery == 0)) {
                        $contraentrega_text = 'Cobrar pedido';
                        $contraentrega_class = 'badge text-bg-info';
                    } else {
                        $contraentrega_text = 'No cobrar';
                        $contraentrega_class = 'badge text-bg-secondary';
                    }

                    // Recojo and Entrega styling
                    $estado_classes = [
                        'Repartidor asignado' => 'badge text-bg-success',
                        'Sin repartidor asignado' => 'badge text-bg-warning',
                        'Completado' => 'badge text-bg-secondary'
                    ];

                    $recojo_estado = $delivery['recojo']->getEstado();
                    $recojo_class = $estado_classes[$recojo_estado] ?? '';

                    $entrega_estado = $delivery['entrega']->getEstado();
                    $entrega_class = $estado_classes[$entrega_estado] ?? '';
                ?>
                    <tr>
                        <td><?php echo $delivery['delivery']->getId(); ?></td>
                        <td class="fw-light"><?php echo $delivery['delivery']->getDescripcion(); ?></td>
                        <td class="fw-light"><span class="<?php echo $recojo_class; ?>"><?php echo $recojo_estado; ?></span></td>
                        <td class="fw-light"><span class="<?php echo $entrega_class; ?>"><?php echo $entrega_estado; ?></span></td>
                        <td class="fw-light"><?php echo $delivery['delivery']->getFechaSolicitud()->format('d/m/Y H:i'); ?></td>
                        <td class="fw-light"><?php echo $delivery['cliente']->getRazonSocial() ?></td>
                        <td class="fw-light"><?php echo $delivery['pago']->getMonto(); ?></td>
                        <td class="fw-light"><span class="<?php echo $contraentrega_class; ?>"><?php echo $contraentrega_text; ?></span></td>
                        <td class="fw-light"><?php echo $delivery['destinatario']->getNombres() . " " . $delivery['destinatario']->getApellidos(); ?></td>
                        <td class="d-flex gap-1">
                            <a href="editar.php?id=<?php echo $delivery['delivery']->getId(); ?>" class="btn rounded-circle p-0 btn-custom edit">
                                <i class="bi bi-pencil icon edit d-flex justify-content-center align-items-center"></i>                                
                            </a>
                            <form method="POST" action="index.php" class="d-flex">
                                <input type="hidden" name="eliminar_id" value="<?php echo $delivery['delivery']->getId(); ?>">
                                <button type="submit" class="btn p-0 btn-custom delete rounded-circle" onclick="return confirm('¿Está seguro de que desea eliminar este delivery?');">
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

<?php 
    require_once "../layouts/footer.php"; 
?>
