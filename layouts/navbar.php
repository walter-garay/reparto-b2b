<style>
    .navbar-nav .nav-link:hover {
        color: #ffcc00; /* Cambia el color al pasar el puntero */
        transition: color 0.3s ease;
    }

    .navbar-text .bi-pencil-square {
        cursor: pointer;
        margin-left: 6px;
    }

    .navbar-text .bi-pencil-square:hover {
        color: #ffcc00; /* Cambia el color del icono de lápiz al pasar el puntero */
        transition: color 0.3s ease;
    }

</style>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="d-flex ms-3 me-4 w-100">
        <img src="/reparto-b2b/assets/img/logo.png" alt="Logo de Confi Courier" width="60px">
        <a class="navbar-brand fw-bolder align-items-center d-flex" href="/reparto-b2b/index.php">Confi Courier</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#servicios">Servicios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#caracteristicas">Características</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#rastreo">Rastreo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contacto">Contacto</a>
                </li> -->
                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/reparto-b2b/deliverys/tracking.php">Tracking</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="solicitud.php">Solicitar delivery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/reparto-b2b/deliverys/">Deliverys</a>                
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/reparto-b2b/repartidores/">Repartidores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/reparto-b2b/clientes/">Clientes</a>
                    </li>

                </ul>
                <?php endif; ?>
            </ul>
            <div class="navbar-nav">
                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <span class="navbar-text text-white me-4">
                        <?php echo $_SESSION['usuario_email'] . " (" . $_SESSION["usuario_tipo"] . ")"; ?>
                        <a href="/reparto-b2b/perfil.php" class="text-white">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                    </span>
                    <a class="btn btn-outline-danger" href="/reparto-b2b/auth/logout.php">Cerrar Sesión</a>
                <?php else: ?>
                    <a class="btn btn-outline-light me-2" href="/reparto-b2b/auth/login.php">Iniciar Sesión</a>
                    <a class="btn btn-primary" href="/reparto-b2b/auth/registro.php">Registrarse</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>