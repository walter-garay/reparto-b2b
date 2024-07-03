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
                    <th class="fw-medium"scope="col">Descripción</th>
                    <th class="fw-medium" scope="col">Tracking    </th>
                    <th class="fw-medium" scope="col">Fecha de Solicitud</th>
                    <th class="fw-medium" scope="col">Cliente</th>
                    <th class="fw-medium" scope="col">Pago</th>
                    <th class="fw-medium fw-light" scope="col">Contraentrega</th>
                    <th class="fw-medium" scope="col">Destinatario</th>
                    <th class="fw-medium" scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($deliverys as $delivery): ?>
                    <tr>
                        <td ><?php echo $delivery->getId(); ?></td>
                        <td ><?php echo $delivery->getDescripcion(); ?></td>
                        <td class="fw-light"><?php echo $delivery->getCodSeguimiento(); ?></td>
                        <td class="fw-light"><?php echo $delivery->getFechaSolicitud()->format('d/m/Y H:i'); ?></td>
                        <td class="fw-light"><?php echo $delivery->getIdCliente(); ?></td>
                        <td class="fw-light"><?php echo $delivery->getIdPago(); ?></td>
                        <td class="fw-light"><?php echo $delivery->getIdContraentrega(); ?></td>
                        <td class="fw-light"><?php echo $delivery->getIdDestinatario(); ?></td>
                        <td class="d-flex gap-1">
                            <a href="editar.php?id=<?php echo $delivery->getId(); ?>" class="btn rounded-circle p-0 btn-custom edit">
                                <i class="icon edit d-flex justify-content-center align-items-center">
                                    <?php require "../../assets/img/pencil.svg" ?>
                                </i>
                            </a>
                            <form method="POST" action="index.php" class="d-flex">
                                <input type="hidden" name="eliminar_id" value="<?php echo $delivery->getId(); ?>">
                                <button type="submit" class="btn p-0 btn-custom delete rounded-circle " onclick="return confirm('¿Está seguro de que desea eliminar este delivery?');">
                                    <i class="icon delete d-flex justify-content-center align-items-center">
                                        <?php require "../../assets/img/trash.svg" ?>
                                    </i>
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