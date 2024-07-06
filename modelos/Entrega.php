<?php

require_once "Conexion.php";

class Entrega
{
    private $id = null;
    private $id_repartidor;
    private $direccion;
    private $fecha;
    private $hora;
    private $estado;
    private $foto_entrega;
    private $id_inconveniente;
    private $id_calificacion;

    public function __construct($id_repartidor = null, $direccion = "", $fecha = null, $hora = null, $estado = "", $foto_entrega = null, $id_inconveniente = null, $id_calificacion = null)
    {
        $this->id_repartidor = $id_repartidor;
        $this->direccion = $direccion;
        $this->fecha = $fecha ? $fecha : date('Y-m-d');
        $this->hora = $hora;
        $this->estado = $estado;
        $this->foto_entrega = $foto_entrega;
        $this->id_inconveniente = $id_inconveniente;
        $this->id_calificacion = $id_calificacion;
    }

    public function obtenerTodos()
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Entrega";
        $resultado = $conexion->query($sql);
        $data = $resultado->fetchAll();
        $conn->cerrar();

        $entregas = [];
        foreach ($data as $item) {
            $entrega = new self(
                $item['id_repartidor'],
                $item['direccion'],
                $item['fecha'],
                $item['hora'],
                $item['estado'],
                $item['foto_entrega'],
                $item['id_inconveniente'],
                $item['id_calificacion']
            );
            $entrega->id = $item['id'];
            $entregas[] = $entrega;
        }

        return $entregas;
    }

    public function obtenerPorId($id)
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Entrega WHERE id = $id";
        $resultado = $conexion->query($sql);
        $data = $resultado->fetch();
        $conn->cerrar();

        if (!$resultado) {
            return null;
        }

        $entrega = new self(
            $data['id_repartidor'],
            $data['direccion'],
            $data['fecha'],
            $data['hora'],
            $data['estado'],
            $data['foto_entrega'],
            $data['id_inconveniente'],
            $data['id_calificacion']
        );
        $entrega->id = $data['id'];

        return $entrega;
    }

    public function crear()
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        
        $sql = "INSERT INTO Entrega(id_repartidor, direccion, fecha, hora, estado, foto_entrega, id_inconveniente, id_calificacion) 
                VALUES (:id_repartidor, :direccion, :fecha, :hora, :estado, :foto_entrega, :id_inconveniente, :id_calificacion)";
        
        try {
            $sentencia = $conexion->prepare($sql);
            $sentencia->execute([
                ':id_repartidor' => $this->id_repartidor,
                ':direccion' => $this->direccion,
                ':fecha' => $this->fecha,
                ':hora' => $this->hora,
                ':estado' => $this->estado,
                ':foto_entrega' => $this->foto_entrega,
                ':id_inconveniente' => $this->id_inconveniente,
                ':id_calificacion' => $this->id_calificacion
            ]);

            $id_insertado = $conexion->lastInsertId();
            $conn->cerrar();
            return $id_insertado;

        } catch (PDOException $e) {
            $mensaje_error = "Error al insertar entrega: " . $e->getMessage();
            echo "<script>console.log('Se creó el id_contraentrega $mensaje_error');</script>";
            $conn->cerrar();
            return null;
        }
    }


    public function actualizar()
    {
        if ($this->id === null) {
            return false;
        }

        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "UPDATE Entrega SET 
                id_repartidor = $this->id_repartidor, 
                direccion = '$this->direccion', 
                fecha = '$this->fecha', 
                hora = '$this->hora', 
                estado = '$this->estado', 
                foto_entrega = '$this->foto_entrega', 
                id_inconveniente = $this->id_inconveniente, 
                id_calificacion = $this->id_calificacion 
                WHERE id = $this->id";
        $resultado = $conexion->exec($sql);

        $conn->cerrar();

        return $resultado;
    }

    public function eliminar($id)
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "DELETE FROM Entrega WHERE id = $id";
        $resultado = $conexion->exec($sql);
        $conn->cerrar();

        return $resultado;
    }

    // Getters y setters

    public function getId()
    {
        return $this->id;
    }

    public function getIdRepartidor()
    {
        return $this->id_repartidor;
    }

    public function setIdRepartidor($id_repartidor)
    {
        $this->id_repartidor = $id_repartidor;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function getHora()
    {
        return $this->hora;
    }

    public function setHora($hora)
    {
        $this->hora = $hora;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function getFotoEntrega()
    {
        return $this->foto_entrega;
    }

    public function setFotoEntrega($foto_entrega)
    {
        $this->foto_entrega = $foto_entrega;
    }

    public function getIdInconveniente()
    {
        return $this->id_inconveniente;
    }

    public function setIdInconveniente($id_inconveniente)
    {
        $this->id_inconveniente = $id_inconveniente;
    }

    public function getIdCalificacion()
    {
        return $this->id_calificacion;
    }

    public function setIdCalificacion($id_calificacion)
    {
        $this->id_calificacion = $id_calificacion;
    }
}
?>
