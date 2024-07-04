<?php

require_once "Usuario.php";
require_once "Conexion.php";


class Repartidor extends Usuario
{
    private $tipo_transporte;
    private $placa;

    public function __construct($id = null, $tipo_transporte = "", $placa = "")
    {
        $this->id = $id;
        $this->tipo_transporte = $tipo_transporte;
        $this->placa = $placa;
    }

    public function crear()
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();

        // Crear usuario
        $resultado = parent::crear();

        if ($resultado) {
            $sql = "INSERT INTO Repartidor (id, tipo_transporte, placa) 
            VALUES ({$this->id}, '{$this->tipo_transporte}', '{$this->placa}')";
            $filas_insertadas = $conexion->exec($sql);
            if ($filas_insertadas > 0) {
                $resultado = true;
            } else {
                $resultado = false;
            }
        } else {
            $resultado = false;
        }

        $conn->cerrar();
        return $resultado;
    }

    public function obtenerTodos()
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        
        $sql = "SELECT u.*, r.tipo_transporte, r.placa 
                FROM Usuario u 
                INNER JOIN Repartidor r ON u.id = r.id 
                WHERE u.tipo = 'repartidor'";
        
        $resultado = $conexion->query($sql);
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        $conn->cerrar();

        $repartidores = [];
        foreach ($data as $row) {
            $repartidor = new Repartidor();
            $repartidor->setId($row['id']);
            $repartidor->setNombres($row['nombres']);
            $repartidor->setApellidos($row['apellidos']);
            $repartidor->setEmail($row['email']);
            $repartidor->setCelular($row['celular']);
            $repartidor->setDniRuc($row['dni_ruc']);
            $repartidor->setTipoTransporte($row['tipo_transporte']);
            $repartidor->setPlaca($row['placa']);
            
            $repartidores[] = $repartidor;
        }

        return $repartidores;
    }

    public function obtenerPorId($id)
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        
        // Obtener los datos del usuario
        $sql = "SELECT * FROM Repartidor WHERE id = $id";
        
        $resultado = $conexion->query($sql);
        $data = $resultado->fetch();
        $conn->cerrar();

        if ($data) {
            $this->id = $data['id'];
            $this->tipo_transporte = $data['tipo_transporte'];
            $this->placa = $data['placa'];
            parent::obtenerPorId($id);

            return $this;
        }

        return null;
    }

    public function actualizar()
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();

        $sql = "UPDATE Repartidor SET 
                tipo_transporte = '{$this->tipo_transporte}', 
                placa = '{$this->placa}'
                WHERE id = {$this->id}";

        $resultado = $conexion->exec($sql);
        $conn->cerrar();

        // Actualizar los datos del usuario
        parent::actualizar();

        return $resultado;
    }

    public function eliminar($id)
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        
        // Primero eliminamos el registro de Repartidor
        $sql = "DELETE FROM Repartidor WHERE id = $id";
        $resultado = $conexion->exec($sql);
        
        $conn->cerrar();

        if ($resultado) {
            // Si se eliminó correctamente el Repartidor, eliminamos el Usuario
            return parent::eliminar($id);
        }

        return false;
    }






    

    // Getters y setters

    public function getTipoTransporte()
    {
        return $this->tipo_transporte;
    }

    public function setTipoTransporte($tipo_transporte)
    {
        $this->tipo_transporte = $tipo_transporte;
    }

    public function getPlaca()
    {
        return $this->placa;
    }

    public function setPlaca($placa)
    {
        $this->placa = $placa;
    }
}