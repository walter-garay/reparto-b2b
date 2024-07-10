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
                <button type="submit" class="btn btn-primary" >Buscar</button>
            </div>
        </form>
    </div>
</div>

<?php
    require_once "../../layouts/footer.php";
?>