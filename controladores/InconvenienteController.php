<?php
require_once "../modelos/Inconveniente.php";

class InconvenienteController {

    public function obtenerInconvenientePorId($id) {
        $inconveniente = new Inconveniente();
        return $inconveniente->obtenerPorId($id);
    }

    public function mostrarInconvenientes() {
        $inconveniente = new Inconveniente();
        $inconvenientes = $inconveniente->obtenerTodoslosInconvenientes();
        return $inconvenientes;
    }

    public function actualizarInconveniente($id, $descripcion, $foto_prueba) {
        $inconveniente = new Inconveniente($descripcion, $foto_prueba);
        $inconveniente->actualizarInconveniente($id);
    }

    public function eliminarInconveniente($id) {
        $inconveniente = new Inconveniente();
        $inconveniente->eliminarInconveniente($id);
    }
}
?>
