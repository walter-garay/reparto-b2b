<?php

require_once __DIR__ . '/../modelos/Recojo.php';

class RecojoControlador
{
    private $recojo;

    public function __construct()
    {
        $this->recojo = new Recojo();
    }

    public function obtenerRecojos()
    {
        return $this->recojo->obtenerTodos();
    }

    public function obtenerRecojoPorId($id)
    {
        return $this->recojo->obtenerPorId($id);
    }

    public function crearRecojo($datos)
    {
        $recojo = new Recojo(
            $datos['id_repartidor'],
            $datos['direccion'],
            $datos['fecha'],
            $datos['hora'],
            $datos['estado'],
            $datos['id_inconveniente']
        );
        return $recojo->crear();
    }

    public function actualizarRecojo($id, $datos)
    {
        $recojo = $this->obtenerRecojoPorId($id);
        if (!$recojo) {
            return false;
        }

        $recojo->setIdRepartidor($datos['id_repartidor']);
        $recojo->setDireccion($datos['direccion']);
        $recojo->setFecha($datos['fecha']);
        $recojo->setHora($datos['hora']);
        $recojo->setEstado($datos['estado']);
        $recojo->setIdInconveniente($datos['id_inconveniente']);

        return $recojo->actualizar();
    }

    public function eliminarRecojo($id)
    {
        return $this->recojo->eliminar($id);
    }
}
?>
