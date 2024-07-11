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

    public function obtenerDeliverys()
    {
        return $this->delivery->obtenerTodos();
    }

    
    public function eliminarDelivery($id)
    {
        return $this->delivery->eliminar($id);
    }

    public function asignarRecojo($deliveryId, $repartidorId)
    {
        $delivery = $this->obtenerDeliveryPorId($deliveryId);
        $recojo = new Recojo();
        $recojo->asignarRecojo($delivery->getIdRecojo(), $repartidorId);
    }

    public function asignarEntrega($deliveryId, $repartidorId)
    {
        $delivery = $this->obtenerDeliveryPorId($deliveryId);
        $entrega = new Entrega();
        $entrega->asignarEntrega($delivery->getIdEntrega(), $repartidorId);
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

    public function eliminarDelivery($id) {}
    
    public function buscarDeliveryPorCodigo($codigo) {
        $delivery = $this->delivery->obtenerPorCodigo($codigo);
        if ($delivery) {
            return $this->obtenerDeliveryDetalladoPorId($delivery->getId());
        }
        return null;
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

    public function crearDelivery($descripcion, $cod_seguimiento, $fecha_solicitud, $id_cliente, $id_repartidor, $id_pago, $id_contraentrega, $id_destinatario) {
        $delivery = new Delivery($descripcion, $cod_seguimiento, $fecha_solicitud, $id_cliente, $id_repartidor, $id_pago, $id_contraentrega, $id_destinatario);
        $delivery->crear();
    }

    public function actualizarDelivery($id, $descripcion, $cod_seguimiento, $fecha_solicitud, $id_cliente, $id_repartidor, $id_pago, $id_contraentrega, $id_destinatario) {
        $delivery = new Delivery($descripcion, $cod_seguimiento, $fecha_solicitud, $id_cliente, $id_repartidor, $id_pago, $id_contraentrega, $id_destinatario);
        $delivery->actualizar($id);
    }

    public function eliminarDelivery($id) {}
    
    public function buscarDeliveryPorCodigo($codigo) {
        $delivery = $this->delivery->obtenerPorCodigo($codigo);
        if ($delivery) {
            return $this->obtenerDeliveryDetalladoPorId($delivery->getId());
        }
        return null;
    }
    public function crearDelivery($datos) {
        $delivery = new Delivery();
        $delivery->eliminar($id);
    }

    public function obtenerDeliveryPorId($id) {
        $delivery = new Delivery();
        $resultado = $delivery->obtenerPorId($id);

        // Aquí puedes procesar el resultado como desees (por ejemplo, mostrar en una vista)
        return $resultado;
    }
}

// Ejemplo de uso del controlador

$controller = new DeliveryControlador();

// Listar todos los deliveries
$resultados = $controller->listarDeliverys();

// Crear un nuevo delivery
$controller->crearDelivery("Descripción de ejemplo", "ABC123", "2024-06-28", 1, 2, 1, 0, 1);

// Actualizar un delivery existente
$controller->actualizarDelivery(1, "Nueva descripción", "XYZ789", "2024-06-29", 2, 3, 1, 0, 1);

// Eliminar un delivery por ID
$controller->eliminarDelivery(2);

// Obtener un delivery por ID
$delivery = $controller->obtenerDeliveryPorId(1);
