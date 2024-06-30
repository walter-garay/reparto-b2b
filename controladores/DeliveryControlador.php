<?php

require_once "../../modelos/Delivery.php";
require_once "../../modelos/Recojo.php";
require_once "../../modelos/Entrega.php";
require_once "../../modelos/Destinatario.php";
require_once "../../modelos/Pago.php";
require_once "../../modelos/Contraentrega.php";


class DeliveryControlador
{
    private $delivery;

    public function __construct()
    {
        $this->delivery = new Delivery();
    }

    public function obtenerDeliverys()
    {
        return $this->delivery->obtenerTodos();
    }

    public function obtenerDeliveryPorId($id)
    {
        return $this->delivery->obtenerPorId($id);
    }

    // public function crearDelivery($datos)
    // {
    //     $delivery = new Delivery(
    //         $datos['descripcion'],
    //         $datos['cod_seguimiento'],
    //         new DateTime($datos['fecha_solicitud']),
    //         $datos['id_cliente'],
    //         $datos['id_pago'],
    //         $datos['id_contraentrega'],
    //         $datos['id_destinatario']
    //     );
    //     return $delivery->crear();
    // }

    public function crearDelivery($datos) {
        $delivery = new Delivery();
        $recojo = new Recojo();
        $entrega = new Entrega();
        $destinatario = new Destinatario();
        $pago = new Pago();
        $contraentrega = new Contraentrega();

        try {
            // Insertar datos en las tablas relacionadas
            $recojo->setDireccion($datos['direccion_recojo']);
            $recojo->setFecha($datos['fecha_recojo']);
            $recojo->setHora($datos['hora_recojo']);
            $id_recojo = $recojo->crear();

            $entrega->setDireccion($datos['direccion_entrega']);
            $entrega->setFecha($datos['fecha_entrega']);
            $entrega->setHora($datos['hora_entrega']);
            $id_entrega = $entrega->crear();

            $destinatario->setDni($datos['dni_destinatario']);
            $destinatario->setNombres($datos['nombres_destinatario']);
            $destinatario->setApellidos($datos['apellidos_destinatario']);
            $destinatario->setCelular($datos['celular_destinatario']);
            $id_destinatario = $destinatario->crear();

            $pago->setMonto($datos['monto_pago']);
            $pago->setEstado('Pendiente');
            $pago->setMetodo($datos['metodo_pago']);
            $id_pago = $pago->crear();

            $contraentrega->setCostoDelivery($datos['costo_delivery']);
            $contraentrega->setCostoPedido($datos['costo_pedido']);
            $id_contraentrega = $contraentrega->crear();

            // Insertar el delivery
            $delivery->setDescripcion($datos['descripcion']);
            $delivery->setCodSeguimiento($this->generarCodigoSeguimiento());
            $delivery->setFechaSolicitud(date('Y-m-d H:i:s'));
            $delivery->setIdCliente($datos['id_cliente']);
            $delivery->setIdRecojo($id_recojo);
            $delivery->setIdEntrega($id_entrega);
            $delivery->setIdDestinatario($id_destinatario);
            $delivery->setIdPago($id_pago);
            $delivery->setIdContraentrega($id_contraentrega);
            $delivery->crear();

            echo 'Registro completo';

        } catch (Exception $e) {
            // Revertir transacción en caso de error
            echo''. $e->getMessage() .'';
            throw $e;
        }
    }

    private function generarCodigoSeguimiento() {
        return uniqid();
    }

    public function actualizarDelivery($id, $datos)
    {
        $delivery = $this->obtenerDeliveryPorId($id);
        if (!$delivery) {
            return false;
        }

        $delivery->setDescripcion($datos['descripcion']);
        $delivery->setCodSeguimiento($datos['cod_seguimiento']);
        $delivery->setIdCliente($datos['id_cliente']);
        $delivery->setIdPago($datos['id_pago']);
        $delivery->setIdContraentrega($datos['id_contraentrega']);
        $delivery->setIdDestinatario($datos['id_destinatario']);

        return $delivery->actualizar();
    }

    public function eliminarDelivery($id)
    {
        return $this->delivery->eliminar($id);
    }

    
}