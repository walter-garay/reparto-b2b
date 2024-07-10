<?php
if (!empty($_POST["registro"])) {
    if (empty($_POST["nombres"]) || empty($_POST["apellidos"]) || empty($_POST["email"]) || 
        empty($_POST["password"]) || empty($_POST["celular"]) || empty($_POST["tipo"]) || 
        empty($_POST["dni_ruc"])) {
        echo "Uno de los campos está vacío";
    } else {
        $campos_requeridos = ['nombres', 'apellidos', 'email', 'password', 'celular', 'tipo', 'dni_ruc'];
        $datos = [];
        $error = false;

        foreach ($campos_requeridos as $campo) {
            if (empty($_POST[$campo])) {
                $error = true;
                break;
            }
            $datos[$campo] = $_POST[$campo];
        }

        if ($error) {
            echo "Todos los campos son obligatorios.";
        } else {
            // Aquí agregamos los campos adicionales según el tipo de usuario
            switch ($_POST['tipo']) {
                case 'repartidor':
                    $datos['tipo_transporte'] = $_POST['tipo_transporte'] ?? '';
                    $datos['placa'] = $_POST['placa'] ?? '';
                    break;
                case 'empresa_cliente':
                    $datos['direccion'] = $_POST['direccion'] ?? '';
                    $datos['razon_social'] = $_POST['razon_social'] ?? '';
                    break;
                case 'administrador':
                    // No se necesitan campos adicionales para administrador
                    break;
            }

            try {
                require_once "UsuarioControlador.php";
                $controlador = new UsuarioControlador();
                $controlador->crearUsuario($datos);
                echo "Usuario registrado exitosamente.";
            } catch (Exception $e) {
                echo "Error al registrar usuario: " . $e->getMessage();
            }
        }
    }
}

?>