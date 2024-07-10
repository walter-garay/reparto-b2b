<?php

require_once "../modelos/Calificacion.php";


class CalificacionController {
    public function guardar($puntaje, $comentario) {
        $calificacion = new Calificacion($puntaje, $comentario);
        return $calificacion->guardar($puntaje, $comentario);
    }

    public function mostrar() {
        $calificacion = new Calificacion($puntaje, $comentario);
        return $calificacion->mostrar();
    }
    public function eliminar($id) {
        $calificacion = new Calificacion($puntaje, $comentario);
        return $calificacion->eliminar($id);
    }

    public function editar($id, $puntaje, $comentario) {
        $calificacion = new Calificacion($puntaje, $comentario);
        return $calificacion->editar($id, $puntaje, $comentario);
    }

    public function buscar($id) {
        $calificacion = new Calificacion($puntaje, $comentario);
        return $calificacion->buscar($id);
    }
   

   
}

?>
