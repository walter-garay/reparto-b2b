<?php
session_start();
?>

<!DOTYPE html>
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
    <style>
        .hero-section {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: url('assets/img/hero-bg.jpg') no-repeat center center/cover;
            background-color: rgba(0, 0, 0, 0.7); /* Fondo oscuro */
            color: white; /* Texto blanco */
            text-align: center; /* Centrar todos los elementos */
        }
        .service-card {
            height: 100%;
            transition: transform 0.3s ease;
        }
        .service-card:hover {
            transform: scale(1.05);
        }
        .service-card img {
            height: 200px;
            object-fit: cover;
        }
        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        .contact-section {
            background-color: #f8f9fa; /* Fondo claro para sección de contacto */
            padding: 50px 0;
        }
        .contact-section h2 {
            margin-bottom: 30px;
        }
        .contact-section form {
            background: white;
            padding: 20px;
            border-radius: 5px;
        }
        .contact-section .info {
            padding: 20px;
            background: white;
            border-radius: 5px;
        }
    </style>

</head>

<body>
    <?php require_once "./layouts/navbar.php"; ?>

    <header class="hero-section h1" id="inicio">
        <div class="container text-center text-light">
            <h1 class="display-2 mb-4">Confi Courier</h1>
            <p class="lead mb-4">Entregas confiables y seguras en Huánuco</p>
            <a href="#rastreo" class="btn btn-outline-light btn-lg me-2">Rastrear Pedido</a>
            <a href="/reparto-b2b/deliverys/solicitud.php" class="btn btn-primary btn-lg ">Solicitar Servicio</a>
        </div>
    </header>

    <main class="bg-light">
        <div class="main-content">
            <section id="servicios" class="py-5">
                <div class="container">
                    <h2 class="text-center mb-5">Nuestros Servicios</h2>
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card service-card">
                                <img src="https://www.ecommercenews.pe/wp-content/uploads/2023/02/ia-2-1-1280x720.png" class="card-img-top" alt="Entrega Express">
                                <div class="card-body">
                                    <h5 class="card-title ">Entrega Express</h5>
                                    <p class="card-text">Entrega en el mismo día para envíos urgentes en la ciudad.</p>
                                    <a href="#" class="btn btn-primary">Más Información</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card service-card">
                                <img src="https://bboxcourier.com/wp-content/uploads/2023/08/servicios-couriers-.jpg" class="card-img-top" alt="Entrega Nacional">
                                <div class="card-body">
                                    <h5 class="card-title">Entrega Nacional</h5>
                                    <p class="card-text">Envíos a todo el país con tiempos de entrega garantizados.</p>
                                    <a href="#" class="btn btn-primary">Más Información</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card service-card">
                                <img src="https://bluorbitexpress.com/wp-content/uploads/2023/07/advantages-of-using-courier-service-for-b2b-businesses-2.jpg" class="card-img-top" alt="Servicios Corporativos">
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
                            <h3 class="fs-5 mt-2">Entrega Rápida</h3>
                            <p>Garantizamos los tiempos de entrega más rápidos del mercado.</p>
                        </div>
                        <div class="col-md-4 text-center mb-4">
                            <div class="feature-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <h3 class="fs-5 mt-2">Seguridad Garantizada</h3>
                            <p>Sus paquetes están asegurados y protegidos durante todo el trayecto.</p>
                        </div>
                        <div class="col-md-4 text-center mb-4">
                            <div class="feature-icon">
                                <i class="fas fa-map-marked-alt"></i>
                            </div>
                            <h3 class="fs-5 mt-2">Rastreo en Tiempo Real</h3>
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

            <section id="contacto" class="contact-section">
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
                            <div class="info">
                                <h4 class="fs-5">Información de Contacto</h4>
                                <p><strong>Dirección:</strong> Av. Principal 123, Ciudad Logística</p>
                                <p><strong>Teléfono:</strong> +1 234 567 890</p>
                                <p><strong>Email:</strong> info@conficourier.com</p>
                                <div class="mt-4">
                                    <h5 class="fs-6">Síguenos en redes sociales</h5>
                                    <a href="#" class="text-dark me-3"><i class="fab fa-facebook-f fa-2x"></i></a>
                                    <a href="#" class="text-dark me-3"><i class="fab fa-twitter fa-2x"></i></a>
                                    <a href="#" class="text-dark me-3"><i class="fab fa-instagram fa-2x"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <?php require_once 'layouts/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBogGzFj07A1p9X3EVG+Y0QoJIfhK3B79qM8fHbl9623eViz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-q2nyQYgyAJqrM7IUl2QZJcFzQWVCVwRcOusOOyQ6PvLNA5BT6QrABFFT3zCwQ/Y4" crossorigin="anonymous"></script>
</body>
</html>
