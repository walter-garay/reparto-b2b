<?php

require_once "Conexion.php";

class Usuario
{
    protected $id = null;
    protected $nombres;
    protected $apellidos;
    protected $email;
    protected $password;
    protected $celular;
    protected $tipo;
    protected $dni_ruc;

    public function __construct(
        $nombres = "",
        $apellidos = "",
        $email = "",
        $password = "",
        $celular = "",
        $tipo = "",
        $dni_ruc = ""
    ) {
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->password = $password;
        $this->celular = $celular;
        $this->tipo = $tipo;
        $this->dni_ruc = $dni_ruc;
    }

    public function obtenerTodos()
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Usuario";
        $resultado = $conexion->query($sql);
        $data = $resultado->fetchAll();
        $conn->cerrar();

        $usuarios = [];
        foreach ($data as $item) {
            $usuario = new self(
                $item['nombres'],
                $item['apellidos'],
                $item['email'],
                $item['password'],
                $item['celular'],
                $item['tipo'],
                $item['dni_ruc']
            );
            $usuario->id = $item['id'];
            $usuarios[] = $usuario;
        }

        return $usuarios;
    }

    public function obtenerPorId($id)
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Usuario WHERE id = $id";
        $resultado = $conexion->query($sql);
        $data = $resultado->fetch();
        $conn->cerrar();

        if (!$resultado) {
            return null;
        } else {
            $this->nombres = $data['nombres'];
            $this->apellidos = $data['apellidos'];
            $this->email = $data['email'];
            $this->password = $data['password'];
            $this->celular = $data['celular'];
            $this ->tipo =$data['tipo'];
            $this->dni_ruc = $data['dni_ruc'];
            return $this;
        }
    }

    public function obtenerPorEmail($email)
{
    $conn = new Conexion();
    $conexion = $conn->conectar();
    
    $sql = "SELECT * FROM Usuario WHERE email = :email";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $conn->cerrar();

    if ($data) {
        $this->id = $data['id'];
        $this->nombres = $data['nombres'];
        $this->apellidos = $data['apellidos'];
        $this->password = $data['password'];
        $this->celular = $data['celular'];
        $this->tipo = $data['tipo'];
        $this->dni_ruc = $data['dni_ruc'];
        return $this;
    } else {
        return null;
    }   
}

    public function crear()
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();

        $sql = "INSERT INTO Usuario (nombres, apellidos, email, password, celular, tipo, dni_ruc) 
                VALUES (
                    '{$this->nombres}', 
                    '{$this->apellidos}', 
                    '{$this->email}', 
                    '{$this->password}', 
                    '{$this->celular}', 
                    '{$this->tipo}', 
                    '{$this->dni_ruc}'
                )";

        $result = $conexion->exec($sql);

        if ($result) {
            $this->id = $conexion->lastInsertId();
            $conn->cerrar();
            return true;
        } else {
            $conn->cerrar();
            return false;
        }
    }

    public function actualizar()
    {
        if ($this->id === null) {
            return false;
        }

        $conn = new Conexion();
        $conexion = $conn->conectar();

        $sql = "UPDATE Usuario SET 
                nombres = '{$this->nombres}', 
                apellidos = '{$this->apellidos}', 
                email = '{$this->email}', 
                password = '{$this->password}', 
                celular = '{$this->celular}', 
                tipo = '{$this->tipo}', 
                dni_ruc = '{$this->dni_ruc}' 
                WHERE id = {$this->id}";

        $resultado = $conexion->exec($sql);
        $conn->cerrar();

        return $resultado;
    }

    public function eliminar($id)
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "DELETE FROM Usuario WHERE id = $id";
        $resultado = $conexion->exec($sql);
        $conn->cerrar();

        return $resultado;
    }

    // Getters y setters

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
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

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getCelular()
    {
        return $this->celular;
    }

    public function setCelular($celular)
    {
        $this->celular = $celular;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function getDniRuc()
    {
        return $this->dni_ruc;
    }

    public function setDniRuc($dni_ruc)
    {
        $this->dni_ruc = $dni_ruc;
    }
}
