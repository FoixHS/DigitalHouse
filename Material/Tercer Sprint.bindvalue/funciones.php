<?php
  include '/Clases/DatabaseMYSQL';


  function traerArrayDeUsuarios(){
    $datosEnJSON = file_get_contents("../usuarios.json");
    $arrayDeUsuarios = json_decode($datosEnJSON, true);
    return $arrayDeUsuarios;
  }

  function validarEmail($email){
    $arrayDeUsuarios = traerUsuario();
    foreach ($arrayDeUsuarios as $usuario) {
      $errores=false;
      if($usuario["email"] == $email){
        $errores = true;
      }
      return $errores;
    }
  }

  function soloSiEstaLogueado(){
    if(isset($_SESSION["usuario_logueado"])){
      header("Location:../home/index.php");
    }
  }
  function siNoEstaLogueado(){
    if(!isset($_SESSION["usuario_logueado"])){
      header("Location:../login/login.php");
    }
  }

  //cookies
function iniciarSesionDeUsuario($usuarioLogueandose, $datosDelPost)
{
    $_SESSION["nombreDeUsuario"] = $usuarioLogueandose["nombreDeUsuario"];
    $_SESSION["emailDelUsuario"] = $usuarioLogueandose["emailDelUsuario"];
    $_SESSION["perfilDeUsuario"] = $usuarioLogueandose["perfilDeUsuario"];
    $_SESSION["avatarDelUsuario"] = $usuarioLogueandose["avatarDelUsuario"];
    if (isset($datosDelPost["recordarUsuario"])) {
        setcookie("emailDelUsuario", $datosDelPost["emailDelUsuario"], time() + 3600);
        setcookie("passDelUsuario", $datosDelPost["passDelUsuario"], time() + 3600);
    }
}

function validarCookiesDeUsuario()
{
    if (isset($_SESSION["emailDelUsuario"])) {
        return true;
    } elseif ( isset($_COOKIE["emailDelUsuario"])) {
        $_SESSION["emailDelUsuario"] = $_COOKIE["email"];
        return true;
    } else {
        return false;
    }
}
 ?>
