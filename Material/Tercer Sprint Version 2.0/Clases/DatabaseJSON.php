<?php
class DatabaseJSON {
    private $nombreArchivo;

    /*public function __construct($nombreArchivo){
        $this->nombreArchivo = $nombreArchivo; //nombre de la base de datos JSON.
    }*/

    public function getNombreArchivo(){
        return $this->nombreArchivo;
    }

    public function setNombreArchivo($nombreArchivo){
        $this->nombreArchivo = $nombreArchivo;
    }

    public function guardarUsuario($nombre,$apelido,$email,$pass1,$avatar){
      $usuariosJSON = file_get_contents("usuarios.json");
      $usuariosPHP = json_decode($usuariosJSON,true);
      $usuarioNuevo = [
          "nombre"=>$nombre,
          "apellido"=>$apellido,
          "email" => $email,
          "pass"=>password_hash($password,PASSWORD_DEFAULT),
          "avatar" => $avatar,
      ];
      $usuariosPHP[] = $usuarioNuevo;
      $usuariosJSON = json_encode($usuariosPHP);
      file_put_contents("../usuarios.json",$usuariosJSON);
      $_SESSION["usuario_logueado"] = $email;
      //header("Location:perfil.php");
    }

    public function traerUsuariosPHP(){
        //traerme la base de usuarios
        $usuariosJSON = file_get_contents("../usuarios.json");
        //decodificarla
        $usuariosPHP = json_decode($usuariosJSON,true);
        //devuelve el array en php
        return $usuariosPHP;
    }

    public function encontrarUsuario($usuariosPHP,$email){
        foreach($usuariosPHP as $usuario){
            if($usuario["email"] == $email){
                //me guardo el usuario
                $usuarioLogueado = $usuario;
                //Y FRENO
                break;
            }
        }
        return $usuarioLogueado;
    }

    public function borrar(){}
    public function actualizarJSON($nombre,$apellido,$email,$avatar){
      //piso los datos en el usuario
      $usuarioLogueado["nombre"] = $nombre;
      $usuarioLogueado["apellido"] = $apellido;
      $usuarioLogueado["email"] = $email;
      $usuarioLogueado["avatar"] = $avatar;
      //recorrer los usuarios
      $nuevaBase = [];
      foreach($usuariosPHP as $usuario){
          if($usuario["email"] == $usuarioLogueado["email"]){
              //piso los datos del usuario en el array
              $usuario = $usuarioLogueado;
          }
          $nuevaBase[] = $usuario;
      }
      $usuariosJSON = json_encode($nuevaBase);
      file_put_contents("../usuarios.json",$usuariosJSON);
      header("Location:perfil.php");


    }
}
