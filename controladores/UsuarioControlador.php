<?php
require_once "../modelos/Usuario.php";

class UsuarioControlador {

    public function login($email, $password) {
        $usuario = new Usuario();
        $resultado = $usuario->obtenerPorEmail($email);
        if ($resultado) {
            $row = $resultado->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $row['password'])) {
                session_start();
                $_SESSION['usuario'] = $row;
                header("Location: main.php");
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

    public function mostrarUsuarios() {
        $usuario = new Usuario();
        $usuarios = $usuario->obtenerTodos();
        return $usuarios;
    }

    public function actualizarUsuario($id, $nombres, $apellidos, $email, $password, $celular, $tipo, $dni_ruc) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $usuario = new Usuario($nombres, $apellidos, $email, $hashed_password, $celular, $tipo, $dni_ruc);
        $usuario->actualizar($id);
    }

    public function eliminarUsuario($id) {
        $usuario = new Usuario();
        $usuario->eliminar($id);
    }
}
