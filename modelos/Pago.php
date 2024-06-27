<?php
require_once "Conexion.php";

class Pago
{
    private $monto;
    private $estado;
    private $metodo;

    public function __construct() {
    }

    public function guardar($monto, $estado, $metodo) {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "INSERT INTO pago (monto, estado, metodo) VALUES ('$monto', '$estado', '$metodo')";
        $resultado = $conexion->exec($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function mostrar() {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM pago";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function eliminar($id) {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "DELETE FROM pago WHERE id = '$id'";
        $resultado = $conexion->exec($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function buscar($id) {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM pago WHERE id = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $pago = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn->cerrar();
        return $pago;
    }

    public function editar($id, $monto, $estado, $metodo) {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "UPDATE pago SET monto = '$monto', estado = '$estado', metodo = '$metodo' WHERE id = '$id'";
        $resultado = $conexion->exec($sql);
        $conn->cerrar();
        return $resultado;
    }
}
?>
