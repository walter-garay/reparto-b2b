<?php

require_once "Conexion.php";

class Contraentrega {
    private $id;
    private $costo_delivery;
    private $costo_pedido;

    public function __construct($costo_delivery = 0.00, $costo_pedido = 0.00) {
        $this->costo_delivery = $costo_delivery;
        $this->costo_pedido = $costo_pedido;
    }

    public function obtenerTodos() {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Contraentrega";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function obtenerPorId($id) {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Contraentrega WHERE id = $id";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function crear() {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "INSERT INTO Contraentrega(costo_delivery, costo_pedido) VALUES ('$this->costo_delivery', '$this->costo_pedido')";
        $result = $conexion->exec($sql);

        if ($result > 0) {
            echo "Contraentrega creada exitosamente";
        } else {
            echo "Ocurrió un error, vuelva a intentarlo";
        }
        $conn->cerrar();
    }

    public function actualizar($id) {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "UPDATE Contraentrega SET costo_delivery = '$this->costo_delivery', costo_pedido = '$this->costo_pedido' WHERE id = $id";
        $result = $conexion->exec($sql);

        if ($result > 0) {
            echo "Contraentrega actualizada exitosamente";
        } else {
            echo "Ocurrió un error, vuelva a intentarlo";
        }
        $conn->cerrar();
    }

    public function eliminar($id) {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "DELETE FROM Contraentrega WHERE id = $id";
        $result = $conexion->exec($sql);

        if ($result > 0) {
            echo "Contraentrega eliminada exitosamente";
        } else {
            echo "Ocurrió un error, vuelva a intentarlo";
        }
        $conn->cerrar();
    }
}
?>
