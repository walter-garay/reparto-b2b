<?php

require_once "Conexion.php";
require_once "Usuario.php";

class Administrador extends Usuario {
    private $cod_admin;

    public function __construct($nombres = "", $apellidos = "", $email = "", $password = "", $celular = "", $tipo = "", $dni_ruc = "", $cod_admin = "") {
        parent::__construct($nombres, $apellidos, $email, $password, $celular, $tipo, $dni_ruc);
        $this->cod_admin = $cod_admin;
    }

    public function obtenerTodos() {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT Usuario.*, Administrador.cod_admin 
                FROM Usuario 
                JOIN Administrador ON Usuario.id = Administrador.id";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function obtenerPorId($id) {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT Usuario.*, Administrador.cod_admin 
                FROM Usuario 
                JOIN Administrador ON Usuario.id = Administrador.id 
                WHERE Usuario.id = $id";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function crear() {
        $conn = new Conexion();
        $conexion = $conn->conectar();

        // Crear Usuario primero
        parent::crear();

        // Obtener el id del último usuario insertado
        $id_usuario = $conexion->lastInsertId();

        // Crear Administrador
        $sql = "INSERT INTO Administrador(id, cod_admin) VALUES ('$id_usuario', '$this->cod_admin')";
        $result = $conexion->exec($sql);

        if($result > 0) {
            echo "Administrador creado exitosamente";
        } else {
            echo "Ocurrió un error, vuelva a intentarlo";
        }
        $conn->cerrar();
    }

    public function actualizar($id) {
        $conn = new Conexion();
        $conexion = $conn->conectar();

        // Actualizar Usuario
        parent::actualizar($id);

        // Actualizar Administrador
        $sql = "UPDATE Administrador SET cod_admin = '$this->cod_admin' WHERE id = $id";
        $result = $conexion->exec($sql);

        if($result > 0) {
            echo "Administrador actualizado exitosamente";
        } else {
            echo "Ocurrió un error, vuelva a intentarlo";
        }
        $conn->cerrar();
    }

    public function eliminar($id) {
        $conn = new Conexion();
        $conexion = $conn->conectar();

        // Eliminar Administrador
        $sql = "DELETE FROM Administrador WHERE id = $id";
        $result = $conexion->exec($sql);

        if($result > 0) {
            // Eliminar Usuario
            parent::eliminar($id);
        } else {
            echo "Ocurrió un error, vuelva a intentarlo";
        }
        $conn->cerrar();
    }
}

?>
