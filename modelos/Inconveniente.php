<?php

require_once "Conexion.php";

class Inconveniente {
    private $id;
    private $descripcion;
    private $foto_prueba;

    public function __construct($descripcion = "", $foto_prueba = "") {
        $this->descripcion = $descripcion;
        $this->foto_prueba = $foto_prueba;
    }

    public function obtenerTodoslosInconvenientes() {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Inconveniente";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function obtenerPorId($id) {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Inconveniente WHERE id = $id";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function crearInconveniente() {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "INSERT INTO Inconveniente(descripcion, foto_prueba) VALUES ('$this->descripcion', '$this->foto_prueba')";
        $result = $conexion->exec($sql);

        if ($result > 0) {
            echo "Inconveniente creado exitosamente";
        } else {
            echo "Ocurrió un error, vuelva a intentarlo";
        }
        $conn->cerrar();
    }

    public function actualizarInconveniente($id) {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "UPDATE Inconveniente SET descripcion = '$this->descripcion', foto_prueba = '$this->foto_prueba' WHERE id = $id";
        $result = $conexion->exec($sql);

        if ($result > 0) {
            echo "Inconveniente actualizado exitosamente";
        } else {
            echo "Ocurrió un error, vuelva a intentarlo";
        }
        $conn->cerrar();
    }

    public function eliminarInconveniente($id) {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "DELETE FROM Inconveniente WHERE id = $id";
        $result = $conexion->exec($sql);

        if ($result > 0) {
            echo "Inconveniente eliminado exitosamente";
        } else {
            echo "Ocurrió un error, vuelva a intentarlo";
        }
        $conn->cerrar();
    }
}
?>
