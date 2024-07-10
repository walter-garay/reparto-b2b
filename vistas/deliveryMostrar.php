<?php
require_once "../controladores/DeliveryControlador.php";

$controller = new DeliveryControlador();
$deliveries = $controller->listarDeliverys();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Listado de Deliveries</title>
</head>
<body>
    <h1>Listado de Deliveries</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Descripción</th>
            <th>Código de Seguimiento</th>
            <th>Fecha de Solicitud</th>
            <th>ID Cliente</th>
            <th>ID Repartidor</th>
            <th>ID Pago</th>
            <th>ID Contraentrega</th>
            <th>ID Destinatario</th>
            <th>Acciones</th>
        </tr>
        <?php
        foreach ($deliveries as $delivery) {
            echo "<tr>
                    <td>".$delivery['id']."</td>
                    <td>".$delivery['descripcion']."</td>
                    <td>".$delivery['cod_seguimiento']."</td>
                    <td>".$delivery['fecha_solicitud']."</td>
                    <td>".$delivery['id_cliente']."</td>
                    <td>".$delivery['id_repartidor']."</td>
                    <td>".$delivery['id_pago']."</td>
                    <td>".$delivery['id_contraentrega']."</td>
                    <td>".$delivery['id_destinatario']."</td>
                    <td>
                        <a href='deliveryActualizar.php?id=".$delivery['id']."'>Editar</a>
                        <a href='eliminar_delivery.php?id=".$delivery['id']."'>Eliminar</a>
                    </td>
                </tr>";
        }
        ?>
    </table>
    <br>
    <a href="crear_delivery.php">Crear Nuevo Delivery</a>
</body>
</html>
