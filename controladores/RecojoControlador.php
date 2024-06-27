<?php
require_once "../modelos/Recojo.php";

class RecojoControlador {

    public function obtenerRecojoPorId($id) {
        $recojo = new Recojo();
        return $recojo->obtenerPorId($id);
    }

    public function mostrarRecojos() {
        $recojo = new Recojo();
        $recojos = $recojo->obtenerTodos();
        return $recojos;
    }

    public function actualizarRecojo($id, $id_delivery, $id_repartidor, $direccion, $fecha, $hora, $estado, $id_inconveniente) {
        $recojo = new Recojo($id_delivery, $id_repartidor, $direccion, $fecha, $hora, $estado, $id_inconveniente);
        $recojo->actualizar($id);
    }

    public function eliminarRecojo($id) {
        $recojo = new Recojo();
        $recojo->eliminar($id);
    }
}
?>
