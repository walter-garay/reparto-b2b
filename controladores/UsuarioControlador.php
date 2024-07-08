<?php

require_once "../modelos/Usuario.php";
require_once "../modelos/Repartidor.php";
require_once "../modelos/EmpresaCliente.php";
require_once "../modelos/Administrador.php";

class UsuarioControlador
{
    private $usuario;

    public function __construct()
    {
        $this->usuario = new Usuario();
    }

    public function obtenerUsuarios()
    {
        return $this->usuario->obtenerTodos();
    }

    public function obtenerRepartidores()
    {
        $repartidor = new Repartidor();
        return $repartidor->obtenerTodos();
    }

    public function obtenerUsuarioPorId($id)
    {
        return $this->usuario->obtenerPorId($id);
    }

    public function crearUsuario($datos) {
        $usuario = new Usuario();
    
        try {
            // Insertar datos en la tabla Usuario
            $usuario->setNombres($datos['nombres']);
            $usuario->setApellidos($datos['apellidos']);
            $usuario->setEmail($datos['email']);
            $usuario->setPassword(password_hash($datos['password'], PASSWORD_DEFAULT));
            $usuario->setCelular($datos['celular']);
            $usuario->setTipo($datos['tipo']);
            $usuario->setDniRuc($datos['dni_ruc']);
            $id_usuario = $usuario->crear();
    
            // Dependiendo del tipo de usuario, crear e insertar en la tabla correspondiente
            switch ($datos['tipo']) {
                case 'repartidor':
                    $repartidor = new Repartidor();
                    $repartidor->setId($id_usuario);
                    $repartidor->setTipoTransporte($datos['tipo_transporte']);
                    $repartidor->setPlaca($datos['placa']);
                    $repartidor->crear();
                    break;
                case 'empresa_cliente':
                    $empresaCliente = new EmpresaCliente();
                    $empresaCliente->setId($id_usuario);
                    $empresaCliente->setDireccion($datos['direccion']);
                    $empresaCliente->setRazonSocial($datos['razon_social']);
                    $empresaCliente->crear();
                    break;
                case 'administrador':
                    $administrador = new Administrador();
                    $administrador->setId($id_usuario);
                    $administrador->setCodAdmin($this->generarCodigoAdmin());
                    $administrador->crear();
                    break;
                default:
                    throw new Exception("Tipo de usuario no válido");
            }
        
        } catch (Exception $e) {
            // Revertir transacción en caso de error
            echo '<script>console.log('. $e->getMessage() .');</script>';
            throw $e;
        }
    }

    public function actualizarUsuario($id, $datos)
    {
        $usuario = $this->obtenerUsuarioPorId($id);
        if (!$usuario) {
            return false;
        }

        $usuario->setNombres($datos['nombres']);
        $usuario->setApellidos($datos['apellidos']);
        $usuario->setEmail($datos['email']);
        $usuario->setCelular($datos['celular']);
        $usuario->setDniRuc($datos['dni_ruc']);

        // Si se proporciona una nueva contraseña, actualizarla
        if (!empty($datos['password'])) {
            $usuario->setPassword(password_hash($datos['password'], PASSWORD_DEFAULT));
        }

        return $usuario->actualizar();
    }

    private function generarCodigoAdmin() {
        return 'ADM' . uniqid();
    }

    public function eliminarUsuario($id)
    {
        return $this->usuario->eliminar($id);
    }
}