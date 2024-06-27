<?php
require_once '../controladores/InconvenienteController.php';
$ic = new InconvenienteController();
$inconvenientes = $ic->mostrarInconvenientes();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $resultado = $ic->eliminarInconveniente($_POST['id']);
    if ($resultado) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } 
}
?>
    <h1>Lista de Inconvenientes</h1>
    <table border="1">
        <tr>
            <th>Descripción</th>
            <th>Foto Prueba</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
        <?php
        foreach ($inconvenientes as $inconveniente) {
            echo "<tr>";
            echo "<td>". htmlspecialchars($inconveniente['descripcion'], ENT_QUOTES, 'UTF-8'). "</td>";
            echo "<td>". htmlspecialchars($inconveniente['foto_prueba'], ENT_QUOTES, 'UTF-8'). "</td>";
            echo "<td><a href='inconvenienteEditar.php?id=".htmlspecialchars($inconveniente['id'], ENT_QUOTES, 'UTF-8')."'>Editar</a></td>";
            echo "<td>
                    <form method='POST' action='' onsubmit=\"return confirm('¿Estás seguro de que deseas eliminar este inconveniente?');\">
                        <input type='hidden' name='id' value='".htmlspecialchars($inconveniente['id'], ENT_QUOTES, 'UTF-8')."'>
                        <input type='submit' value='Eliminar'>
                    </form>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
