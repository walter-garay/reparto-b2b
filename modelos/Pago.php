<?php

require_once "Conexion.php";

class Pago
{
    private $id = null;
    private $monto;
    private $estado;
    private $metodo;

    public function __construct($monto = 0.0, $estado = "", $metodo = "")
    {
        $this->monto = $monto;
        $this->estado = $estado;
        $this->metodo = $metodo;
    }

    public function obtenerTodos()
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Pago";
        $resultado = $conexion->query($sql);
        $data = $resultado->fetchAll();
        $conn->cerrar();

        $pagos = [];
        foreach ($data as $item) {
            $pago = new self(
                $item['monto'],
                $item['estado'],
                $item['metodo']
            );
            $pago->id = $item['id'];
            $pagos[] = $pago;
        }

        return $pagos;
    }

    public function obtenerPorId($id)
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Pago WHERE id = $id";
        $resultado = $conexion->query($sql);
        $data = $resultado->fetch();
        $conn->cerrar();

        if ($data) {
            $this->monto = $data['monto'];
            $this->estado = $data['estado'];
            $this->metodo = $data['metodo'];
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
        
        $sql = "INSERT INTO Pago(monto, estado, metodo) 
                VALUES ($this->monto, 
                        '$this->estado', 
                        '$this->metodo')";
        
        try {
            $resultado = $conexion->exec($sql);

            if ($resultado === 1) {  
                $id_insertado = $conexion->lastInsertId();
                $conn->cerrar();
                return $id_insertado;
            } else {
                $conn->cerrar();
                return null;  
            }
        } catch (PDOException $e) {
            $mensaje_error = "Error al insertar pago: " . $e->getMessage();
            error_log($mensaje_error);
            $conn->cerrar();
        }
    }


    public function actualizar()
    {
        if ($this->id === null) {
            return false;
        }

        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "UPDATE Pago SET 
                monto = $this->monto, 
                estado = '$this->estado', 
                metodo = '$this->metodo' 
                WHERE id = $this->id";
        $resultado = $conexion->exec($sql);

        $conn->cerrar();

        return $resultado;
    }

    public function eliminar($id)
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "DELETE FROM Pago WHERE id = $id";
        $resultado = $conexion->exec($sql);
        $conn->cerrar();

        return $resultado;
    }

    // Getters y setters

    public function getId()
    {
        return $this->id;
    }

    public function getMonto()
    {
        return $this->monto;
    }

    public function setMonto($monto)
    {
        $this->monto = $monto;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function getMetodo()
    {
        return $this->metodo;
    }

    public function setMetodo($metodo)
    {
        $this->metodo = $metodo;
    }
}
?>
