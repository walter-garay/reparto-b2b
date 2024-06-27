<?php

require_once "Conexion.php";
require_once "Usuario.php";

class Administrador extends Usuario {
    public function __construct($nombres = "", $apellidos = "", $email = "", $password = "", $celular = "", $tipo = "", $dni_ruc = "") {
        parent::__construct($nombres, $apellidos, $email, $password, $celular, $tipo, $dni_ruc);
    }

    public function obtenerTodos() {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Usuario WHERE tipo = 'administrador'";
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

        // Crear Usuario primero
        parent::crear();

        // Obtener el id del último usuario insertado
        $lastInsertId = $conexion->lastInsertId();

        // Asignar tipo administrador
        $sql = "UPDATE Usuario SET tipo = 'administrador' WHERE id = $lastInsertId";
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

        $sql = "UPDATE Usuario SET nombres = 'Nuevo Nombre' WHERE id = $id";
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

        // Eliminar Usuario
        $sql = "DELETE FROM Usuario WHERE id = $id";
        $result = $conexion->exec($sql);

        if($result > 0) {
            echo "Administrador eliminado exitosamente";
        } else {
            echo "Ocurrió un error, vuelva a intentarlo";
        }
        $conn->cerrar();
    }
}

?>
