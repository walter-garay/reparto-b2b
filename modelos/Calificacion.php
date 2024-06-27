<?php

require_once "Conn.php";

class Calificacion{
    private $puntaje;
    private $comentario;

    public function __construct(){
   
    }

    public function guardar($puntaje,$comentario){
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "INSERT INTO calificacion (puntaje, comentario) VALUES ('$puntaje', '$comentario')";
        $resultado = $conexion->exec($sql);
        $conn->cerrar();
        return $resultado;

    }

    public function mostrar(){
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM calificacion";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function eliminar($id){
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "DELETE FROM calificacion WHERE id = '$id'";
        $resultado = $conexion->exec($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function buscar($id) {
        $conn = new Conn();
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
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "UPDATE calificacion SET puntaje = '$puntaje', comentario = '$comentario' WHERE id = '$id'";
        $resultado = $conexion->exec($sql);
        $conn->cerrar();
        return $resultado;
    }
    
}