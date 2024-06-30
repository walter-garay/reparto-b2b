<?php
require_once "../../layouts/header.php";
require_once "../../controladores/DeliveryControlador.php";

$dc = new DeliveryControlador();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = [
        'descripcion' => $_POST['descripcion'],
        'cod_seguimiento' => $_POST['cod_seguimiento'],
        'fecha_solicitud' => date('Y-m-d H:i:s'),
        'id_cliente' => $_POST['id_cliente'],
        'id_pago' => $_POST['id_pago'],
        'id_contraentrega' => $_POST['id_contraentrega'],
        'id_destinatario' => $_POST['id_destinatario']
    ];

    $dc->crearDelivery($datos);

    header("Location: index.php");
        
    exit;
}
?>

<form method="POST" action="">
    <div class="mb-3">
        <label for="descripcion">Descripción</label>
        <input type="text" class="form-control" id="descripcion" name="descripcion" required>
    </div>
    <div class="mb-3">
        <label for="cod_seguimiento">Código de Seguimiento</label>
        <input type="text" class="form-control" id="cod_seguimiento" name="cod_seguimiento" required>
    </div>
    <div class="mb-3">
        <label for="id_cliente">ID Cliente</label>
        <input type="number" class="form-control" id="id_cliente" name="id_cliente" required>
    </div>
    <div class="mb-3">
        <label for="id_pago">ID Pago</label>
        <input type="number" class="form-control" id="id_pago" name="id_pago" required>
    </div>
    <div class="mb-3">
        <label for="id_contraentrega">ID Contraentrega</label>
        <input type="number" class="form-control" id="id_contraentrega" name="id_contraentrega">
    </div>
    <div class="mb-3">
        <label for="id_destinatario">ID Destinatario</label>
        <input type="number" class="form-control" id="id_destinatario" name="id_destinatario">
    </div>
    <div class="d-flex justify-content-end gap-2">
        <a href="index.php" type="submit" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
    </div>
</form>

<?php
    require_once "../../layouts/footer.php";