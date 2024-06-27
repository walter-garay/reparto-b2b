<?php
require_once "../modelos/Usuario.php";

class UsuarioControlador {

    public function login($email, $password) {
        $usuario = new Usuario();
        $usuarioValidado = $usuario->obtenerPorEmail($email);
        $contador = 0;
        $usuario_id = null;
        $usuario_nombre = null;
        $password_bd = null;
        $tipo = null;
    
        foreach($usuarioValidado as $item){
            $usuario_id = $item["id"];
            $usuario_nombre = $item["nombres"] . " " . $item["apellidos"];
            $password_bd = $item["password"];
            $tipo = $item["tipo"];
            $contador++;
        }
    
        if($contador > 0){
            if(password_verify($password, $password_bd)){
                session_start();
                $_SESSION["id"] = $usuario_id;
                $_SESSION["usuario"] = $usuario_nombre;
                $_SESSION["tipo"] = $tipo;
                header("Location: main.php");
                exit();
            } else {
                echo "Contraseña incorrecta";
            }
        } else {
            echo "Usuario no encontrado";
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: login.php");
    }

    public function registrar($nombres, $apellidos, $email, $password, $celular, $tipo, $dni_ruc) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $usuario = new Usuario($nombres, $apellidos, $email, $hashed_password, $celular, $tipo, $dni_ruc);
        $usuario->crear();
    }

    public function obtenerUsuarioPorId($id) {
        $usuario = new Usuario();
        return $usuario->obtenerPorId($id);
    }

    public function mostrarUsuarios() {
        $usuario = new Usuario();
        $usuarios = $usuario->obtenerTodos();
        return $usuarios;
    }

    public function actualizarUsuario($id, $nombres, $apellidos, $email, $celular, $tipo, $dni_ruc) {
        $usuario = new Usuario($nombres, $apellidos, $email, $celular, $tipo, $dni_ruc);
        $usuario->actualizar($id);
    }

    public function eliminarUsuario($id) {
        $usuario = new Usuario();
        $usuario->eliminar($id);
    }
}
