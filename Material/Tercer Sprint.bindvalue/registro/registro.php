<!DOCTYPE html>
<?php

session_start();
require_once '../funciones.php';
//    soloSiEstaLogueado();
$errorNombre = "";
$errorEmail = "";
$errorPass1 = "";
$errorPass2 = "";
$errorFoto= "";
$nombre = "";
$email = "";
$errores =false;
if($_POST){
  $nombre = $_POST["nombre"];
  $apellido = $_POST["apellido"];
  $email = $_POST["email"];
  $pass1 = $_POST["pass1"];
  $pass2 = $_POST["pass2"];
  $avatar = $_FILES["avatar"]["name"];
  $errores = false;
  $emailCorto = substr_replace($email ,"",-4);

  include '../Clases/Validador.php';
  $validador = new Validador();
  
  if($validador->estaVacio($nombre)){
    $errorNombre = "*El nombre es obligatorio";
    $errores = true;
  }

  if($validador->estaVacio($email)){
    $errorEmail = "*El email es obligatorio";
    $errores = true;
  } else if($validador->tieneFormatoEmail($email)){
    $errorEmail = "*Se requiere formato de email";
    $errores = true;
  }else if($validador->emailValido($email)){
    $errorEmail = "*El email ya fue utilizado";
    $errores = true;
  }

  if($validador->estaVacio($pass1)){
    $errorPass1 = "*La contraseña es obligatoria";
    $errores = true;
  }else if($validador->cantidadMinima($pass1)){
    $errorPass1 = "*La contraseña debe tener más de 5 caracteres";
    $errores = true;
  }

  if($validador->estaVacio($pass2)){
    $errorPass2 = "*Repetir la contraseña es obligatorio";
    $errores = true;
  }else if($validador->sonDistintas($pass1,$pass2)){
    $errorPass1 = "*Las contraseñas deben ser iguales";
    $errorPass2 = "*Las contraseñas deben ser iguales";
    $errores = true;
  }

  if($_FILES){
    if($_FILES["avatar"]["error"]!=0){
      $errorFoto="Hubo un error al cargar la foto";
    }else{
      $ext = pathinfo($_FILES["avatar"]["name"],PATHINFO_EXTENSION);
      if($ext!="jpg" && $ext!="jpeg" && $ext!="png"){
        $errorFoto="La foto debe ser un archivo jpg, jpeg o png";
      }else{
        move_uploaded_file($_FILES["avatar"]["tmp_name"], "../avatar/$emailCorto." . $ext);
      }
    }
  }

  if(!$errores){
  /*  require_once '../Clases/DatabaseJSON.php';
    $avatar = $emailCorto .".". $ext;
    $json = new DatabaseJSON;
    $json->guardarUsuario($nombre,$apellido,$email,$pass1,$avatar);
*/

    require_once '../Clases/DatabaseMYSQL.php';
    require_once '../Clases/Usuario.php';

        //genero una base de datos
        $bd = new DatabaseMYSQL;
        //genero un nuevo usuario
        $usuarioNuevo = new Usuario($_POST["email"],$_POST["nombre"], $_POST["apellido"],password_hash($_POST["pass1"],PASSWORD_DEFAULT),$emailCorto .".". $ext);
        //le paso el nuevo usuario a la base de datos
        $bd->guardarUsuario($usuarioNuevo);
        /*      $usuarioId = $bd->guardarUsuario($usuarioNuevo);
                $_SESSION["id"] = $usuarioId;
*/
    header("Location:../login/login.php");

  }

}


 ?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="registro.css">
  <link rel="stylesheet" href="fontello/css/fontello.css"/>
  <title>Registrate</title>
</head>
<body>
    <header>
        <div class="logo">
          <a href="../home/index.php">
            <img src="img/logo2.png" alt="logo">
          </a>
        </div>
        <div class="buscador">
          <select name="Barrio">
              <option value="Barrio"disabled selected>-Selecciona tu barrio-</option>
              <option value="Almagro">Almagro</option>
              <option value="Balvanera">Balvanera</option>
              <option value="Belgrano">Belgrano</option>
              <option value="Colegiales">Colegiales</option>
              <option value="Chacarita">Chacarita</option>
              <option value="Coghlan">Coghlan</option>
              <option value="Caballito">Caballito</option>
              <option value="Flores">Flores</option>
              <option value="Nueva Pompeya">Nueva Pompeya</option>
              <option value="Palermo">Palermo</option>
              <option value="San Telmo">San Telmo</option>
              <option value="Versalles">Versalles</option>
              <option value="Villa Luro">Villa Luro</option>
          </select>
        </div>
        <div class="preguntas">
          <a href="../faq/faq.php">Preguntas Frecuentes</a>
        </div>
        </div>
    </header>


  <main>
      <div class="container" id="container" style="
    height: 90vh">
            <div class="form-container sign-in-container">
              <form action="registro.php" method="POST" enctype="multipart/form-data">
                  <h1>Registrate</h1>
                  <div class="social-container">
                    <a href="#" class="social icon-facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social icon-twitter"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social icon-instagram"><i class="fab fa-linkedin-in"></i></a>
                  </div>
                  <input type="text" name="nombre" placeholder="Nombre" value=<?=$nombre?>>
                  <input type="text" name="apellido" placeholder="Apellido">
                  <span><?=$errorNombre?></span>
                  <input type="email" name="email" placeholder="Email" value=<?=$email?> >

                  <span><?=$errorEmail?></span>
                  <input type="password" name="pass1" placeholder="Contraseña" >

                  <span><?=$errorPass1?></span>
                  <input type="password" name="pass2" placeholder="Repita contraseña">

                  <span><?=$errorPass2?></span>

                  <h5>Foto de Perfil:</h5>
                  <input type="file" name="avatar" accept="image/png, image/jpeg">
                  <br>
                  <span><?=$errorFoto?></span>
                  <button type="submit">Registrate</button>
              </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                      <div class="overlay-panel overlay-right">
                          <h1>Bienvenido!</h1>
                          <p>Para seguir conectado, por favor inicia sesión con tus datos</p>
                          <a href="../login/login.php"><button class="ghost" id="signUp">Inicia Sesión </button></a>
                      </div>
                </div>
            </div>
      </div>
    </main>
</body>
</html>
