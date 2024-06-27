<?php
require_once '../controladores/PagoController.php';
$pc = new PagoController();
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$monto = '';
$estado = '';
$metodo = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $id = intval($_POST['id']);
    $monto = $_POST['monto'];
    $estado = $_POST['estado'];
    $metodo = $_POST['metodo'];
    
    $resultado = $pc->editar($id, $monto, $estado, $metodo); 
    if ($resultado) {
        header("Location: pagoMostrar.php"); 
        exit();
    } else {
        echo "<p>Error al actualizar el pago.</p>";
    }
} else {
    $pagoData = $pc->buscar($id);
    if ($pagoData) {
        $monto = $pagoData['monto'];
        $estado = $pagoData['estado'];
        $metodo = $pagoData['metodo'];
    } else {
        echo "<p>Pago no encontrado.</p>";
        exit;
    }
}
?>

    <h1>Editar Pago</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $id; ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="monto">Monto:</label>
        <input type="number" name="monto" value="<?php echo $monto; ?>" required><br>

        <label for="estado">Estado:</label>
        <select id="estado" name="estado" required>
            <option value="pendiente" <?php echo ($estado == 'pendiente') ? 'selected' : ''; ?>>Pendiente</option>
            <option value="pagado" <?php echo ($estado == 'pagado') ? 'selected' : ''; ?>>Pagado</option>
            <option value="cancelado" <?php echo ($estado == 'cancelado') ? 'selected' : ''; ?>>Cancelado</option>
        </select><br>

        <label for="metodo">Método:</label>
        <select id="metodo" name="metodo" required>
            <option value="tarjeta" <?php echo ($metodo == 'tarjeta') ? 'selected' : ''; ?>>Tarjeta</option>
            <option value="efectivo" <?php echo ($metodo == 'efectivo') ? 'selected' : ''; ?>>Efectivo</option>
            <option value="transferencia" <?php echo ($metodo == 'transferencia') ? 'selected' : ''; ?>>Transferencia</option>
        </select><br>

        <input type="submit" name="submit" value="Actualizar">
    </form>

