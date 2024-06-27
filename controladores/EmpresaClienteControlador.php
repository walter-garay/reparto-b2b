<?php
require_once "../modelos/EmpresaCliente.php";

class EmpresaClienteControlador {

    public function registrar($nombres, $apellidos, $email, $password, $celular, $tipo, $dni_ruc, $direccion, $razon_social) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $empresaCliente = new EmpresaCliente($nombres, $apellidos, $email, $hashed_password, $celular, $tipo, $dni_ruc, $direccion, $razon_social);
        $empresaCliente->crear();
    }

    public function obtenerEmpresaClientePorId($id) {
        $empresaCliente = new EmpresaCliente();
        return $empresaCliente->obtenerPorId($id);
    }

    public function mostrarEmpresasClientes() {
        $empresaCliente = new EmpresaCliente();
        $empresasClientes = $empresaCliente->obtenerTodos();
        return $empresasClientes;
    }

    public function actualizarEmpresaCliente($id, $nombres, $apellidos, $email, $celular, $tipo, $dni_ruc, $direccion, $razon_social) {
        $empresaCliente = new EmpresaCliente($nombres, $apellidos, $email, $celular, $tipo, $dni_ruc, $direccion, $razon_social);
        $empresaCliente->actualizar($id);
    }

    public function eliminarEmpresaCliente($id) {
        $empresaCliente = new EmpresaCliente();
        $empresaCliente->eliminar($id);
    }
}

?>
