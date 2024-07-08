<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <link rel="stylesheet" href="css/bootstrap.css">
   <link rel="stylesheet" type="text/css" href="../assets/css/auth/style.css">
   <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
   <!-- <link rel="stylesheet" href="css/all.min.css"> -->
   <!-- <link rel="stylesheet" href="css/fontawesome.min.css"> -->
   <link href="https://tresplazas.com/web/img/big_punto_de_venta.png" rel="shortcut icon">
   <title>Inicio de sesión</title>
</head>

<body>
    <img class="wave" src="../assets/img/auth/wave.png">
    <div class="container">
        <div class="img">
            <img src="../assets/img/auth/bg.webp">
        </div>
        <div class="login-content">
            <form method="post" action="">
                <img src="../assets/img/auth/avatar.svg">
                <h2 class="title">Registrarse</h2>
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
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Apellidos</h5>
                        <input type="text" class="input" name="apellidos" required>
                    </div>
                </div>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="div">
                        <h5>Email</h5>
                        <input type="email" class="input" name="email" required>
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Contraseña</h5>
                        <input type="password" class="input" name="password" required>
                    </div>
                </div>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="div">
                        <h5>Celular</h5>
                        <input type="text" class="input" name="celular" required>
                    </div>
                </div>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <div class="div">
                        <h5>Tipo</h5>
                        <input type="text" class="input" name="tipo" required>
                    </div>
                </div>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <div class="div">
                        <h5>DNI o RUC</h5>
                        <input type="text" class="input" name="dni_ruc" required>
                    </div>
                </div>
                <input type="submit" class="btn" value="Registrarse">
            </form>
        </div>
    </div>
    <script src="../assets/js/fontawesome.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/main2.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.js"></script>
    <script src="../assets/js/bootstrap.bundle.js"></script>
</body>

</html>