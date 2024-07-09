<?php
session_start();
require_once "../controladores/EmpresaClienteControlador.php";
require_once "../layouts/header.php";

$ec = new EmpresaClienteControlador();
$empresasClientes = $ec->mostrarEmpresasClientes();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminar_id'])) {
    $id = $_POST['eliminar_id'];
    $ec->eliminarEmpresaCliente($id);
    header('Location: index.php');
}
?>

<div class="container pt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="fs-5 mb-0">Empresas Clientes</h1>
        <a href="crear.php" class="rounded-2 btn btn-primary btn-sm">Agregar Empresa Cliente</a>
    </div>

    <div class="table-responsive table-bordered">
        <table class="table rounded-circle">
            <thead class="table" style="background-color: aqua;">
                <tr>
                    <th class="fw-medium" scope="col">#</th>
                    <th class="fw-medium" scope="col">Nombres</th>
                    <th class="fw-medium" scope="col">Apellidos</th>
                    <th class="fw-medium" scope="col">Email</th>
                    <th class="fw-medium" scope="col">Celular</th>
                    <th class="fw-medium" scope="col">DNI/RUC</th>
                    <th class="fw-medium" scope="col">Dirección</th>
                    <th class="fw-medium" scope="col">Razón Social</th>
                    <th class="fw-medium" scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($empresasClientes as $empresaCliente): ?>
                    <tr>
                        <td><?php echo $empresaCliente->getId(); ?></td>
                        <td><?php echo $empresaCliente->getNombres(); ?></td>
                        <td><?php echo $empresaCliente->getApellidos(); ?></td>
                        <td><?php echo $empresaCliente->getEmail(); ?></td>
                        <td><?php echo $empresaCliente->getCelular(); ?></td>
                        <td><?php echo $empresaCliente->getDniRuc(); ?></td>
                        <td><?php echo $empresaCliente->getDireccion(); ?></td>
                        <td><?php echo $empresaCliente->getRazonSocial(); ?></td>
                        <td class="d-flex gap-1">
                            <a href="editar.php?id=<?php echo $empresaCliente->getId(); ?>" class="btn rounded-circle p-0 btn-custom edit">
                                <i class="bi bi-pencil icon edit d-flex justify-content-center align-items-center"></i>                                
                            </a>
                            <form method="POST" action="index.php" class="d-flex">
                                <input type="hidden" name="eliminar_id" value="<?php echo $empresaCliente->getId(); ?>">
                                <button type="submit" class="btn p-0 btn-custom delete rounded-circle" onclick="return confirm('¿Está seguro de que desea eliminar esta empresa cliente?');">
                                    <i class="bi bi-trash3 icon delete d-flex justify-content-center align-items-center"></i>                                
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once "../layouts/footer.php"; ?>
