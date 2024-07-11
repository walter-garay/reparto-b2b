<?php

require_once "../modelos/Delivery.php";
require_once "../modelos/Recojo.php";
require_once "../modelos/Entrega.php";
require_once "../modelos/Destinatario.php";
require_once "../modelos/Pago.php";
require_once "../modelos/Contraentrega.php";
require_once "../modelos/EmpresaCliente.php";


class DeliveryControlador
{
    private $delivery;

    public function __construct()
    {
        $this->delivery = new Delivery();
    }

    public function obtenerDeliveries()
    {
        return $this->delivery->obtenerTodos();
    }

    public function obtenerDeliveryPorId($id)
    {
        return $this->delivery->obtenerPorId($id);
    }

    public function crearDelivery($datos)
    {
        $delivery = new Delivery();
        
        try {
            $delivery->setDescripcion(isset($datos['descripcion']) ? $datos['descripcion'] : null);
            $delivery->setCodSeguimiento(isset($datos['cod_seguimiento']) ? $datos['cod_seguimiento'] : null);
            $delivery->setFechaSolicitud(isset($datos['fecha_solicitud']) ? $datos['fecha_solicitud'] : null);
            $delivery->setIdCliente(isset($datos['id_cliente']) ? $datos['id_cliente'] : null);
            $delivery->setIdRecojo(isset($datos['id_recojo']) ? $datos['id_recojo'] : null);
            $delivery->setIdEntrega(isset($datos['id_entrega']) ? $datos['id_entrega'] : null);
            $delivery->setIdPago(isset($datos['id_pago']) ? $datos['id_pago'] : null);
            $delivery->setIdContraentrega(isset($datos['id_contraentrega']) ? $datos['id_contraentrega'] : null);
            $delivery->setIdDestinatario(isset($datos['id_destinatario']) ? $datos['id_destinatario'] : null);

            if ($delivery->crear()) {
                return $delivery->getId();
            }
        } catch (Exception $e) {
            throw $e;
        }
        return false;
    }

    public function actualizarDelivery($id, $datos)
    {
        $delivery = $this->obtenerDeliveryPorId($id);
        if (!$delivery) {
            return false;
        }

        $delivery->setDescripcion(isset($datos['descripcion']) ? $datos['descripcion'] : $delivery->getDescripcion());
        $delivery->setCodSeguimiento(isset($datos['cod_seguimiento']) ? $datos['cod_seguimiento'] : $delivery->getCodSeguimiento());
        $delivery->setFechaSolicitud(isset($datos['fecha_solicitud']) ? $datos['fecha_solicitud'] : $delivery->getFechaSolicitud());
        $delivery->setIdCliente(isset($datos['id_cliente']) ? $datos['id_cliente'] : $delivery->getIdCliente());
        $delivery->setIdRecojo(isset($datos['id_recojo']) ? $datos['id_recojo'] : $delivery->getIdRecojo());
        $delivery->setIdEntrega(isset($datos['id_entrega']) ? $datos['id_entrega'] : $delivery->getIdEntrega());
        $delivery->setIdPago(isset($datos['id_pago']) ? $datos['id_pago'] : $delivery->getIdPago());
        $delivery->setIdContraentrega(isset($datos['id_contraentrega']) ? $datos['id_contraentrega'] : $delivery->getIdContraentrega());
        $delivery->setIdDestinatario(isset($datos['id_destinatario']) ? $datos['id_destinatario'] : $delivery->getIdDestinatario());

        return $delivery->actualizar();
    }

    public function eliminarDelivery($id)
    {
        return $this->delivery->eliminar($id);
    }

    public function obtenerDeliveriesPorCliente($idCliente)
    {
        return $this->delivery->obtenerPorCliente($idCliente);
    }

}