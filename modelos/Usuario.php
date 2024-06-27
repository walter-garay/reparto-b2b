<?php

require_once "Conexion.php";

class Usuario {
    private $id;
    private $nombres;
    private $apellidos;
    private $email;
    private $password;
    private $celular;
    private $tipo;
    private $dni_ruc;

    public function __construct($nombres = "", $apellidos = "", $email = "", $password = "", $celular = "", $tipo = "", $dni_ruc = "") {
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->password = $password;
        $this->celular = $celular;
        $this->tipo = $tipo;
        $this->dni_ruc = $dni_ruc;
    }

    public function obtenerTodos() {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Usuario";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }
    
    public function obtenerPorEmail($email) {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Usuario WHERE email = '$email'";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function obtenerPorId($id) {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Usuario WHERE id = $id";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function crear() {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "INSERT INTO Usuario(nombres, apellidos, email, password, celular, tipo, dni_ruc) VALUES ('$this->nombres', '$this->apellidos', '$this->email', '$this->password', '$this->celular', '$this->tipo', '$this->dni_ruc')";
        $result = $conexion->exec($sql);

        if($result > 0) {
            echo "Usuario creado exitosamente";
        } else {
            echo "Ocurrió un error, vuelva a intentarlo";
        }
        $conn->cerrar();
    }

    public function actualizar($id) {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "UPDATE Usuario SET nombres = '$this->nombres', apellidos = '$this->apellidos', email = '$this->email', password = '$this->password', celular = '$this->celular', tipo = '$this->tipo', dni_ruc = '$this->dni_ruc' WHERE id = $id";
        $result = $conexion->exec($sql);

        if($result > 0) {
            echo "Usuario actualizado exitosamente";
        } else {
            echo "Ocurrió un error, vuelva a intentarlo";
        }
        $conn->cerrar();
    }

    public function eliminar($id) {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "DELETE FROM Usuario WHERE id = $id";
        $result = $conexion->exec($sql);

        if($result > 0) {
            echo "Usuario eliminado exitosamente";
        } else {
            echo "Ocurrió un error, vuelva a intentarlo";
        }
        $conn->cerrar();
    }

    public function getEmail() {
        return $this->email;
    }
}