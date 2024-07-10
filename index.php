<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONFI COURIER - B2B</title>
    <link rel="icon" href="assets/img/icon.jpg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/crud.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Confi Courier</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
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
                    </li>
                </ul>
                <div class="navbar-nav">
                    <a class="btn btn-outline-light me-2" href="#">Iniciar Sesión</a>
                    <a class="btn btn-primary" href="#">Registrarse</a>
                </div>
            </div>
        </div>
    </nav>

    <header class="hero-section" id="inicio">
        <div class="container text-center">
            <h1 class="display-2 mb-4">Confi Courier</h1>
            <p class="lead mb-4">Entregas confiables y seguras en todo el país</p>
            <a href="#rastreo" class="btn btn-primary btn-lg me-3">Rastrear Pedido</a>
            <a href="#contacto" class="btn btn-outline-light btn-lg">Solicitar Servicio</a>
        </div>
    </header>

    <main>
        <section id="servicios" class="py-5">
            <div class="container">
                <h2 class="text-center mb-5">Nuestros Servicios</h2>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card service-card">
                            <img src="images/express-delivery.jpg" class="card-img-top" alt="Entrega Express">
                            <div class="card-body">
                                <h5 class="card-title">Entrega Express</h5>
                                <p class="card-text">Entrega en el mismo día para envíos urgentes en la ciudad.</p>
                                <a href="#" class="btn btn-primary">Más Información</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card service-card">
                            <img src="images/national-delivery.jpg" class="card-img-top" alt="Entrega Nacional">
                            <div class="card-body">
                                <h5 class="card-title">Entrega Nacional</h5>
                                <p class="card-text">Envíos a todo el país con tiempos de entrega garantizados.</p>
                                <a href="#" class="btn btn-primary">Más Información</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card service-card">
                            <img src="images/corporate-services.jpg" class="card-img-top" alt="Servicios Corporativos">
                            <div class="card-body">
                                <h5 class="card-title">Servicios Corporativos</h5>
                                <p class="card-text">Soluciones logísticas personalizadas para empresas.</p>
                                <a href="#" class="btn btn-primary">Más Información</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <section id="caracteristicas" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">¿Por qué elegir Confi Courier?</h2>
            <div class="row">
                <div class="col-md-4 text-center mb-4">
                    <div class="feature-icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <h3>Entrega Rápida</h3>
                    <p>Garantizamos los tiempos de entrega más rápidos del mercado.</p>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Seguridad Garantizada</h3>
                    <p>Sus paquetes están asegurados y protegidos durante todo el trayecto.</p>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <div class="feature-icon">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <h3>Rastreo en Tiempo Real</h3>
                    <p>Siga sus envíos en tiempo real con nuestra tecnología de rastreo avanzada.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="rastreo" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Rastrear su Pedido</h2>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Ingrese su código de seguimiento" aria-label="Código de seguimiento">
                            <button class="btn btn-primary" type="button">Rastrear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

        <section id="contacto" class="py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-5">Contáctenos</h2>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <form>
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Nombre" required>
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" rows="5" placeholder="Mensaje" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <h4>Información de Contacto</h4>
                        <p><strong>Dirección:</strong> Av. Principal 123, Ciudad Logística</p>
                        <p><strong>Teléfono:</strong> +1 234 567 890</p>
                        <p><strong>Email:</strong> info@conficourier.com</p>
                        <div class="mt-4">
                            <h5>Síguenos en redes sociales</h5>
                            <a href="#" class="text-dark me-3"><i class="fab fa-facebook-f fa-2x"></i></a>
                            <a href="#" class="text-dark me-3"><i class="fab fa-twitter fa-2x"></i></a>
                            <a href="#" class="text-dark me-3"><i class="fab fa-instagram fa-2x"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php require_once 'layouts/footer.php'; ?>
</body>
</html>