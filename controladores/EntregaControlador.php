<?php

require_once __DIR__ . '/../modelos/Entrega.php';

class EntregaControlador
{
    private $entrega;

    public function __construct()
    {
        $this->entrega = new Entrega();
    }

    public function obtenerEntregas()
    {
        return $this->entrega->obtenerTodos();
    }

    public function obtenerEntregaPorId($id)
    {
        return $this->entrega->obtenerPorId($id);
    }

    public function crearEntrega($datos)
    {
        $fecha = date('Y-m-d', strtotime($datos['fecha']));
        $hora = date('H:i:s', strtotime($datos['hora']));

        $entrega = new Entrega(
            $datos['id_repartidor'],
            $datos['direccion'],
            $fecha,
            $hora,
            $datos['estado'],
            $datos['foto_entrega'],
            $datos['id_inconveniente'],
            $datos['id_calificacion']
        );
        return $entrega->crear();
    }

    public function actualizarEntrega($id, $datos)
    {
        $entrega = $this->obtenerEntregaPorId($id);
        if (!$entrega) {
            return false;
        }

        $entrega->setIdRepartidor($datos['id_repartidor']);
        $entrega->setDireccion($datos['direccion']);
        $entrega->setFecha($datos['fecha']);
        $entrega->setHora($datos['hora']);
        $entrega->setEstado($datos['estado']);
        $entrega->setFotoEntrega($datos['foto_entrega']);
        $entrega->setIdInconveniente($datos['id_inconveniente']);
        $entrega->setIdCalificacion($datos['id_calificacion']);

        return $entrega->actualizar();
    }

    public function eliminarEntrega($id)
    {
        return $this->entrega->eliminar($id);
    }
}
?>
