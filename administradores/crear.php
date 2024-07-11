<?php
require_once "../layouts/header.php";
require_once "../controladores/AdministradorControlador.php";

$ac = new AdministradorControlador();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = [
        'nombres' => $_POST['nombres'],
        'apellidos' => $_POST['apellidos'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'celular' => $_POST['celular'],
        'dni_ruc' => $_POST['dni_ruc'],
        'tipo' => $_POST['tipo']
    ];

    $ac->registrar($datos['nombres'], $datos['apellidos'], $datos['email'], $datos['password'], $datos['celular'], $datos['tipo'], $datos['dni_ruc']);

    header("Location: index.php");
    exit;
}
?>

<div class="container d-flex justify-content-center align-items-center w-100 h-100">
    <div class="container rounded-4 shadow-sm col-lg-6 col-md-12 p-4" style="background-color: white;">
        <h1 class="mb-4 fs-5">Agregar administrador</h1>
        <form method="POST" action="">
            <div class="d-flex gap-2">
                <div class="mb-3 w-100">
                    <label for="nombres">Nombres</label>
                    <input type="text" class="form-control" id="nombres" name="nombres" required>
                </div>
                <div class="mb-3 w-100">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos">
                </div>
            </div>
            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3 w-100">
                <label for="celular">Celular</label>
                <input type="text" class="form-control" id="celular" name="celular">
            </div>
            <div class="mb-3 w-100">
                <label for="dni_ruc">DNI o RUC</label>
                <input type="text" class="form-control" id="dni_ruc" name="dni_ruc">
            </div>
            <div class="d-flex gap-2">
                <div class="mb-3 w-100">
                    <label for="tipo">Tipo</label>
                    <select name="tipo" class="form-select" aria-label="Seleccionar tipo">
                        <option value="Administrador">Administrador</option>
                        <option value="Super Administrador">Super Administrador</option>
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-end pt-2 gap-2">
                <a href="index.php" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>
        </form>
    </div>
</div>

<?php require_once "../layouts/footer.php"; ?>
