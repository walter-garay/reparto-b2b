<?php
require_once "/controladores/AdministradorControlador.php";
require_once "layouts/header.php";

$controlador = new AdministradorControlador();
$administradores = $controlador->mostrarAdministradores();

if (isset($_POST['submit'])) {
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $celular = $_POST['celular'];
    $tipo = $_POST['tipo'];
    $dni_ruc = $_POST['dni_ruc'];
    $password = $_POST['password']; // Asegúrate de capturar el password

    $controlador->registrar($nombres, $apellidos, $email, $password, $celular, $tipo, $dni_ruc);

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $celular = $_POST['celular'];
    $tipo = $_POST['tipo'];
    $dni_ruc = $_POST['dni_ruc'];

    $controlador->actualizarAdministrador($id, $nombres, $apellidos, $email, $celular, $tipo, $dni_ruc);

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Administradores</h2>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearModal">
            Agregar
        </button>
    </div>

    <!-- Modal del formulario CREAR -->
    <div class="modal fade" id="crearModal" tabindex="-1" aria-labelledby="crearModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar Administrador</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="crearForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nombres" class="form-label">Nombres</label>
                            <input type="text" class="form-control" id="nombres" name="nombres" required>
                        </div>
                        <div class="mb-3">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="celular" class="form-label">Celular</label>
                            <input type="text" class="form-control" id="celular" name="celular" required>
                        </div>
                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipo</label>
                            <input type="text" class="form-control" id="tipo" name="tipo" value="Administrador" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="dni_ruc" class="form-label">DNI / RUC</label>
                            <input type="text" class="form-control" id="dni_ruc" name="dni_ruc" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" name="submit">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal del formulario EDITAR -->
    <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editarModalLabel">Editar Administrador</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editarForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input type="hidden" id="editId" name="id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editNombres" class="form-label">Nombres</label>
                            <input type="text" class="form-control" id="editNombres" name="nombres" required>
                        </div>
                        <div class="mb-3">
                            <label for="editApellidos" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="editApellidos" name="apellidos" required>
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="editCelular" class="form-label">Celular</label>
                            <input type="text" class="form-control" id="editCelular" name="celular" required>
                        </div>
                        <div class="mb-3">
                            <label for="editTipo" class="form-label">Tipo</label>
                            <input type="text" class="form-control" id="editTipo" name="tipo" value="Administrador" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="editDniRuc" class="form-label">DNI / RUC</label>
                            <input type="text" class="form-control" id="editDniRuc" name="dni_ruc" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" name="update">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="table">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th class="text-center" scope="col">#</th>
                    <th class="text-center" scope="col">Nombres</th>
                    <th class="text-center" scope="col">Apellidos</th>
                    <th class="text-center" scope="col">Email</th>
                    <th class="text-center" scope="col">Celular</th>
                    <th class="text-center" scope="col">Tipo</th>
                    <th class="text-center" scope="col">DNI/RUC</th>
                    <th class="text-center" scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($administradores as $administrador): ?>
                    <tr>
                        <td><?php echo $administrador['id']; ?></td>
                        <td class="text-center"><?php echo $administrador['nombres']; ?></td>
                        <td class="text-center"><?php echo $administrador['apellidos']; ?></td>
                        <td class="text-center"><?php echo $administrador['email']; ?></td>
                        <td class="text-center"><?php echo $administrador['celular']; ?></td>
                        <td class="text-center"><?php echo $administrador['tipo']; ?></td>
                        <td class="text-center"><?php echo $administrador['dni_ruc']; ?></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-danger btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                </svg>
                            </button>
                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editarModal" data-id="<?php echo $administrador['id']; ?>" data-nombres="<?php echo $administrador['nombres']; ?>" data-apellidos="<?php echo $administrador['apellidos']; ?>" data-email="<?php echo $administrador['email']; ?>" data-celular="<?php echo $administrador['celular']; ?>" data-dni_ruc="<?php echo $administrador['dni_ruc']; ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                </svg>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
require_once "layouts/footer.php";
?>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    // Pasa los datos al formulario de edición cuando se hace clic en el botón de edición
    var editModal = document.getElementById('editarModal');
    editModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var nombres = button.getAttribute('data-nombres');
        var apellidos = button.getAttribute('data-apellidos');
        var email = button.getAttribute('data-email');
        var celular = button.getAttribute('data-celular');
        var dni_ruc = button.getAttribute('data-dni_ruc');

        var modalBody = editModal.querySelector('.modal-body');
        modalBody.querySelector('#editId').value = id;
        modalBody.querySelector('#editNombres').value = nombres;
        modalBody.querySelector('#editApellidos').value = apellidos;
        modalBody.querySelector('#editEmail').value = email;
        modalBody.querySelector('#editCelular').value = celular;
        modalBody.querySelector('#editDniRuc').value = dni_ruc;
    });
});
</script>
