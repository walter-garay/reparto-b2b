<?php

require_once __DIR__ . '../modelos/Contraentrega.php';

class ContraentregaControlador
{
    private $contraentrega;

    public function __construct()
    {
        $this->contraentrega = new Contraentrega();
    }

    public function obtenerContraentregas()
    {
        return $this->contraentrega->obtenerTodos();
    }

    public function obtenerContraentregaPorId($id)
    {
        return $this->contraentrega->obtenerPorId($id);
    }

    public function crearContraentrega($datos)
    {
        $contraentrega = new Contraentrega(
            $datos['costo_delivery'],
            $datos['costo_pedido']
        );
        return $contraentrega->crear();
    }

    public function actualizarContraentrega($id, $datos)
    {
        $contraentrega = $this->obtenerContraentregaPorId($id);
        if (!$contraentrega) {
            return false;
        }

        $contraentrega->setCostoDelivery($datos['costo_delivery']);
        $contraentrega->setCostoPedido($datos['costo_pedido']);

        return $contraentrega->actualizar();
    }

    public function eliminarContraentrega($id)
    {
        return $this->contraentrega->eliminar($id);
    }
}
?>
