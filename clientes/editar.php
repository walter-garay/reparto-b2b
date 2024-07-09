<?php
require_once "../../layouts/header.php";
require_once "../../controladores/EmpresaClienteControlador.php";

$ecc = new EmpresaClienteControlador();
$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $datos = [
        'nombres' => $_POST['nombres'],
        'apellidos' => $_POST['apellidos'],
        'email' => $_POST['email'],
        'celular' => $_POST['celular'],
        'dni_ruc' => $_POST['dni_ruc'],
        'direccion' => $_POST['direccion'],
        'razon_social' => $_POST['razon_social']
    ];

    if (!empty($_POST['password'])) {
        $datos['password'] = $_POST['password'];
    }

    // $ecc->actualizarEmpresaCliente($id, $datos);

    header("Location: index.php");
    exit;
}

$empresaCliente = $ecc->obtenerEmpresaClientePorId($id);
?>

<div class="d-flex justify-content-center align-items-center w-100 h-100 " >
    <div class="container rounded-4 shadow-sm col-lg-6 col-md-12 p-4" style="background-color: white;">
        <h1 class="mb-4 fs-5">Editar empresa cliente #<?php echo $id?></h1>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="nombres" class="form-label">Nombres</label>
                <input type="text" class="form-control" id="nombres" name="nombres" value="<?php echo $empresaCliente->getNombres(); ?>" required>
            </div>
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $empresaCliente->getApellidos(); ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $empresaCliente->getEmail(); ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" value="<?php echo $empresaCliente->getPassword(); ?>">
                    <button class="btn btn-outline-secondary" type="button" onclick="this.previousElementSibling.type = this.previousElementSibling.type === 'password' ? 'text' : 'password'">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>
            <div class="mb-3">
                <label for="celular" class="form-label">Celular</label>
                <input type="text" class="form-control" id="celular" name="celular" value="<?php echo $empresaCliente->getCelular(); ?>">
            </div>
            <div class="mb-3">
                <label for="dni_ruc" class="form-label">DNI o RUC</label>
                <input type="text" class="form-control" id="dni_ruc" name="dni_ruc" value="<?php echo $empresaCliente->getDniRuc(); ?>">
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $empresaCliente->getDireccion(); ?>">
            </div>
            <div class="mb-3">
                <label for="razon_social" class="form-label">Razón Social</label>
                <input type="text" class="form-control" id="razon_social" name="razon_social" value="<?php echo $empresaCliente->getRazonSocial(); ?>">
            </div>
            <div class="d-flex justify-content-end pt-2 gap-2">
                <a href="index.php" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>
        </form>
    </div>
</div>

<?php
    require_once "../../layouts/footer.php";
?>