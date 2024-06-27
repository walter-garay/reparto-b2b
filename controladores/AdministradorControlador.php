<?php
require_once "../modelos/Administrador.php";

class AdministradorControlador {

    public function registrar($nombres, $apellidos, $email, $password, $celular, $tipo, $dni_ruc) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $administrador = new Administrador($nombres, $apellidos, $email, $hashed_password, $celular, $tipo, $dni_ruc);
        $administrador->crear();
    }

    public function obtenerAdministradorPorId($id) {
        $administrador = new Administrador();
        return $administrador->obtenerPorId($id);
    }

    public function mostrarAdministradores() {
        $administrador = new Administrador();
        $administradores = $administrador->obtenerTodos();
        return $administradores;
    }

    public function actualizarAdministrador($id, $nombres, $apellidos, $email, $celular, $tipo, $dni_ruc) {
        $administrador = new Administrador($nombres, $apellidos, $email, $celular, $tipo, $dni_ruc);
        $administrador->actualizar($id);
    }

    public function eliminarAdministrador($id) {
        $administrador = new Administrador();
        $administrador->eliminar($id);
    }
}
?>
