<?php

require_once "Conexion.php";

class Calificacion{
    private $puntaje;
    private $comentario;

    public function __construct($puntaje, $comentario){
        $this->puntaje = $puntaje;
        $this->comentario = $comentario;
    }

    public function guardar($puntaje,$comentario){
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "INSERT INTO calificacion (puntaje, comentario) VALUES ('$puntaje', '$comentario')";
        $resultado = $conexion->exec($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function obtenerPorId($id)
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Calificacion WHERE id = $id";
        $resultado = $conexion->query($sql);
        $data = $resultado->fetch();
        $conn->cerrar();

        if ($data) {
            $this->puntaje = $data['puntaje'];
            $this->comentario = $data['comentario'];
            return $this;
        } else {
            return null;
        }
    }

    public function mostrar(){
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM calificacion";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function eliminar($id){
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "DELETE FROM calificacion WHERE id = '$id'";
        $resultado = $conexion->exec($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function buscar($id) {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM calificacion WHERE id = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $calificacion = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn->cerrar();
        return $calificacion;
    }

    public function editar($id,$puntaje,$comentario){
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "UPDATE calificacion SET puntaje = '$puntaje', comentario = '$comentario' WHERE id = '$id'";
        $resultado = $conexion->exec($sql);
        $conn->cerrar();
        return $resultado;
    }
    
}