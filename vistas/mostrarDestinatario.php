<?php
require_once "../controladores/DestinatarioControlador.php";
$controller = new DestinatarioControlador();
$destinatarios = $controller->listarDestinatarios();
?>
    <table border=1>
            <tr>
                <th>ID</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>Número</th>
                <th>Acciones</th>
            </tr>
            <?php
            foreach ($destinatarios as $destinatario){
                echo"<tr>
                    <td>".$destinatario['id']."</td>
                    <td>".$destinatario['nombresDesti']."</td>
                    <td>".$destinatario['apellidosDesti']."</td>
                    <td>".$destinatario['emailDesti']."</td>
                    <td><".$destinatario['numeroDesti']."</td>
                    <td>
                        <a href='editarDestinatario.php?id=".$destinatario['id']."'>Editar</a>
                        <a href='eliminarDestinatario.php?id=".$destinatario['id']."'>Eliminar</a>
                    </td>
                </tr>";
            }
            ?>
    </table>