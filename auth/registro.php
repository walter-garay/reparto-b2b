<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/auth/style.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <link href="https://tresplazas.com/web/img/big_punto_de_venta.png" rel="shortcut icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <title>Registrarse</title>
</head>

<body>
    <img class="wave" src="../assets/img/auth/wave.png">
    <div class="container">
        <div class="img">
            <img src="../assets/img/auth/bg.webp">
        </div>
        <div class="login-content">
            <form method="POST" action="" class="formulario">
                <img src="../assets/img/auth/avatar.svg">
                <h2 class="title">Registrarse</h2>
                <?php
                require_once "../controladores/UsuarioControlador.php";
                if (isset($_POST['registro'])) {
                    $controlador = new UsuarioControlador();
                    $datos = [
                        'nombres' => $_POST['nombres'],
                        'dni_ruc' => $_POST['dni_ruc'],
                        'email' => $_POST['email'],
                        'password' => $_POST['password'],
                        'tipo' => 'Cliente' 
                    ];
                    $controlador->crearUsuario($datos);
                }
                ?>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Nombres</h5>
                        <input type="text" class="input" name="nombres" required>
                    </div>
                </div>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <div class="div">
                        <h5>RUC o DNI</h5>
                        <input type="text" class="input" name="dni_ruc" required>
                    </div>
                </div>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="div">
                        <h5>Correo</h5>
                        <input type="email" class="input" name="email" required>
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Contraseña</h5>
                        <input type="password" class="input" name="password" id="password" required>
                    </div>
                </div>
                <div class="text-center">
                    <a class="font-italic isai5" href="login.php">Iniciar sesión</a>
                </div>
                <input type="submit" class="btn" value="Registrarse" name="registro">
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.js"></script>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function (e) {
            // Alternar el tipo de input entre 'password' y 'text'
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // Alternar el icono
            this.classList.toggle('bi-eye');
        });
    </script>
    <script src="../assets/js/fontawesome.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/main2.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.js"></script>
    <script src="../assets/js/bootstrap.bundle.js"></script>
</body>

</html>
