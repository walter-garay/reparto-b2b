<?php

require_once __DIR__ . '/../modelos/Pago.php';

class PagoControlador
{
    private $pago;

    public function __construct()
    {
        $this->pago = new Pago();
    }

    public function obtenerPagos()
    {
        return $this->pago->obtenerTodos();
    }

    public function obtenerPagoPorId($id)
    {
        return $this->pago->obtenerPorId($id);
    }

    public function crearPago($datos)
    {
        $this->pago->setMonto($datos['monto']);
        $this->pago->setEstado($datos['estado']);
        $this->pago->setEstado($datos['metodo']);
        return $this->pago->crear();
    }

    public function actualizarPago($id, $datos)
    {
        $pago = $this->obtenerPagoPorId($id);
        if (!$pago) {
            return false;
        }
        $pago->setMonto($datos['monto']);
        $pago->setEstado($datos['estado']);
        $pago->setMetodo($datos['metodo']);

        return $pago->actualizar();
    }

    public function eliminarPago($id)
    {
        return $this->pago->eliminar($id);
    }
}
?>
