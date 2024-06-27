<?php

require_once "../modelos/Destinatario.php";

class DestinatarioControlador{

    public function listarDestinatarios() {
        $destinatario = new Destinatario();
        $resultados = $destinatario->obtenerTodos();

        return $resultados;
    }

    public function crearDestinatario($nombres, $apellidos, $email, $numero) {
        $destinatario = new Destinatario($nombres, $apellidos, $email, $numero);
        $destinatario->crear();
    }

    public function actualizarDestinatario($id, $nombres, $apellidos, $email, $numero) {
        $destinatario = new Destinatario($nombres, $apellidos, $email, $numero);
        $destinatario->actualizar($id);
    }
    
    public function eliminarDestinatario($id) {
        $destinatario = new Destinatario();
        $destinatario->eliminar($id);
    }
    /*
    public function eliminarDestinatario($id) {
        $destinatario = new Destinatario();
        $destinatario->eliminar($id);
    }*/

    public function obtenerDestinatarioPorId($id) {
        $destinatario = new Destinatario();
        $resultado = $destinatario->obtenerPorId($id);

        return $resultado;
    }
}

//$controller = new DestinatarioControlador();
//$resultados = $controller->listarDestinatarios();
//$controller->crearDestinatario("Juan", "Pérez", "juan@example.com", "123456789");
//$controller->actualizarDestinatario(1, "Juan", "Pérez", "juan@example.com", "987654321");
//$controller->eliminarDestinatario(2);
//$destinatario = $controller->obtenerDestinatarioPorId(1);
