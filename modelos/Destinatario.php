<?php

require_once "Conn.php";

class Destinatario {
    protected $id;
    protected $nombresDesti;
    protected $apellidosDesti;
    protected $emailDesti;
    protected $numeroDesti;

    public function __construct($nombresDesti = "", $apellidosDesti = "", $emailDesti = "", $numeroDesti = "") {
        $this->nombresDesti = $nombresDesti;
        $this->apellidosDesti = $apellidosDesti;
        $this->emailDesti = $emailDesti;
        $this->numeroDesti = $numeroDesti;
    }

    public function obtenerTodos() {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Destinatario";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }
    
    public function obtenerPorId($id) {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Destinatario WHERE id = $id";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function crear() {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "INSERT INTO Destinatario(nombresDesti, apellidosDesti, emailDesti, numeroDesti) VALUES ('$this->nombresDesti', '$this->apellidosDesti', '$this->emailDesti', '$this->numeroDesti')";
        $result = $conexion->exec($sql);
        if($result > 0) {
            echo "Destinatario creado exitosamente";
        } else {
            echo "Ocurrió un error, vuelva a intentarlo";
        }
        $conn->cerrar();
    }

    public function actualizar($id) {
    $conn = new Conn();
    $conexion = $conn->conectar();
    $sql = "UPDATE Destinatario SET nombresDesti = '$this->nombresDesti', apellidosDesti = '$this->apellidosDesti', emailDesti = '$this->emailDesti', numeroDesti = '$this->numeroDesti' WHERE id = $id";
    $result = $conexion->exec($sql);
    if($result > 0) {
        echo "Destinatario actualizado exitosamente";
    } else {
        echo "Ocurrió un error, vuelva a intentarlo";
    }
    $conn->cerrar();
    }
    /*
    public function eliminar($id) {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "DELETE FROM Destinatario WHERE id = $id";
        $result = $conexion->exec($sql);

        if($result > 0) {
            echo "Destinatario eliminado exitosamente";
        } else {
            echo "Ocurrió un error, vuelva a intentarlo";
        }
        $conn->cerrar();
    }*/
}
