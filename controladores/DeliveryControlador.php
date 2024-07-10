<?php

require_once "../modelos/Delivery.php"; // Incluir la clase Delivery y la clase Conexion si es necesario

class DeliveryControlador {

    public function listarDeliverys() {
        $delivery = new Delivery();
        $resultados = $delivery->obtenerTodos();

        // Aquí puedes procesar los resultados como desees (por ejemplo, mostrar en una vista)
        return $resultados;
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
