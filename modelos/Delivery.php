<?php

require_once "Conn.php";
require_once "Destinatario.php";

class Delivery  {
    protected $id;
    private $descripcion;
    private $cod_seguimiento;
    private $fecha_solicitud;
    private $id_cliente;
    private $id_repartidor;
    private $id_pago;
    private $id_contraentrega;
    private $id_destinatario;

    public function __construct($descripcion = "", $cod_seguimiento = "", $fecha_solicitud = "", $id_cliente = 0, $id_repartidor = 0, $id_pago = 0, $id_contraentrega = 0, $nombres = "", $apellidos = "", $email = "", $numero = "") {
       $this->descripcion = $descripcion;
        $this->cod_seguimiento = $cod_seguimiento;
        $this->fecha_solicitud = $fecha_solicitud;
        $this->id_cliente = $id_cliente;
        $this->id_repartidor = $id_repartidor;
        $this->id_pago = $id_pago;
        $this->id_contraentrega = $id_contraentrega;
    }

    public function obtenerTodos() {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Delivery";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }
    
    public function obtenerPorId($id) {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Delivery WHERE id = $id";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function crear() {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "INSERT INTO Delivery(descripcion, cod_seguimiento, fecha_solicitud, id_cliente, id_repartidor, id_pago, id_contraentrega, id_destinatario) VALUES ('$this->descripcion', '$this->cod_seguimiento', '$this->fecha_solicitud', '$this->id_cliente', '$this->id_repartidor', '$this->id_pago', '$this->id_contraentrega', '$this->id_destinatario')";
        $result = $conexion->exec($sql);

        if($result > 0) {
            echo "Delivery creado exitosamente";
        } else {
            echo "Ocurrió un error, vuelva a intentarlo";
        }
        $conn->cerrar();
    }

    public function actualizar($id) {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "UPDATE Delivery SET descripcion = '$this->descripcion', cod_seguimiento = '$this->cod_seguimiento', fecha_solicitud = '$this->fecha_solicitud', id_cliente = $this->id_cliente, id_repartidor = $this->id_repartidor, id_pago = $this->id_pago, id_contraentrega = $this->id_contraentrega, id_destinatario = $this->id_destinatario WHERE id = $id";
        $result = $conexion->exec($sql);

        if($result > 0) {
            echo "Delivery actualizado exitosamente";
        } else {
            echo "Ocurrió un error, vuelva a intentarlo";
        }
        $conn->cerrar();
    }

    public function eliminar($id) {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "DELETE FROM Delivery WHERE id = $id";
        $result = $conexion->exec($sql);

        if($result > 0) {
            echo "Delivery eliminado exitosamente";
        } else {
            echo "Ocurrió un error, vuelva a intentarlo";
        }
        $conn->cerrar();
    }
}
