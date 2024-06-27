<?php
require_once "../modelos/Repartidor.php";

class RepartidorControlador {

    public function registrar($nombres, $apellidos, $email, $password, $celular, $tipo, $dni_ruc, $tipo_transporte, $placa) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $repartidor = new Repartidor($nombres, $apellidos, $email, $hashed_password, $celular, $tipo, $dni_ruc, $tipo_transporte, $placa);
        $repartidor->crear();
    }

    public function obtenerRepartidorPorId($id) {
        $repartidor = new Repartidor();
        return $repartidor->obtenerPorId($id);
    }

    public function mostrarRepartidores() {
        $repartidor = new Repartidor();
        $repartidores = $repartidor->obtenerTodos();
        return $repartidores;
    }

    public function actualizarRepartidor($id, $nombres, $apellidos, $email, $celular, $tipo, $dni_ruc, $tipo_transporte, $placa) {
        $repartidor = new Repartidor($nombres, $apellidos, $email, $celular, $tipo, $dni_ruc, $tipo_transporte, $placa);
        $repartidor->actualizar($id);
    }

    public function eliminarRepartidor($id) {
        $repartidor = new Repartidor();
        $repartidor->eliminar($id);
    }
}
?>
