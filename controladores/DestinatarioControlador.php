<?php

require_once __DIR__ . '/../modelos/Destinatario.php';

class DestinatarioControlador
{
    private $destinatario;

    public function __construct()
    {
        $this->destinatario = new Destinatario();
    }

    public function obtenerDestinatarios()
    {
        return $this->destinatario->obtenerTodos();
    }

    public function obtenerDestinatarioPorId($id)
    {
        return $this->destinatario->obtenerPorId($id);
    }

    public function crearDestinatario($datos)
    {
        $destinatario = new Destinatario(
            $datos['dni'],
            $datos['nombres'],
            $datos['apellidos'],
            $datos['celular']
        );
        return $destinatario->crear();
    }

    public function actualizarDestinatario($id, $datos)
    {
        $destinatario = $this->obtenerDestinatarioPorId($id);
        if (!$destinatario) {
            return false;
        }

        $destinatario->setDni($datos['dni']);
        $destinatario->setNombres($datos['nombres']);
        $destinatario->setApellidos($datos['apellidos']);
        $destinatario->setCelular($datos['celular']);

        return $destinatario->actualizar();
    }

    public function eliminarDestinatario($id)
    {
        return $this->destinatario->eliminar($id);
    }
}

?>
