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
            <h2 class="title">BIENVENIDO</h2>
            <?php 
            ?>
            <div class="input-div one">
               <div class="i">
                  <i class="fas fa-user"></i>
               </div>
               <div class="div">
                  <h5>Email</h5>
                  <input id="email" type="text" class="input" name="email">
               </div>
            </div>
            <div class="input-div pass">
               <div class="i">
                  <i class="fas fa-lock"></i>
               </div>
               <div class="div">
                  <h5>Contraseña</h5>
                  <input type="password" id="input" class="input" name="password">
               </div>
            </div>
            <div class="view ">
               <div class="fas fa-eye verPassword " onclick="vista()" id="verPassword"></div>
            </div>

            <div class="text-center">
               <a class="font-italic isai5" href="register.php">Olvidé mi contraseña</a>
               <a class="font-italic isai5" href="register.php">Registrarse</a>
            </div>
            <input name="login" class="btn" type="submit" value="INICIAR SESION">
            <?php
            if(isset($_POST["login"])){
               $email = $_POST["email"];
               $password = $_POST["password"];
               require_once "../controladores/UsuarioControlador.php";
               $uc = new UsuarioControlador();
               $resultado = $uc->login($email, $password);
            
            }
            ?>
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