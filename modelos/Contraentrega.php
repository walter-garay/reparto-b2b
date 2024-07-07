<?php

require_once "Conexion.php";

class Contraentrega
{
    private $id = null;
    private $costo_delivery;
    private $costo_pedido;

    public function __construct($costo_delivery = 0.0, $costo_pedido = 0.0)
    {
        $this->costo_delivery = $costo_delivery;
        $this->costo_pedido = $costo_pedido;
    }

    public function obtenerTodos()
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Contraentrega";
        $resultado = $conexion->query($sql);
        $data = $resultado->fetchAll();
        $conn->cerrar();

        $contraentregas = [];
        foreach ($data as $item) {
            $contraentrega = new self(
                $item['costo_delivery'],
                $item['costo_pedido']
            );
            $contraentrega->id = $item['id'];
            $contraentregas[] = $contraentrega;
        }

        return $contraentregas;
    }

    public function obtenerPorId($id)
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Contraentrega WHERE id = $id";
        $resultado = $conexion->query($sql);
        $data = $resultado->fetch();
        $conn->cerrar();

        if ($data) {
            $this->costo_delivery = $data['costo_delivery'];
            $this->costo_pedido = $data['costo_pedido'];
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
        
        $sql = "INSERT INTO Contraentrega(costo_delivery, costo_pedido) 
                VALUES ($this->costo_delivery, 
                        $this->costo_pedido)";
        
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
            $mensaje_error = "Error al insertar contraentrega: " . $e->getMessage();
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
        $sql = "UPDATE Contraentrega SET 
                costo_delivery = $this->costo_delivery, 
                costo_pedido = $this->costo_pedido 
                WHERE id = $this->id";
        $resultado = $conexion->exec($sql);

        $conn->cerrar();

        return $resultado;
    }

    public function eliminar($id)
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "DELETE FROM Contraentrega WHERE id = $id";
        $resultado = $conexion->exec($sql);
        $conn->cerrar();

        return $resultado;
    }

    // Getters y setters

    public function getId()
    {
        return $this->id;
    }

    public function getCostoDelivery()
    {
        return $this->costo_delivery;
    }

    public function setCostoDelivery($costo_delivery)
    {
        $this->costo_delivery = $costo_delivery;
    }

    public function getCostoPedido()
    {
        return $this->costo_pedido;
    }

    public function setCostoPedido($costo_pedido)
    {
        $this->costo_pedido = $costo_pedido;
    }
}
?>
