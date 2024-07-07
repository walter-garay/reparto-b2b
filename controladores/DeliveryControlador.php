<?php

require_once "../../modelos/Delivery.php";
require_once "../../modelos/Recojo.php";
require_once "../../modelos/Entrega.php";
require_once "../../modelos/Destinatario.php";
require_once "../../modelos/Pago.php";
require_once "../../modelos/Contraentrega.php";
require_once "../../modelos/EmpresaCliente.php";


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

    public function obtenerDeliverysDetallados()
    {
        $deliverys = $this->delivery->obtenerTodos();
        $deliverysDetallados = [];

        foreach ($deliverys as $delivery) {
            $empresaCliente = new EmpresaCliente();
            $empresaCliente->obtenerPorId($delivery->getIdCliente());

            $recojo = new Recojo();
            $recojo->obtenerPorId($delivery->getIdRecojo());

            $entrega = new Entrega();
            $entrega->obtenerPorId($delivery->getIdEntrega());

            $pago = new Pago();
            $pago->obtenerPorId($delivery->getIdPago());

            $contraentrega = new Contraentrega();
            $contraentrega->obtenerPorId($delivery->getIdContraentrega());

            $destinatario = new Destinatario();
            $destinatario->obtenerPorId($delivery->getIdDestinatario());

            $deliveryDetallado = [
                'delivery' => $delivery,
                'cliente' => $empresaCliente,
                'recojo' => $recojo,
                'entrega' => $entrega,
                'pago' => $pago,
                'contraentrega' => $contraentrega,
                'destinatario' => $destinatario
            ];

            $deliverysDetallados[] = $deliveryDetallado;
        }

        return $deliverysDetallados;
    }


    public function obtenerDeliveryPorId($id)
    {
        return $this->delivery->obtenerPorId($id);
    }

    public function obtenerDeliveryDetalladoPorId($id) {
        $delivery = new Delivery();
        $delivery = $delivery->obtenerPorId($id);
        
        if (!$delivery) {
            return null;
        }

        $empresaCliente = new EmpresaCliente();
        $empresaCliente->obtenerPorId($delivery->getIdCliente());

        $recojo = new Recojo();
        $recojo->obtenerPorId($delivery->getIdRecojo());

        $entrega = new Entrega();
        $entrega->obtenerPorId($delivery->getIdEntrega());

        $pago = new Pago();
        $pago->obtenerPorId($delivery->getIdPago());

        $contraentrega = new Contraentrega();
        $contraentrega->obtenerPorId($delivery->getIdContraentrega());

        $destinatario = new Destinatario();
        $destinatario->obtenerPorId($delivery->getIdDestinatario());

        $deliveryDetallado = [
            'delivery' => $delivery,
            'cliente' => $empresaCliente,
            'recojo' => $recojo,
            'entrega' => $entrega,
            'pago' => $pago,
            'contraentrega' => $contraentrega,
            'destinatario' => $destinatario
        ];

        return $deliveryDetallado;
    }

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

    public function actualizarDelivery($id, $deliveryDetalles)
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();

        try {
            $conexion->beginTransaction();

            // Actualizar Delivery
            $delivery = new Delivery();
            $delivery->obtenerPorId($id);
            $delivery->setDescripcion($deliveryDetalles['delivery']['descripcion']);
            $delivery->setCodSeguimiento($deliveryDetalles['delivery']['cod_seguimiento']);
            $delivery->setIdCliente($deliveryDetalles['delivery']['id_cliente']);
            $delivery->setIdRecojo($deliveryDetalles['delivery']['id_recojo']);
            $delivery->setIdEntrega($deliveryDetalles['delivery']['id_entrega']);
            $delivery->setIdPago($deliveryDetalles['delivery']['id_pago']);
            $delivery->setIdContraentrega($deliveryDetalles['delivery']['id_contraentrega']);
            $delivery->setIdDestinatario($deliveryDetalles['delivery']['id_destinatario']);
            $delivery->actualizar();

            // Actualizar EmpresaCliente
            $cliente = new EmpresaCliente();
            $cliente->obtenerPorId($delivery->getIdCliente());
            $cliente->setRazonSocial($deliveryDetalles['cliente']['razon_social']);
            $cliente->setDireccion($deliveryDetalles['cliente']['direccion']);
            $cliente->actualizar();

            // Actualizar Recojo
            $recojo = new Recojo();
            $recojo->obtenerPorId($delivery->getIdRecojo());
            $recojo->setDireccion($deliveryDetalles['recojo']['direccion']);
            $recojo->setFecha($deliveryDetalles['recojo']['fecha']);
            $recojo->setHora($deliveryDetalles['recojo']['hora']);
            $recojo->setEstado("Pendiente");
            $recojo->actualizar();

            // Actualizar Entrega
            $entrega = new Entrega();
            $entrega->obtenerPorId($delivery->getIdEntrega());
            $entrega->setDireccion($deliveryDetalles['entrega']['direccion']);
            $entrega->setFecha($deliveryDetalles['entrega']['fecha']);
            $entrega->setHora($deliveryDetalles['entrega']['hora']);
            $entrega->setEstado("Pendiente");
            $entrega->actualizar();

            // Actualizar Pago
            $pago = new Pago();
            $pago->obtenerPorId($delivery->getIdPago());
            $pago->setMonto($deliveryDetalles['pago']['monto']);
            $pago->setEstado($deliveryDetalles['pago']['estado']);
            $pago->setMetodo($deliveryDetalles['pago']['metodo']);
            $pago->actualizar();

            // Actualizar Contraentrega
            $contraentrega = new Contraentrega();
            $contraentrega->obtenerPorId($delivery->getIdContraentrega());
            $contraentrega->setCostoDelivery($deliveryDetalles['contraentrega']['costo_delivery']);
            $contraentrega->setCostoPedido($deliveryDetalles['contraentrega']['costo_pedido']);
            $contraentrega->actualizar();

            // Actualizar Destinatario
            $destinatario = new Destinatario();
            $destinatario->obtenerPorId($delivery->getIdDestinatario());
            $destinatario->setDni($deliveryDetalles['destinatario']['dni']);
            $destinatario->setNombres($deliveryDetalles['destinatario']['nombres']);
            $destinatario->setApellidos($deliveryDetalles['destinatario']['apellidos']);
            $destinatario->setCelular($deliveryDetalles['destinatario']['celular']);
            $destinatario->actualizar();

            $conexion->commit();
        } catch (Exception $e) {
            $conexion->rollBack();
            throw $e;
        }

        $conn->cerrar();

        return true;
    }

    public function eliminarDelivery($id)
    {
        return $this->delivery->eliminar($id);
    }

    
}