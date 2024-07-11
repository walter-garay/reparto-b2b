<?php

require_once __DIR__."/../modelos/Usuario.php";
require_once __DIR__."/../modelos/Repartidor.php";
require_once __DIR__."/../modelos/EmpresaCliente.php";
require_once __DIR__."/../modelos/Administrador.php";

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

    public function obtenerClientes()
    {
        $clientes = new EmpresaCliente();
        return $clientes->obtenerTodos();
    }

    public function obtenerUsuarioPorId($id)
    {
        return $this->usuario->obtenerPorId($id);
    }

    public function login($email, $password)
    {
        $usuario = $this->usuario->obtenerPorEmail($email);
        if ($usuario && password_verify($password, $usuario->getPassword())) {
            session_start();
            $_SESSION['usuario_id'] = $usuario->getId();
            $_SESSION['usuario_tipo'] = $usuario->getTipo();
            $_SESSION['usuario_email'] = $usuario->getEmail();
            header('Location: ../index.php');
            return true;
        } 
        return false;
    }

    public function logout()
    {
        session_destroy();
        
    }

    public function crearUsuario($datos) {
        $usuario = new Usuario();
        
        try {
            // Insertar datos en la tabla Usuario
            $usuario->setNombres(isset($datos['nombres']) ? $datos['nombres'] : null);
            $usuario->setApellidos(isset($datos['apellidos']) ? $datos['apellidos'] : null);
            $usuario->setEmail(isset($datos['email']) ? $datos['email'] : null);
            $usuario->setPassword(isset($datos['password']) ? password_hash($datos['password'], PASSWORD_DEFAULT) : null);
            $usuario->setCelular(isset($datos['celular']) ? $datos['celular'] : null);
            $usuario->setTipo(isset($datos['tipo']) ? $datos['tipo'] : null);
            $usuario->setDniRuc(isset($datos['dni_ruc']) ? $datos['dni_ruc'] : null);
    
            if ($usuario->crear()) {
                $id_usuario = $usuario->getId();
                
                // Dependiendo del tipo de usuario, crear e insertar en la tabla correspondiente
                switch ($datos['tipo']) {
                    case 'Repartidor':
                        $repartidor = new Repartidor();
                        $repartidor->setId($id_usuario);
                        $repartidor->setTipoTransporte(isset($datos['tipo_transporte']) ? $datos['tipo_transporte'] : null);
                        $repartidor->setPlaca(isset($datos['placa']) ? $datos['placa'] : null);
                        $repartidor->crear();
                        break;
                    case 'Cliente':
                        $empresaCliente = new EmpresaCliente();
                        $empresaCliente->setId($id_usuario);
                        $empresaCliente->setDireccion(isset($datos['direccion']) ? $datos['direccion'] : null);
                        $empresaCliente->setRazonSocial(isset($datos['razon_social']) ? $datos['razon_social'] : null);
                        $empresaCliente->crear();
                        break;
                    case 'Administrador':
                        $administrador = new Administrador();
                        $administrador->setId($id_usuario);
                        $administrador->setCodAdmin($this->generarCodigoAdmin());
                        $administrador->crear();
                        break;
                    default:
                        throw new Exception("Tipo de usuario no válido");
                }
                
                header("Location: login.php");
                exit();
            }
        } catch (Exception $e) {
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