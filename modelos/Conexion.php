<?php

class Conexion{

    private $dsn;
    private $usuario;
    private $pass;
    private $conexion;

    public function __construct()
    {
        $this->dsn = "mysql:host=localhost;dbname=deliverybd";
        $this->usuario = "root";
        $this->pass = "";
    }

    public function conectar(){
        try {
            $this->conexion = new PDO($this->dsn, $this->usuario, $this->pass);
            return $this->conexion;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function cerrar(){
        $this->conexion = NULL;
    }


}
