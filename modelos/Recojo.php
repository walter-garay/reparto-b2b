<?php

require_once "Conexion.php";

class Recojo {
    private $id;
    private $id_delivery;
    private $id_repartidor;
    private $direccion;
    private $fecha;
    private $hora;
    private $estado;
    private $id_inconveniente;

    public function __construct($id_delivery = 0, $id_repartidor = 0, $direccion = "", $fecha = "", $hora = "", $estado = "", $id_inconveniente = 0) {
        $this->id_delivery = $id_delivery;
        $this->id_repartidor = $id_repartidor;
        $this->direccion = $direccion;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->estado = $estado;
        $this->id_inconveniente = $id_inconveniente;
    }

    public function obtenerTodos() {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Recojo";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function obtenerPorId($id) {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Recojo WHERE id = $id";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function crear() {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "INSERT INTO Recojo(id_delivery, id_repartidor, direccion, fecha, hora, estado, id_inconveniente) VALUES ('$this->id_delivery', '$this->id_repartidor', '$this->direccion', '$this->fecha', '$this->hora', '$this->estado', '$this->id_inconveniente')";
        $result = $conexion->exec($sql);

        if($result > 0) {
            echo "Recojo creado exitosamente";
        } else {
            echo "Ocurrió un error, vuelva a intentarlo";
        }
        $conn->cerrar();
    }

    public function actualizar($id) {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "UPDATE Recojo SET id_delivery = '$this->id_delivery', id_repartidor = '$this->id_repartidor', direccion = '$this->direccion', fecha = '$this->fecha', hora = '$this->hora', estado = '$this->estado', id_inconveniente = '$this->id_inconveniente' WHERE id = $id";
        $result = $conexion->exec($sql);

        if($result > 0) {
            echo "Recojo actualizado exitosamente";
        } else {
            echo "Ocurrió un error, vuelva a intentarlo";
        }
        $conn->cerrar();
    }

    public function eliminar($id) {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "DELETE FROM Recojo WHERE id = $id";
        $result = $conexion->exec($sql);

        if($result > 0) {
            echo "Recojo eliminado exitosamente";
        } else {
            echo "Ocurrió un error, vuelva a intentarlo";
        }
        $conn->cerrar();
    }
}
?>
