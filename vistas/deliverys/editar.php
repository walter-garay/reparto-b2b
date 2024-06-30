<?php
require_once "../../layouts/header.php";
require_once "../../controladores/DeliveryControlador.php";

$dc = new DeliveryControlador();
$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $datos = [
        'descripcion' => $_POST['descripcion'],
        'cod_seguimiento' => $_POST['cod_seguimiento'],
        'id_cliente' => $_POST['id_cliente'],
        'id_pago' => $_POST['id_pago'],
        'id_contraentrega' => $_POST['id_contraentrega'],
        'id_destinatario' => $_POST['id_destinatario']
    ];

    $dc->actualizarDelivery($id, $datos);

    header("Location: index.php");
    exit;
}

$delivery = $dc->obtenerDeliveryPorId($id);
?>

<!-- Formulario de edición -->
<form method="POST" action="">
    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $delivery->getDescripcion(); ?>" required>
    </div>
    <div class="mb-3">
        <label for="cod_seguimiento" class="form-label">Código de Seguimiento</label>
        <input type="text" class="form-control" id="cod_seguimiento" name="cod_seguimiento" value="<?php echo $delivery->getCodSeguimiento(); ?>" required>
    </div>
    <div class="mb-3">
        <label for="id_cliente" class="form-label">ID Cliente</label>
        <input type="number" class="form-control" id="id_cliente" name="id_cliente" value="<?php echo $delivery->getIdCliente(); ?>" required>
    </div>
    <div class="mb-3">
        <label for="id_pago" class="form-label">ID Pago</label>
        <input type="number" class="form-control" id="id_pago" name="id_pago" value="<?php echo $delivery->getIdPago(); ?>" required>
    </div>
    <div class="mb-3">
        <label for="id_contraentrega" class="form-label">ID Contraentrega</label>
        <input type="number" class="form-control" id="id_contraentrega" name="id_contraentrega" value="<?php echo $delivery->getIdContraentrega(); ?>">
    </div>
    <div class="mb-3">
        <label for="id_destinatario" class="form-label">ID Destinatario</label>
        <input type="number" class="form-control" id="id_destinatario" name="id_destinatario" value="<?php echo $delivery->getIdDestinatario(); ?>">
    </div>
    <div class="d-flex justify-content-end mt-2 gap-2">
        <a href="index.php" type="submit" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
    </div>
</form>

<?php
    require_once "../../layouts/footer.php";