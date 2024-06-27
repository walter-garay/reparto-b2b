<?php

require_once "Conexion.php";
require_once "Usuario.php";

class Repartidor extends Usuario {
    private $tipo_transporte;
    private $placa;

    public function __construct($nombres = "", $apellidos = "", $email = "", $password = "", $celular = "", $tipo = "", $dni_ruc = "", $tipo_transporte = "", $placa = "") {
        parent::__construct($nombres, $apellidos, $email, $password, $celular, $tipo, $dni_ruc);
        $this->tipo_transporte = $tipo_transporte;
        $this->placa = $placa;
    }

    public function obtenerTodos() {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT Usuario.*, Repartidor.tipo_transporte, Repartidor.placa 
                FROM Usuario 
                JOIN Repartidor ON Usuario.id = Repartidor.id 
                WHERE Usuario.tipo = 'repartidor'";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }
    

    public function obtenerPorId($id) {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT Usuario.*, Repartidor.tipo_transporte, Repartidor.placa 
                FROM Usuario 
                JOIN Repartidor ON Usuario.id = Repartidor.id 
                WHERE Usuario.id = $id";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function crear() {
        $conn = new Conexion();
        $conexion = $conn->conectar();

        // Crear Usuario primero
        parent::crear();

        // Obtener el id del último usuario insertado
        $lastInsertId = $conexion->lastInsertId();

        // Crear Repartidor
        $sql = "INSERT INTO Repartidor(id, tipo_transporte, placa) VALUES ('$lastInsertId', '$this->tipo_transporte', '$this->placa')";
        $result = $conexion->exec($sql);

        if($result > 0) {
            echo "Repartidor creado exitosamente";
        } else {
            echo "Ocurrió un error, vuelva a intentarlo";
        }
        $conn->cerrar();
    }

    public function actualizar($id) {
        $conn = new Conexion();
        $conexion = $conn->conectar();

        // Actualizar Usuario
        parent::actualizar($id);

        // Actualizar Repartidor
        $sql = "UPDATE Repartidor SET tipo_transporte = '$this->tipo_transporte', placa = '$this->placa' WHERE id = $id";
        $result = $conexion->exec($sql);

        if($result > 0) {
            echo "Repartidor actualizado exitosamente";
        } else {
            echo "Ocurrió un error, vuelva a intentarlo";
        }
        $conn->cerrar();
    }

    public function eliminar($id) {
        $conn = new Conexion();
        $conexion = $conn->conectar();

        // Eliminar Repartidor
        $sql = "DELETE FROM Repartidor WHERE id = $id";
        $result = $conexion->exec($sql);

        if($result > 0) {
            // Eliminar Usuario
            parent::eliminar($id);
        } else {
            echo "Ocurrió un error, vuelva a intentarlo";
        }
        $conn->cerrar();
    }
}
?>
