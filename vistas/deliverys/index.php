<?php
    session_start();
    require_once "../../controladores/DeliveryControlador.php";
    require_once "../../layouts/header.php";

    $dc = new DeliveryControlador();
    $deliverys = $dc->obtenerDeliverys();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminar_id'])) {
        $id = $_POST['eliminar_id'];
        $dc->eliminarDelivery($id);
        header('Location: index.php');
    }
    
?>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="fs-4 mb-0">Deliverys</h1>
        <a href="crear.php" class="btn btn-primary">Agregar Delivery</a>
    </div>

    <div class="table-responsive">
        <table class="table ">
            <thead class="table">
                <tr>
                    <th class="text-center" scope="col">#</th>
                    <th class="text-center" scope="col">Descripción</th>
                    <th class="text-center" scope="col">Tracking    </th>
                    <th class="text-center" scope="col">Fecha de Solicitud</th>
                    <th class="text-center" scope="col">ID Cliente</th>
                    <th class="text-center" scope="col">ID Pago</th>
                    <th class="text-center" scope="col">ID Contraentrega</th>
                    <th class="text-center" scope="col">ID Destinatario</th>
                    <th class="text-center" scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($deliverys as $delivery): ?>
                    <tr>
                        <td class="text-center"><?php echo $delivery->getId(); ?></td>
                        <td class="text-center"><?php echo $delivery->getDescripcion(); ?></td>
                        <td class="text-center"><?php echo $delivery->getCodSeguimiento(); ?></td>
                        <td class="text-center"><?php echo $delivery->getFechaSolicitud()->format('d/m/Y H:i'); ?></td>
                        <td class="text-center"><?php echo $delivery->getIdCliente(); ?></td>
                        <td class="text-center"><?php echo $delivery->getIdPago(); ?></td>
                        <td class="text-center"><?php echo $delivery->getIdContraentrega(); ?></td>
                        <td class="text-center"><?php echo $delivery->getIdDestinatario(); ?></td>
                        <td class="text-center">
                            <a href="editar.php?id=<?php echo $delivery->getId(); ?>" class="btn btn-info btn-sm">Editar</a>
                            <form method="POST" action="index.php" style="display:inline-block;">
                                <input type="hidden" name="eliminar_id" value="<?php echo $delivery->getId();; ?>">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de que desea eliminar este delivery?');">Eliminar</button>
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