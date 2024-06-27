<?php
require_once '../controladores/CalificacionController.php';$cc = new CalificacionController();
$calificaciones = $cc->mostrar();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $resultado = $cc->eliminar($_POST['id']);
    if ($resultado) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } 
}
?>

<table border="1">
    <tr>
        <th>Puntaje</th>
        <th>Comentario</th>
        <th>Editar</th>
        <th>Eliminar</th>
    </tr>
    <?php
    foreach ($calificaciones as $calificacion) {
        echo "<tr>";
        echo "<td>". $calificacion['puntaje']. "</td>";
        echo "<td>". $calificacion['comentario']. "</td>";
        echo "<td><a href='calificacionEditar.php?id=".$calificacion['id']."'>Editar</a></td>";
        echo "<td>
                <form method='POST' action='' onsubmit=\"return confirm('¿Estás seguro de que deseas eliminar esta calificación?');\">
                    <input type='hidden' name='id' value='".$calificacion['id']."'>
                    <input type='submit' value='Eliminar'>
                </form>
              </td>";
        echo "</tr>";
    }
    ?>
</table>
