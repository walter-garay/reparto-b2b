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


    <?php require_once 'layouts/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBogGzFj07A1p9X3EVG+Y0QoJIfhK3B79qM8fHbl9623eViz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-q2nyQYgyAJqrM7IUl2QZJcFzQWVCVwRcOusOOyQ6PvLNA5BT6QrABFFT3zCwQ/Y4" crossorigin="anonymous"></script>
</body>
</html>
