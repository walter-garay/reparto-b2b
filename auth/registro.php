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
            <form method="POST" action="" class="formulario">
                <img src="img/avatar.svg">
                <h2 class="title">Registrarse</h2>
                <?php
                include ("../../modelos/Conexion.php");
                include ("../../controladores/RegistrarControlador.php");
                ?>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Nombres</h5>
                        <input type="text" class="input" name="nombres" >
                    </div>
                </div>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Apellidos</h5>
                        <input type="text" class="input" name="apellidos" >
                    </div>
                </div>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="div">
                        <h5>Email</h5>
                        <input type="email" class="input" name="email" >
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Contraseña</h5>
                        <input type="password" class="input" name="password" >
                    </div>
                </div>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="div">
                        <h5>Celular</h5>
                        <input type="text" class="input" name="celular" >
                    </div>
                </div>
                <div class="input-div one">
                <div class="i">
                    <i class="fas fa-id-card"></i>
                </div>
                <div class="div">
                    <select class="input" name="tipo">
                        <option value="">Seleccione un tipo</option>
                        <option value="repartidor">Repartidor</option>
                        <option value="empresa_cliente">Empresa Cliente</option>
                        <option value="administrador">Administrador</option>
                    </select>
                </div>
                </div>

                <!-- Campo repartidor-->
                <div id="campos_repartidor" style="display: none;" class="input-div one">
                    <div class="div" >
                        <input type="text" name="tipo_transporte" placeholder="Tipo de Transporte" >
                    </div>
                    <div class="div">
                        <input type="text" name="placa" placeholder="Placa" >
                    </div>
                </div>

                <!-- Campo empresa cliente-->
                <div id="campos_empresa_cliente" style="display: none;" class="input-div one">
                    <div class="div" >
                        <h5></h5>
                        <input type="text" name="direccion" placeholder="Direccion" class="input" >
                    </div>
                    <div class="div">
                        <input type="text" name="razon_social" placeholder="Razon social" class="input" >
                    </div>
                </div>

                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <div class="div">
                        <h5>DNI o RUC</h5>
                        <input type="text" class="input" name="dni_ruc" >
                    </div>
                </div>
                <div class="text-center">
                    <a class="font-italic isai5" href="login.php">Iniciar sesión</a>
                </div>
                <input type="submit" class="btn" value="Registrarse" name="registro">
            </form>
        </div>
    </div>
    <script>
        // JavaScript para mostrar/ocultar campos adicionales según el tipo de usuario seleccionado
        document.querySelector('select[name="tipo"]').addEventListener('change', function() {
            document.getElementById('campos_repartidor').style.display = this.value === 'repartidor' ? 'block' : 'none';
            document.getElementById('campos_empresa_cliente').style.display = this.value === 'empresa_cliente' ? 'block' : 'none';
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