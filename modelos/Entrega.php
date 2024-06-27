<?php

require_once "Conexion.php";

class Entrega {
    private $id;
    private $id_delivery;
    private $id_repartidor;
    private $direccion;
    private $fecha;
    private $hora;
    private $estado;
    private $foto_entrega;
    private $id_inconveniente;
    private $id_calificacion;

    public function __construct($id_delivery = 0, $id_repartidor = 0, $direccion = "", $fecha = "", $hora = "", $estado = "", $foto_entrega = null, $id_inconveniente = 0, $id_calificacion = 0) {
        $this->id_delivery = $id_delivery;
        $this->id_repartidor = $id_repartidor;
        $this->direccion = $direccion;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->estado = $estado;
        $this->foto_entrega = $foto_entrega;
        $this->id_inconveniente = $id_inconveniente;
        $this->id_calificacion = $id_calificacion;
    }

    public function obtenerTodos() {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Entrega";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }
    
    public function obtenerPorId($id) {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Entrega WHERE id = $id";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function crear() {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "INSERT INTO Entrega(id_delivery, id_repartidor, direccion, fecha, hora, estado, foto_entrega, id_inconveniente, id_calificacion) VALUES ('$this->id_delivery', '$this->id_repartidor', '$this->direccion', '$this->fecha', '$this->hora', '$this->estado', '$this->foto_entrega', '$this->id_inconveniente', '$this->id_calificacion')";
        $result = $conexion->exec($sql);

        if($result > 0) {
            echo "Entrega creada exitosamente";
        } else {
            echo "Ocurrió un error, vuelva a intentarlo";
        }
        $conn->cerrar();
    }

    public function actualizar($id) {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "UPDATE Entrega SET id_delivery = '$this->id_delivery', id_repartidor = '$this->id_repartidor', direccion = '$this->direccion', fecha = '$this->fecha', hora = '$this->hora', estado = '$this->estado', foto_entrega = '$this->foto_entrega', id_inconveniente = '$this->id_inconveniente', id_calificacion = '$this->id_calificacion' WHERE id = $id";
        $result = $conexion->exec($sql);

        if($result > 0) {
            echo "Entrega actualizada exitosamente";
        } else {
            echo "Ocurrió un error, vuelva a intentarlo";
        }
        $conn->cerrar();
    }

    public function eliminar($id) {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "DELETE FROM Entrega WHERE id = $id";
        $result = $conexion->exec($sql);

        if($result > 0) {
            echo "Entrega eliminada exitosamente";
        } else {
            echo "Ocurrió un error, vuelva a intentarlo";
        }
        $conn->cerrar();
    }
}
?>
