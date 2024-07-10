<?php

require_once "Conexion.php";

class Calificacion
{
    private $id;
    private $puntaje;
    private $comentario;

    public function __construct($puntaje = 0, $comentario = "")
    {
        $this->puntaje = $puntaje;
        $this->comentario = $comentario;
    }

    public function crear()
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "INSERT INTO Calificacion (puntaje, comentario) VALUES ('$this->puntaje', '$this->comentario')";
        $resultado = $conexion->exec($sql);
        if ($resultado) {
            $this->id = $conexion->lastInsertId();
        }
        $conn->cerrar();
        return $resultado;
    }

    public function obtenerPorId($id)
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Calificacion WHERE id = $id";
        $resultado = $conexion->query($sql);
        $data = $resultado->fetch(PDO::FETCH_ASSOC);
        $conn->cerrar();

        if ($data) {
            $this->id = $data['id'];
            $this->puntaje = $data['puntaje'];
            $this->comentario = $data['comentario'];
            return $this;
        } else {
            return null;
        }
    }

    public function obtenerTodos()
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Calificacion";
        $resultado = $conexion->query($sql);
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        $conn->cerrar();

        $calificaciones = [];
        foreach ($data as $row) {
            $calificacion = new self($row['puntaje'], $row['comentario']);
            $calificacion->id = $row['id'];
            $calificaciones[] = $calificacion;
        }

        return $calificaciones;
    }

    public function eliminar($id)
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "DELETE FROM Calificacion WHERE id = $id";
        $resultado = $conexion->exec($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function editar($id, $puntaje, $comentario)
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "UPDATE Calificacion SET puntaje = '$puntaje', comentario = '$comentario' WHERE id = $id";
        $resultado = $conexion->exec($sql);
        $conn->cerrar();
        return $resultado;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getPuntaje()
    {
        return $this->puntaje;
    }

    public function getComentario()
    {
        return $this->comentario;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setPuntaje($puntaje)
    {
        $this->puntaje = $puntaje;
    }

    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
    }
}
