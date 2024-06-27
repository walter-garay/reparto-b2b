<?php
require_once "../modelos/pago.php";

class PagoController {

    public function guardar($monto, $estado, $metodo) {
        $pago = new Pago();
        return $pago->guardar($monto, $estado, $metodo);
    }

    public function mostrar() {
        $pago = new Pago();
        return $pago->mostrar();
    }

    public function eliminar($id) {
        $pago = new Pago();
        return $pago->eliminar($id);
    }

    public function editar($id, $monto, $estado, $metodo) {
        $pago = new Pago();
        return $pago->editar($id, $monto, $estado, $metodo);
    }

    public function buscar($id) {
        $pago = new Pago();
        return $pago->buscar($id);
    }
}
?>
