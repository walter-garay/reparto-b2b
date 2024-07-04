<?php

require_once "Conexion.php";
require_once "Usuario.php";

class Administrador extends Usuario
{
    private $cod_admin;

    public function __construct($id = null, $cod_admin = "")
    {
        $this->id = $id;
        $this->cod_admin = $cod_admin;
    }

    public function crear()
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();

        $sql = "INSERT INTO Administrador (id, cod_admin) 
                VALUES ({$this->id}, '{$this->cod_admin}')";

        $resultado = $conexion->exec($sql);
        $conn->cerrar();

        return $resultado;
    }

    public function obtenerPorId($id)
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Administrador WHERE id = $id";
        $resultado = $conexion->query($sql);
        $data = $resultado->fetch();
        $conn->cerrar();

        if ($data) {
            $this->id = $data['id'];
            $this->cod_admin = $data['cod_admin'];
            
            // Obtener los datos del usuario
            parent::obtenerPorId($id);
            
            return $this;
        }

        return null;
    }

    public function actualizar()
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();

        $sql = "UPDATE Administrador SET 
                cod_admin = '{$this->cod_admin}'
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
        
        // Primero eliminamos el registro de Administrador
        $sql = "DELETE FROM Administrador WHERE id = $id";
        $resultado = $conexion->exec($sql);
        
        $conn->cerrar();

        if ($resultado) {
            // Si se eliminó correctamente el Administrador, eliminamos el Usuario
            return parent::eliminar($id);
        }

        return false;
    }

    // Getter y setter

    public function getCodAdmin()
    {
        return $this->cod_admin;
    }

    public function setCodAdmin($cod_admin)
    {
        $this->cod_admin = $cod_admin;
    }
}