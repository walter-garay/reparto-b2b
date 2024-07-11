<?php
require_once __DIR__ . '/../modelos/Administrador.php';

class AdministradorControlador
{
    private $administrador;

    public function __construct()
    {
        $this->administrador = new Administrador();
    }

    public function obtenerAdministradores()
    {
        return $this->administrador->obtenerTodos();
    }

    public function obtenerAdministradorPorId($id)
    {
        return $this->administrador->obtenerPorId($id);
    }

    public function crearAdministrador($datos) 
    {
        $administrador = new Administrador();        
        try {
            $administrador->setNombres($datos['nombres']);
            $administrador->setApellidos($datos['apellidos']);
            $administrador->setEmail($datos['email']);
            $administrador->setPassword(password_hash($datos['password'], PASSWORD_DEFAULT));
            $administrador->setCelular($datos['celular']);
            $administrador->setDniRuc($datos['dni_ruc']);
            $administrador->setTipo("Admin");
            $administrador->crear();
    
        } catch (Exception $e) {
            echo '<script>console.log('. $e->getMessage() .');</script>';
            throw $e;
        }
    }

    public function actualizarAdministrador($id, $datos)
    {
        $administrador = new Administrador();
        try {
            $administrador->setId($id);
            $administrador->setNombres($datos['nombres']);
            $administrador->setApellidos($datos['apellidos']);
            $administrador->setEmail($datos['email']);
            $administrador->setCelular($datos['celular']);
            $administrador->setDniRuc($datos['dni_ruc']);
            $administrador->setTipo("Administrador");
            $administrador->actualizar();
        } catch (Exception $e) {
            echo '<script>console.log('. $e->getMessage() .');</script>';
            throw $e;
        }
    }

    public function eliminarAdministrador($id)
    {
        return $this->administrador->eliminar($id);
    }
}
?>
