<?php

require_once "Conexion.php";

class Delivery
{
    private $id = null;
    private $descripcion;
    private $cod_seguimiento;
    private $fecha_solicitud;
    private $id_cliente;
    private $id_recojo;
    private $id_entrega;
    private $id_pago;
    private $id_contraentrega;
    private $id_destinatario;

    public function __construct(
        $descripcion = "",
        $cod_seguimiento = "",
        $fecha_solicitud = null,
        $id_cliente = 0,
        $id_recojo = 0,
        $id_entrega = 0,
        $id_pago = 0,
        $id_contraentrega = 0,
        $id_destinatario = 0
    ) {
        $this->descripcion = $descripcion;
        $this->cod_seguimiento = $cod_seguimiento;
        $this->fecha_solicitud = $fecha_solicitud ?? new DateTime();
        $this->id_cliente = $id_cliente;
        $this->id_recojo = $id_recojo;
        $this->id_entrega = $id_entrega;
        $this->id_pago = $id_pago;
        $this->id_contraentrega = $id_contraentrega;
        $this->id_destinatario = $id_destinatario;
    }

    public function obtenerTodos()
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Delivery";
        $resultado = $conexion->query($sql);
        $data = $resultado->fetchAll();
        $conn->cerrar();

        $deliveries = [];
        foreach ($data as $item) {
            $delivery = new self(
                $item['descripcion'],
                $item['cod_seguimiento'],
                new DateTime($item['fecha_solicitud']),
                $item['id_cliente'],
                $item['id_recojo'],
                $item['id_entrega'],
                $item['id_pago'],
                $item['id_contraentrega'],
                $item['id_destinatario']
            );
            $delivery->id = $item['id'];
            $deliveries[] = $delivery;
        }

        return $deliveries;
    }


    public function obtenerPorId($id)
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Delivery WHERE id = $id";
        $resultado = $conexion->query($sql);
        $data = $resultado->fetch();
        $conn->cerrar();

        if ($data) {
            $this->descripcion = $data['descripcion'];
            $this->cod_seguimiento = $data['cod_seguimiento'];
            $this->fecha_solicitud = new DateTime($data['fecha_solicitud']);
            $this->id_cliente = $data['id_cliente'];
            $this->id_recojo = $data['id_recojo'];
            $this->id_entrega = $data['id_entrega'];
            $this->id_pago = $data['id_pago'];
            $this->id_contraentrega = $data['id_contraentrega'];
            $this->id_destinatario = $data['id_destinatario'];
            return $this;
        } else {
            return null;
        }
    }

    public function crear()
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();

        $sql = "INSERT INTO Delivery (descripcion, cod_seguimiento, fecha_solicitud, id_cliente, id_recojo, id_entrega, id_pago, id_contraentrega, id_destinatario) 
                VALUES (
                    '{$this->descripcion}', 
                    '{$this->cod_seguimiento}', 
                    '{$this->fecha_solicitud}', 
                    {$this->id_cliente}, 
                    {$this->id_recojo}, 
                    {$this->id_entrega}, 
                    {$this->id_pago}, 
                    {$this->id_contraentrega}, 
                    {$this->id_destinatario}
                )";

        $result = $conexion->exec($sql);

        if ($result) {
            $this->id = $conexion->lastInsertId();
        }

        $conn->cerrar();

        return $result;
    }

    public function actualizar()
    {
        if ($this->id === null) {
            return false;
        }

        $conn = new Conexion();
        $conexion = $conn->conectar();

        $sql = "UPDATE Delivery SET 
                descripcion = '{$this->descripcion}', 
                cod_seguimiento = '{$this->cod_seguimiento}', 
                id_cliente = {$this->id_cliente}, 
                id_recojo = {$this->id_recojo}, 
                id_entrega = {$this->id_entrega}, 
                id_pago = {$this->id_pago}, 
                id_contraentrega = {$this->id_contraentrega}, 
                id_destinatario = {$this->id_destinatario} 
                WHERE id = {$this->id}";

        $resultado = $conexion->exec($sql);
        $conn->cerrar();

        return $resultado;
    }

    public function eliminar($id)
    {
        $conn = new Conexion();
        $conexion = $conn->conectar();
        $sql = "DELETE FROM Delivery WHERE id = $id";
        $resultado = $conexion->exec($sql);
        $conn->cerrar();

        return $resultado;
    }

    // Getters y setters

    public function getId()
    {
        return $this->id;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getCodSeguimiento()
    {
        return $this->cod_seguimiento;
    }

    public function setCodSeguimiento($cod_seguimiento)
    {
        $this->cod_seguimiento = $cod_seguimiento;
    }

    public function getFechaSolicitud()
    {
        return $this->fecha_solicitud;
    }

    public function setFechaSolicitud($fecha_solicitud)
    {
        $this->fecha_solicitud = $fecha_solicitud;
    }

    public function getIdCliente()
    {
        return $this->id_cliente;
    }

    public function setIdCliente($id_cliente)
    {
        $this->id_cliente = $id_cliente;
    }

    public function getIdRecojo()
    {
        return $this->id_recojo;
    }

    public function setIdRecojo($id_recojo)
    {
        $this->id_recojo = $id_recojo;
    }

    public function getIdEntrega()
    {
        return $this->id_entrega;
    }

    public function setIdEntrega($id_entrega)
    {
        $this->id_entrega = $id_entrega;
    }

    public function getIdPago()
    {
        return $this->id_pago;
    }

    public function setIdPago($id_pago)
    {
        $this->id_pago = $id_pago;
    }

    public function getIdContraentrega()
    {
        return $this->id_contraentrega;
    }

    public function setIdContraentrega($id_contraentrega)
    {
        $this->id_contraentrega = $id_contraentrega;
    }

    public function getIdDestinatario()
    {
        return $this->id_destinatario;
    }

    public function setIdDestinatario($id_destinatario)
    {
        $this->id_destinatario = $id_destinatario;
    }
}
?>
