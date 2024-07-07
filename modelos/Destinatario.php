<?php

require_once "Conexion.php";

class Destinatario
{
    private $id = null;
    private $dni;
    private $nombres;
    private $apellidos;
    private $celular;

    public function __construct($dni = "", $nombres = "", $apellidos = "", $celular = "")
    {
        $this->dni = $dni;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->celular = $celular;
    }

    public function obtenerTodos()
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Destinatario";
        $resultado = $conexion->query($sql);
        $data = $resultado->fetchAll();
        $conn->cerrar();

        $destinatarios = [];
        foreach ($data as $item) {
            $destinatario = new self(
                $item['dni'],
                $item['nombres'],
                $item['apellidos'],
                $item['celular']
            );
            $destinatario->id = $item['id'];
            $destinatarios[] = $destinatario;
        }

        return $destinatarios;
    }

    public function obtenerPorId($id)
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Destinatario WHERE id = $id";
        $resultado = $conexion->query($sql);
        $data = $resultado->fetch();
        $conn->cerrar();

        if ($data) {
            $this->id = $data['id'];
            $this->dni = $data['dni'];
            $this->nombres = $data['nombres'];
            $this->apellidos = $data['apellidos'];
            $this->celular = $data['celular'];
            return $this;
        } else {
            return null;
        }
    }

    public function crear()
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        
        $sql = "INSERT INTO Destinatario(dni, nombres, apellidos, celular) 
                VALUES ('$this->dni', 
                        '$this->nombres', 
                        '$this->apellidos', 
                        '$this->celular')";
        
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
            $mensaje_error = "Error al insertar destinatario: " . $e->getMessage();
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
        $sql = "UPDATE Destinatario SET 
                dni = '$this->dni', 
                nombres = '$this->nombres', 
                apellidos = '$this->apellidos', 
                celular = '$this->celular' 
                WHERE id = $this->id";
        $resultado = $conexion->exec($sql);

        $conn->cerrar();

        return $resultado;
    }

    public function eliminar($id)
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "DELETE FROM Destinatario WHERE id = $id";
        $resultado = $conexion->exec($sql);
        $conn->cerrar();

        return $resultado;
    }

    // Getters y setters

    public function getId()
    {
        return $this->id;
    }

    public function getDni()
    {
        return $this->dni;
    }

    public function setDni($dni)
    {
        $this->dni = $dni;
    }

    public function getNombres()
    {
        return $this->nombres;
    }

    public function setNombres($nombres)
    {
        $this->nombres = $nombres;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }

    public function getCelular()
    {
        return $this->celular;
    }

    public function setCelular($celular)
    {
        $this->celular = $celular;
    }
}

?>
