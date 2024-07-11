<?php
    require_once __DIR__ . '/../modelos/Repartidor.php';
    class RepartidorControlador
    {
        private $repartidor;

        public function __construct()
        {
            $this->repartidor = new Repartidor();
        }

        public function obtenerRepartidores()
        {
            return $this->repartidor->obtenerTodos();
        }

        public function obtenerRepartidorPorId($id)
        {
            return $this->repartidor->obtenerPorId($id);
        }

        // public function crearRepartidor($datos) 
        // {
        //     $repartidor = new Repartidor();        
        //     try {
        //         $repartidor->setTipo("Repartidor");

        //         $repartidor->setNombres($datos['nombres']);
        //         $repartidor->setApellidos($datos['apellidos']);
        //         $repartidor->setEmail($datos['email']);
        //         $repartidor->setPassword(password_hash($datos['password'], PASSWORD_DEFAULT));
        //         $repartidor->setCelular($datos['celular']);
        //         $repartidor->setDniRuc($datos['dni_ruc']);
        //         $repartidor->setTipoTransporte($datos['tipo_transporte']);
        //         $repartidor->setPlaca($datos['placa']);
        //         $repartidor->crear();
        
        //     } catch (Exception $e) {
        //         echo '<script>console.log('. $e->getMessage() .');</script>';
        //         throw $e;
        //     }
        // }

        public function eliminarRepartidor($id)
        {
            return $this->repartidor->eliminar($id);
        }
    }