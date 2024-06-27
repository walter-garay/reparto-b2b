<?php

require_once "Usuario.php";
require_once "Conexion.php";

class EmpresaCliente extends Usuario {
    private $direccion;
    private $razon_social;

    public function __construct($nombres = "", $apellidos = "", $email = "", $password = "", $celular = "", $tipo = "", $dni_ruc = "", $direccion = "", $razon_social = "") {
        parent::__construct($nombres, $apellidos, $email, $password, $celular, $tipo, $dni_ruc);
        $this->direccion = $direccion;
        $this->razon_social = $razon_social;
    }

    public function obtenerTodos() {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT Usuario.*, EmpresaCliente.direccion, EmpresaCliente.razon_social 
                FROM Usuario 
                JOIN EmpresaCliente ON Usuario.id = EmpresaCliente.id";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function obtenerPorId($id) {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT Usuario.*, EmpresaCliente.direccion, EmpresaCliente.razon_social 
                FROM Usuario 
                JOIN EmpresaCliente ON Usuario.id = EmpresaCliente.id 
                WHERE Usuario.id = $id";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function crear() {
        parent::crear();
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $id_usuario = $conexion->lastInsertId();

        $sql = "INSERT INTO EmpresaCliente(id, direccion, razon_social) VALUES ($id_usuario, '$this->direccion', '$this->razon_social')";
        $result = $conexion->exec($sql);

        if($result > 0) {
            echo "EmpresaCliente creado exitosamente";
        } else {
            echo "Ocurrió un error, vuelva a intentarlo";
        }
        $conn->cerrar();
    }

    public function actualizar($id) {
        parent::actualizar($id);
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "UPDATE EmpresaCliente SET direccion = '$this->direccion', razon_social = '$this->razon_social' WHERE id = $id";
        $result = $conexion->exec($sql);

        if($result > 0) {
            echo "EmpresaCliente actualizado exitosamente";
        } else {
            echo "Ocurrió un error, vuelva a intentarlo";
        }
        $conn->cerrar();
    }

    public function eliminar($id) {
        parent::eliminar($id);
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "DELETE FROM EmpresaCliente WHERE id = $id";
        $result = $conexion->exec($sql);

        if($result > 0) {
            echo "EmpresaCliente eliminado exitosamente";
        } else {
            echo "Ocurrió un error, vuelva a intentarlo";
        }
        $conn->cerrar();
    }
}
?>
