<?php

require_once "../modelos/Calificacion.php";

class CalificacionControlador
{
    private $calificacion;

    public function __construct()
    {
        $this->calificacion = new Calificacion();
    }

    public function crearCalificacion($puntaje, $comentario)
    {
        $calificacion = new Calificacion($puntaje, $comentario);
        return $calificacion->crear();
    }

    public function obtenerCalificacionPorId($id)
    {
        $calificacion = new Calificacion();
        return $calificacion->obtenerPorId($id);
    }

    public function obtenerCalificaciones()
    {
        $calificacion = new Calificacion();
        return $calificacion->obtenerTodos();
    }

    public function eliminarCalificacion($id)
    {
        $calificacion = new Calificacion();
        return $calificacion->eliminar($id);
    }

    public function actualizarCalificacion($id, $puntaje, $comentario)
    {
        $calificacion = new Calificacion();
        return $calificacion->editar($id, $puntaje, $comentario);
    }
}
