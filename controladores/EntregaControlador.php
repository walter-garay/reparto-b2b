<?php
require_once "../modelos/Entrega.php";

class EntregaControlador {

    public function crearEntrega($id_delivery, $id_repartidor, $direccion, $fecha, $hora, $estado, $foto_entrega, $id_inconveniente, $id_calificacion) {
        $entrega = new Entrega($id_delivery, $id_repartidor, $direccion, $fecha, $hora, $estado, $foto_entrega, $id_inconveniente, $id_calificacion);
        $entrega->crear();
    }

    public function obtenerEntregaPorId($id) {
        $entrega = new Entrega();
        return $entrega->obtenerPorId($id);
    }

    public function mostrarEntregas() {
        $entrega = new Entrega();
        $entregas = $entrega->obtenerTodos();
        return $entregas;
    }

    public function actualizarEntrega($id, $id_delivery, $id_repartidor, $direccion, $fecha, $hora, $estado, $foto_entrega, $id_inconveniente, $id_calificacion) {
        $entrega = new Entrega($id_delivery, $id_repartidor, $direccion, $fecha, $hora, $estado, $foto_entrega, $id_inconveniente, $id_calificacion);
        $entrega->actualizar($id);
    }

    public function eliminarEntrega($id) {
        $entrega = new Entrega();
        $entrega->eliminar($id);
    }
}
?>
