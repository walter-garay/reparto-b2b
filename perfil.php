<?php
session_start();
require_once "layouts/header.php";
require_once "./controladores/UsuarioControlador.php";

$uc = new UsuarioControlador();
$id = $_SESSION['usuario_id']; // Obtener el ID del usuario desde la sesión

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $datos = [
        'nombres' => $_POST['nombres'],
        'email' => $_POST['email'],
        'dni_ruc' => $_POST['dni_ruc']
    ];

    if (!empty($_POST['password'])) {
        $datos['password'] = $_POST['password'];
    }

    $uc->actualizarUsuario($id, $datos);

    header("Location: index.php");
    exit;
}

$usuario = $uc->obtenerUsuarioPorId($id);
?>

<div class="d-flex justify-content-center align-items-center w-100 h-100">
    <div class="container rounded-4 shadow-sm col-lg-6 col-md-12 p-4" style="background-color: white;">
        <h1 class="mb-4 fs-5">Editar perfil</h1>
        <!-- Formulario de edición -->
        <form method="POST" action="">
            <div class="mb-3">
                <label for="nombres" class="form-label">Nombres</label>
                <input type="text" class="form-control" id="nombres" name="nombres" value="<?php echo $usuario->getNombres(); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $usuario->getEmail(); ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password">
                    <button class="btn btn-outline-secondary" type="button" onclick="this.previousElementSibling.type = this.previousElementSibling.type === 'password' ? 'text' : 'password'">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>
            <div class="mb-3">
                <label for="dni_ruc" class="form-label">DNI o RUC</label>
                <input type="text" class="form-control" id="dni_ruc" name="dni_ruc" value="<?php echo $usuario->getDniRuc(); ?>">
            </div>
            <div class="d-flex justify-content-end pt-2 gap-2">
                <a href="/reparto-b2b/index.php" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>
        </form>
    </div>
</div>

<?php
    require_once __DIR__."/layouts/footer.php";
?>
