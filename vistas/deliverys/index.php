<?php
session_start();
require_once "../../controladores/DeliveryControlador.php";
require_once "../../layouts/header.php";

$dc = new DeliveryControlador();
$deliverys = $dc->obtenerDeliverysDetallados();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminar_id'])) {
    $id = $_POST['eliminar_id'];
    $dc->eliminarDelivery($id);
    header('Location: index.php');
}

?>

<div class="container pt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="fs-5 mb-0">Deliverys</h1>
        <a href="crear.php" class="rounded-2 btn btn-primary btn-sm">Agregar delivery</a>
    </div>

    <div class="table-responsive table-bordered">
        <table class="table rounded-circle">
            <thead class="table" style="background-color: aqua;">
                <tr>
                    <th class="fw-medium" scope="col">#</th>
                    <th class="fw-medium" scope="col">Descripción</th>
                    <th class="fw-medium" scope="col">Tracking</th>
                    <th class="fw-medium" scope="col">Fecha de Solicitud</th>
                    <th class="fw-medium" scope="col">Cliente</th>
                    <th class="fw-medium" scope="col">Costo</th>
                    <th class="fw-medium" scope="col">Contraentrega</th>
                    <th class="fw-medium" scope="col">Destinatario</th>
                    <th class="fw-medium" scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($deliverys as $delivery): 
                    $costo_delivery = $delivery['contraentrega']['costo_delivery'];
                    $costo_pedido = $delivery['contraentrega']['costo_pedido'];
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
                ?>
                    <tr>
                        <td><?php echo $delivery['delivery']["id"]; ?></td>
                        <td><?php echo $delivery['delivery']["descripcion"]; ?></td>
                        <td class="fw-light"><?php echo $delivery['delivery']["cod_seguimiento"]; ?></td>
                        <td class="fw-light"><?php echo $delivery['delivery']['fecha_solicitud']->format('d/m/Y H:i'); ?></td>
                        <td class="fw-light"><?php echo $delivery['cliente']['razon_social']; ?></td>
                        <td class="fw-light"><?php echo $delivery['pago']['monto']; ?></td>
                        <td class="fw-light"><span class="<?php echo $contraentrega_class; ?>"><?php echo $contraentrega_text; ?></span></td>
                        <td class="fw-light"><?php echo $delivery['destinatario']['nombres'] . " " . $delivery['destinatario']['apellidos']; ?></td>
                        <td class="d-flex gap-1">
                            <a href="editar.php?id=<?php echo $delivery['delivery']["id"]; ?>" class="btn rounded-circle p-0 btn-custom edit">
                                <i class="bi bi-pencil icon edit d-flex justify-content-center align-items-center"></i>                                
                            </a>
                            <form method="POST" action="index.php" class="d-flex">
                                <input type="hidden" name="eliminar_id" value="<?php echo $delivery['delivery']["id"]; ?>">
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
require_once "../../layouts/footer.php"; 
?>
