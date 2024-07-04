<?php
require_once "../../layouts/header.php";
require_once "../../controladores/RepartidorControlador.php";

$rc = new RepartidorControlador();
$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $datos = [
        'nombres' => $_POST['nombres'],
        'apellidos' => $_POST['apellidos'],
        'email' => $_POST['email'],
        'celular' => $_POST['celular'],
        'dni_ruc' => $_POST['dni_ruc'],
        'tipo_transporte' => $_POST['tipo_transporte'],
        'placa' => $_POST['placa']
    ];

    if (!empty($_POST['password'])) {
        $datos['password'] = $_POST['password'];
    }

    // $rc->actualizarRepartidor($id, $datos);

    header("Location: index.php");
    exit;
}

    $repartidor = $rc->obtenerRepartidorPorId($id);
?>

<div class="d-flex justify-content-center align-items-center w-100 h-100 ">
    <div class="container rounded-4 shadow-sm col-lg-6 col-md-12 p-4" style="background-color: white;">
        <h1 class="mb-4 fs-5">Editar repartidor #<?php echo $id?></h1>
        <!-- Formulario de edición -->
        <form method="POST" action="">
            <div class="mb-3">
                <label for="nombres" class="form-label">Nombres</label>
                <input type="text" class="form-control" id="nombres" name="nombres" value="<?php echo $repartidor->getNombres(); ?>" required>
            </div>
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $repartidor->getApellidos(); ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $repartidor->getEmail(); ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" value="<?php echo $repartidor->getPassword(); ?>">
                    <button class="btn btn-outline-secondary" type="button" onclick="this.previousElementSibling.type = this.previousElementSibling.type === 'password' ? 'text' : 'password'">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>
            <div class="mb-3">
                <label for="celular" class="form-label">Celular</label>
                <input type="text" class="form-control" id="celular" name="celular" value="<?php echo $repartidor->getCelular(); ?>">
            </div>
            <div class="mb-3">
                <label for="dni_ruc" class="form-label">DNI o RUC</label>
                <input type="text" class="form-control" id="dni_ruc" name="dni_ruc" value="<?php echo $repartidor->getDniRuc(); ?>">
            </div>
            <div class="mb-3">
                <label for="tipo_transporte">Transporte</label>
                <select name="tipo_transporte" class="form-select" aria-label="Seleccionar tipo de transporte">
                    <option value="Motocicleta" <?php echo ($repartidor->getTipoTransporte() == 'Motocicleta') ? 'selected' : ''; ?> >Motocicleta</option>
                    <option value="Bicicleta" <?php echo ($repartidor->getTipoTransporte() == 'Bicicleta') ? 'selected' : ''; ?>>Bicicleta</option>
                    <option value="A pie" <?php echo ($repartidor->getTipoTransporte() == 'A pie') ? 'selected' : ''; ?>>A pie</option>
                </select>            
            </div>
            <div class="mb-3">
                <label for="placa" class="form-label">Placa</label>
                <input type="text" class="form-control" id="placa" name="placa" value="<?php echo $repartidor->getPlaca(); ?>">
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
