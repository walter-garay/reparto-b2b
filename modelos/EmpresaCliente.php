<?php

require_once "Conexion.php";
require_once "Usuario.php";

class EmpresaCliente extends Usuario
{
    private $direccion;
    private $razon_social;

    public function __construct($id = null, $direccion = null, $razon_social = null)
    {
        $this->id = $id;
        $this->direccion = $direccion;
        $this->razon_social = $razon_social;
    }

    public function crear()
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();

        $sql = "INSERT INTO EmpresaCliente (id, direccion, razon_social) 
                VALUES ({$this->id}, '{$this->direccion}', '{$this->razon_social}')";

        $resultado = $conexion->exec($sql);
        $conn->cerrar();

        return $resultado;
    }

    public function obtenerTodos()
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        
        $sql = "SELECT u.*, ec.direccion, ec.razon_social 
                FROM Usuario u 
                INNER JOIN EmpresaCliente ec ON u.id = ec.id 
                WHERE u.tipo = 'cliente'";
        
        $resultado = $conexion->query($sql);
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        $conn->cerrar();

        $clientes = [];
        foreach ($data as $row) {
            $cliente = new EmpresaCliente();
            $cliente->setId($row['id']);
            $cliente->setNombres($row['nombres']);
            $cliente->setApellidos($row['apellidos']);
            $cliente->setEmail($row['email']);
            $cliente->setCelular($row['celular']);
            $cliente->setDniRuc($row['dni_ruc']);
            $cliente->setDireccion($row['direccion']);
            $cliente->setRazonSocial($row['razon_social']);
            
            $clientes[] = $cliente;
        }

        return $clientes;
    }


    public function obtenerPorId($id)
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM EmpresaCliente WHERE id = $id";
        $resultado = $conexion->query($sql);
        $data = $resultado->fetch();
        $conn->cerrar();

        if ($data) {
            $this->id = $data['id'];
            $this->direccion = $data['direccion'];
            $this->razon_social = $data['razon_social'];
            parent::obtenerPorId($id);            
            return $this;
        } else {
            return null;
        }

    }

    public function actualizar()
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();

        $sql = "UPDATE EmpresaCliente SET 
                direccion = '{$this->direccion}', 
                razon_social = '{$this->razon_social}'
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
        
        // Primero eliminamos el registro de EmpresaCliente
        $sql = "DELETE FROM EmpresaCliente WHERE id = $id";
        $resultado = $conexion->exec($sql);
        
        $conn->cerrar();

        if ($resultado) {
            // Si se eliminó correctamente la EmpresaCliente, eliminamos el Usuario
            return parent::eliminar($id);
        }

        return false;
    }

    // Getters y setters

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    public function getRazonSocial()
    {
        return $this->razon_social;
    }

    public function setRazonSocial($razon_social)
    {
        $this->razon_social = $razon_social;
    }
}