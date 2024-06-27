<?php
require_once '../controladores/PagoController.php';
$pc = new PagoController();
$pagos = $pc->mostrar();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $resultado = $pc->eliminar($_POST['id']);
    if ($resultado) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Pagos</title>
</head>
<body>
    <h1>Lista de Pagos</h1>
    <table border="1">
        <tr>
            <th>Monto</th>
            <th>Estado</th>
            <th>Método</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
        <?php
        foreach ($pagos as $pago) {
            echo "<tr>";
            echo "<td>". $pago['monto']. "</td>";
            echo "<td>". $pago['estado']. "</td>";
            echo "<td>". $pago['metodo']. "</td>";
            echo "<td><a href='pagoEditar.php?id=".$pago['id']."'>Editar</a></td>";
            echo "<td>
                    <form method='POST' action='' onsubmit=\"return confirm('¿Estás seguro de que deseas eliminar este pago?');\">
                        <input type='hidden' name='id' value='".$pago['id']."'>
                        <input type='submit' value='Eliminar'>
                    </form>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
