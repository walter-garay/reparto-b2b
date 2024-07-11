<?php
/*
require_once  'UsuarioControlador.php';
require_once "../controladores/UsuarioControlador.php";
  if (!empty($_POST["btningresar"])){
    if(empty($_POST["email"]) and empty($_POST["password"])){
        echo '<div class="alert-danger">Los campos están vacíos</div>';
    }else{
        $email=$_POST["email"];
        $clave=$_POST["password"];
        $sql=$conexion->query("SELECT * FROM usuario WHERE email='$email' AND password='$clave' ");
        if ($datos=$sql->fetch_object()){
            header("Location: index.php");
        }else{
            echo '<div class="alert alert-danger">ACCESO DENEGADO</div>';
        }
    }
  }*/

require_once "../../modelos/Usuario.php";

class LoginControlador{

    public function login($username, $password){
        $usuario = new Usuario();
        $usuarioValidado = $usuario->login($username);
        $contador = 0;
        $usuario_id = null;
        $usuario_nombre = null;
        $password_bd = null;

        foreach($usuarioValidado as $item){
            $usuario_id = $item["id"];
            $usuario_nombre = $item["nombres"]." ".$item["apellidos"];
            $email_bd = $item["email"]; 
            $password_bd = $item["password"];
            $tipo = $item["tipo"];
            $contador++;
        }

        if($contador>0){
            if($password == $password_bd){
                session_start();
                $_SESSION["id"] = $usuario_id;
                $_SESSION["tipo"]= $tipo;
                $_SESSION["usuario"] = $usuario_nombre;
                $_SESSION["email"] = $email_bd;
                header("Location: ../../main.php");
            }
            else{
                echo "Usuario y/o contraseña incorrecta";
            }
        }
        else{
            echo "Usuario y/o contraseña incorrecta";
        }
    }

}
?>