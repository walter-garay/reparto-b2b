<?php
require_once "../../layouts/header.php";
require_once "../../controladores/DeliveryControlador.php";
$dc = new DeliveryControlador();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $deliveryDetallado = $dc->obtenerDeliveryDetalladoPorId($_GET['id']);
}


?>


<div class="container d-flex justify-content-center align-items-center w-100 h-100">
    <div class="container rounded-4 shadow-sm col-lg-6 col-md-12 p-4" style="background-color: white;">
        <h1 class="mb-4 fs-5">Buscar Delivery</h1>
        <form id="searchForm">
            <div class="mb-3">
                <label for="cod_seguimiento">Código de Seguimiento</label>
                <input type="text" class="form-control" id="cod_seguimiento" name="cod_seguimiento" required>
            </div>
            <div class="d-flex justify-content-end pt-2 gap-2">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>

        <div id="resultContainer" >
            <h2 class="mt-4 mb-3 fs-5">Detalles del Delivery</h2>
            <div class="mb-3">
                <label>ID:</label>
                <p id="id" class="form-control"></p>
            </div>
            <div class="mb-3">
                <label>Descripción:</label>
                <p id="descripcion" class="form-control"></p>
            </div>
            <div class="mb-3">
                <label>Código de Seguimiento:</label>
                <p id="cod_seguimiento_result" class="form-control"></p>
            </div>
            <div class="mb-3">
                <label>Fecha de Solicitud:</label>
                <p id="fecha_solicitud" class="form-control"></p>
            </div>
            <div class="mb-3">
                <label>ID Cliente:</label>
                <p id="id_cliente" class="form-control"></p>
            </div>
            <div class="mb-3">
                <label>ID Recojo:</label>
                <p id="id_recojo" class="form-control"></p>
            </div>
            <div class="mb-3">
                <label>ID Entrega:</label>
                <p id="id_entrega" class="form-control"></p>
            </div>
            <div class="mb-3">
                <label>ID Pago:</label>
                <p id="id_pago" class="form-control"></p>
            </div>
            <div class="mb-3">
                <label>ID Contraentrega:</label>
                <p id="id_contraentrega" class="form-control"></p>
            </div>
            <div class="mb-3">
                <label>ID Destinatario:</label>
                <p id="id_destinatario" class="form-control"></p>
            </div>
        </div>
    </div>
</div>

<?php
    require_once "../../layouts/footer.php";
?>