<?php
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
  }
?>