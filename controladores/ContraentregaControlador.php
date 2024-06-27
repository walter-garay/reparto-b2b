<?php
require_once "../modelos/Contraentrega.php";

class ContraentregaControlador {

    public function registrar($costo_delivery, $costo_pedido) {
        $contraentrega = new Contraentrega($costo_delivery, $costo_pedido);
        $contraentrega->crear();
    }

    public function obtenerContraentregaPorId($id) {
        $contraentrega = new Contraentrega();
        return $contraentrega->obtenerPorId($id);
    }

    public function mostrarContraentregas() {
        $contraentrega = new Contraentrega();
        $contraentregas = $contraentrega->obtenerTodos();
        return $contraentregas;
    }

    public function actualizarContraentrega($id, $costo_delivery, $costo_pedido) {
        $contraentrega = new Contraentrega($costo_delivery, $costo_pedido);
        $contraentrega->actualizar($id);
    }

    public function eliminarContraentrega($id) {
        $contraentrega = new Contraentrega();
        $contraentrega->eliminar($id);
    }
}
?>
