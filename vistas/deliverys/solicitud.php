<?php
require_once "../../layouts/header.php";
require_once "../../controladores/DeliveryControlador.php";

$dc = new DeliveryControlador();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = [
        'id_cliente' => 2,
        'descripcion' => $_POST['descripcion'],

        'direccion_recojo' => $_POST['direccion_recojo'],
        'fecha_recojo' => $_POST['fecha_recojo'],
        'hora_recojo' => $_POST['hora_recojo'],

        'direccion_entrega' => $_POST['direccion_entrega'],
        'fecha_entrega' => $_POST['fecha_entrega'],
        'hora_entrega' => $_POST['hora_entrega'],

        'dni_destinatario' => $_POST['dni_destinatario'],
        'nombres_destinatario' => $_POST['nombres_destinatario'],
        'apellidos_destinatario' => $_POST['apellidos_destinatario'],
        'celular_destinatario' => $_POST['celular_destinatario'],

        'monto_pago' => $_POST['monto_pago'],
        'metodo_pago' => $_POST['metodo_pago'],

        'costo_delivery' => $_POST['costo_delivery'],
        'costo_pedido' => $_POST['costo_pedido']
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
    
    <h4>Datos de Recojo</h4>
    <div class="mb-3">
        <label for="direccion_recojo">Dirección de recojo</label>
        <input type="text" class="form-control" id="direccion_recojo" name="direccion_recojo" required>
    </div>
    <div class="mb-3">
        <label for="fecha_recojo">Fecha de recojo</label>
        <input type="date" class="form-control" id="fecha_recojo" name="fecha_recojo" >
    </div>
    <div class="mb-3">
        <label for="hora_recojo">Hora de recojo</label>
        <input type="time" class="form-control" id="hora_recojo" name="hora_recojo">
    </div>

    <h4>Datos de Entrega</h4>
    <div class="mb-3">
        <label for="direccion_entrega">Dirección de entrega</label>
        <input type="text" class="form-control" id="direccion_entrega" name="direccion_entrega" required>
    </div>
    <div class="mb-3">
        <label for="fecha_entrega">Fecha de entrega</label>
        <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega">
    </div>
    <div class="mb-3">
        <label for="hora_entrega">Hora de entrega</label>
        <input type="time" class="form-control" id="hora_entrega" name="hora_entrega">
    </div>

    <h4>Datos del Destinatario</h4>
    <div class="mb-3">
        <label for="dni_destinatario">DNI</label>
        <input type="text" class="form-control" id="dni_destinatario" name="dni_destinatario">
    </div>
    <div class="mb-3">
        <label for="nombres_destinatario">Nombres</label>
        <input type="text" class="form-control" id="nombres_destinatario" name="nombres_destinatario" required>
    </div>
    <div class="mb-3">
        <label for="apellidos_destinatario">Apellidos</label>
        <input type="text" class="form-control" id="apellidos_destinatario" name="apellidos_destinatario">
    </div>
    <div class="mb-3">
        <label for="celular_destinatario">Celular</label>
        <input type="text" class="form-control" id="celular_destinatario" name="celular_destinatario">
    </div>

    <h4>Datos del Pago</h4>
    <div class="mb-3">
        <label for="monto_pago">Monto a pagar</label>
        <input type="number" value="8.00" class="form-control" id="monto_pago" name="monto_pago" disabled>
    </div>
    <div class="mb-3">
        <label for="metodo_pago">Método</label>
        <input type="text" class="form-control" id="metodo_pago" name="metodo_pago" required>
    </div>

    <h4>Datos de Contraentrega</h4>
    <div class="mb-3">
        <label for="costo_delivery">Costo del Delivery</label>
        <input type="number" step="0.01" class="form-control" id="costo_delivery" name="costo_delivery" required>
    </div>
    <div class="mb-3">
        <label for="costo_pedido">Costo del Pedido</label>
        <input type="number" step="0.01" class="form-control" id="costo_pedido" name="costo_pedido" required>
    </div>

    <div class="d-flex justify-content-end gap-2">
        <a href="index.php" type="submit" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
    </div>
</form>

<?php
require_once "../../layouts/footer.php";
?>
