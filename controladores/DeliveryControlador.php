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

    public function obtenerDeliverysDetallados()
    {
        return $this->delivery->obtenerTodos();
    }

    public function obtenerDeliveryPorId($id)
    {
        return $this->delivery->obtenerPorId($id);
    }

    
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

    public function obtenerDeliverysDetalladosPorCliente($id_cliente)
    {
        $deliverys = $this->delivery->obtenerTodos();
        $deliverysDetallados = [];

        foreach ($deliverys as $delivery) {
            if ($delivery->getIdCliente() == $id_cliente) {
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
        }

        return $deliverysDetallados;
    }
    
    // Función para validar y ajustar los costos de contraentrega
    private function validarTipoContraentrega($tipoContraentrega, $costoPedido, $costoDelivery) {
        switch ($tipoContraentrega) {
            case 'no_cobrar':
                $costoPedido = 0;
                $costoDelivery = 0;
                break;
            case 'solo_pedido':
                $costoDelivery = 0;
                break;
            case 'solo_delivery':
                $costoPedido = 0;
                break;
            case 'cobrar_ambos':
                break;
            default:
                $costoPedido = 0;
                $costoDelivery = 0;
                break;
        }
        return [
            'costo_pedido' => $costoPedido,
            'costo_delivery' => $costoDelivery
        ];
    }

    function validarDatos($datos) {
        foreach ($datos as $key => $value) {
            if (is_null($value) || $value === '') {
                $datos[$key] = 'NULL';
            } elseif (is_string($value)) {
                $datos[$key] = "'$value'";
            }
        }
        return $datos;
    }

    public function crearDelivery($datos) 
    {
        try {
            // Formatear los valores de los datos
            $datos = $this->validarDatos($datos);

            // Crear objetos para las entidades relacionadas
            $recojo = new Recojo();
            $entrega = new Entrega();
            $destinatario = new Destinatario();
            $pago = new Pago();
            $contraentrega = new Contraentrega();

            // Configurar recojo
            $recojo->setDireccion($datos['direccion_recojo']);
            $recojo->setFecha($datos['fecha_recojo']);
            $recojo->setHora($datos['hora_recojo']);
            $recojo->setEstado("Sin repartidor");
            $id_recojo = $recojo->crear();

            // Configurar entrega
            $entrega->setDireccion($datos['direccion_entrega']);
            $entrega->setFecha($datos['fecha_entrega']);
            $entrega->setHora($datos['hora_entrega']);
            $entrega->setEstado("Sin repartidor");
            $id_entrega = $entrega->crear();

            // Configurar destinatario
            $destinatario->setDni($datos['dni_destinatario']);
            $destinatario->setNombres($datos['nombres_destinatario']);
            $destinatario->setApellidos($datos['apellidos_destinatario']);
            $destinatario->setCelular($datos['celular_destinatario']);
            $id_destinatario = $destinatario->crear();

            // Configurar pago
            $pago->setMonto($datos['monto_pago']);
            $pago->setEstado('Pendiente');
            $pago->setMetodo($datos['metodo_pago']);
            $id_pago = $pago->crear();

            // Validar y ajustar costos de contraentrega
            $costosContraentrega = $this->validarTipoContraentrega($datos['tipo_contraentrega'], $datos['costo_pedido'], $datos['costo_delivery']);

            // Configurar contraentrega
            $contraentrega->setCostoDelivery($costosContraentrega['costo_delivery']);
            $contraentrega->setCostoPedido($costosContraentrega['costo_pedido']);
            $id_contraentrega = $contraentrega->crear();

            // Configurar delivery
            $delivery = new Delivery();
            $delivery->setDescripcion($datos['descripcion']);
            $delivery->setCodSeguimiento(uniqid());
            $delivery->setFechaSolicitud(date('Y-m-d H:i:s'));
            $delivery->setIdCliente($datos['id_cliente']);
            $delivery->setIdRecojo($id_recojo);
            $delivery->setIdEntrega($id_entrega);
            $delivery->setIdDestinatario($id_destinatario);
            $delivery->setIdPago($id_pago);
            $delivery->setIdContraentrega($id_contraentrega);
            $delivery->crear();
            return true;

        } catch (Exception $e) {
            echo $e->getMessage();
            throw $e;
        } 
    }

    public function actualizarDelivery($id, $deliveryDetalles)
    {
        try {
            // Actualizar objetos para las entidades relacionadas
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

            // Validar y ajustar costos de contraentrega
            $costosContraentrega = $this->validarTipoContraentrega($deliveryDetalles['delivery']['id_contraentrega'], $deliveryDetalles['contraentrega']['costo_pedido'], $deliveryDetalles['contraentrega']['costo_delivery']);

            // Actualizar Contraentrega
            $contraentrega = new Contraentrega();
            $contraentrega->obtenerPorId($deliveryDetalles['delivery']['id_contraentrega']);
            $contraentrega->setCostoDelivery($costosContraentrega['costo_delivery']);
            $contraentrega->setCostoPedido($costosContraentrega['costo_pedido']);
            $contraentrega->actualizar();
            return true;

        } catch (Exception $e) {
            throw $e;
        } 
    }

    public function eliminarDelivery($id)
    {
        return $this->delivery->eliminar($id);
    }

    
    
}