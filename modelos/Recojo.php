<?php

require_once "Conexion.php";

class Recojo
{
    private $id = null;
    private $id_repartidor;
    private $direccion;
    private $fecha;
    private $hora;
    private $estado;
    private $id_inconveniente;

    public function __construct($id_repartidor = null, $direccion = "", $fecha = null, $hora = null, $estado = "", $id_inconveniente = null)
    {
        $this->id_repartidor = $id_repartidor;
        $this->direccion = $direccion;
        $this->fecha = $fecha ? $fecha : date('Y-m-d');
        $this->hora = $hora;
        $this->estado = $estado;
        $this->id_inconveniente = $id_inconveniente;
    }

    public function obtenerTodos()
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Recojo";
        $resultado = $conexion->query($sql);
        $data = $resultado->fetchAll();
        $conn->cerrar();

        $recojos = [];
        foreach ($data as $item) {
            $recojo = new self(
                $item['id_repartidor'],
                $item['direccion'],
                $item['fecha'],
                $item['hora'],
                $item['estado'],
                $item['id_inconveniente']
            );
            $recojo->id = $item['id'];
            $recojos[] = $recojo;
        }

        return $recojos;
    }

    public function obtenerPorId($id)
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Recojo WHERE id = $id";
        $resultado = $conexion->query($sql);
        $data = $resultado->fetch();
        $conn->cerrar();

        if ($data) {
            $this->id_repartidor = $data['id_repartidor'];
            $this->direccion = $data['direccion'];
            $this->fecha = $data['fecha'];
            $this->hora = $data['hora'];
            $this->estado = $data['estado'];
            $this->id_inconveniente = $data['id_inconveniente'];
            $this->id = $data['id'];
            return $this;
        } else {
            return null;
        }   
    }

    public function crear()
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        // Construyendo la consulta SQL con valores escapados correctamente
        $sql = "INSERT INTO Recojo(id_repartidor, direccion, fecha, hora, estado, id_inconveniente) 
                VALUES (:id_repartidor, :direccion, :fecha, :hora, :estado, :id_inconveniente)";

        try {
            $sentencia = $conexion->prepare($sql);
            $sentencia->execute([
                ':id_repartidor' => $this->id_repartidor,
                ':direccion' => $this->direccion,
                ':fecha' => $this->fecha,
                ':hora' => $this->hora,
                ':estado' => $this->estado,
                ':id_inconveniente' => $this->id_inconveniente,
            ]);

            $id_insertado = $conexion->lastInsertId();
            $conn->cerrar();
            return $id_insertado;
            
        } catch (PDOException $e) {
            $mensaje_error = "Error al insertar recojo: " . $e->getMessage();
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
        $sql = "UPDATE Recojo SET 
                id_repartidor = $this->id_repartidor, 
                direccion = '$this->direccion', 
                fecha = '$this->fecha', 
                hora = '$this->hora', 
                estado = '$this->estado', 
                id_inconveniente = $this->id_inconveniente 
                WHERE id = $this->id";
        $resultado = $conexion->exec($sql);

        $conn->cerrar();

        return $resultado;
    }

    public function eliminar($id)
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "DELETE FROM Recojo WHERE id = $id";
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

    public function getIdInconveniente()
    {
        return $this->id_inconveniente;
    }

    public function setIdInconveniente($id_inconveniente)
    {
        $this->id_inconveniente = $id_inconveniente;
    }
}
?>
