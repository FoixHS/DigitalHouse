<!DOCTYPE html>
<?php
session_start();
require_once '../funciones.php';
require_once '../Clases/DatabaseMYSQL.php';
require_once '../Clases/Usuario.php';

$bd = new DatabaseMYSQL;
$usuario = $bd->traerUsuario($_SESSION["id"]);

$arrayDeUsuarios = traerArrayDeUsuarios();

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
  $email = $_POST["email"];
  $apellido = $_POST["apellido"];
  $avatar = $_FILES["avatar"]["name"];
  $errores = false;
  $emailCorto = substr_replace($email ,"",-4);

  if($nombre == ""){
    $errorNombre = "*El nombre es obligatorio";
    $errores = true;
  }

  if($email == ""){
    $errorEmail = "*El email es obligatorio";
    $errores = true;
  } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errorEmail = "*Se requiere formato de email";
    $errores = true;
  }else if(validarEmail($email)){
    $errorEmail = "*El email ya fue utilizado";
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
$avatar=$emailCorto .".". $ext;
  if(!$errores){
  /*  $arrayDeUsuarios = traerArrayDeUsuarios();
    $nuevoUsuario = [
      "nombre" => $nombre,
      "email" => $email,
      "avatar" => $emailCorto .".". $ext,
      "contrasenia" => password_hash($pass1, PASSWORD_DEFAULT),
      "repetirContrasenia" => password_hash($pass2, PASSWORD_DEFAULT)
    ];
    $arrayDeUsuarios[] = $nuevoUsuario;
    $datosEnJSON = json_encode($arrayDeUsuarios);
    file_put_contents("../usuarios.json", $datosEnJSON);

*/
          $bd->actualizarUsuario($nombre,$apellido,$email,$avatar);

  //  $_SESSION["usuario_logueado"] = $usuarioId;
    header("Location:../Home/index.php");
  }

}


/*

 foreach ($arrayDeUsuarios as $usuario) {
  if($usuario["email"]==$_SESSION["usuario_logueado"]){
    $usuarioLogueado = $usuario;
    break;
  }else{
    siNoEstaLogueado();
  }
}

*/



 ?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="editarperfil.css">
  <link rel="stylesheet" href="fontello/css/fontello.css"/>
  <title>Inicia Sesión</title>
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
      <div class="container">
                <h1>Editar Perfil</h1>
                <div class="avatar">
                  <img src="../avatar/<?=$usuario["avatar"]?>" alt="Foto de perfil" style="width:200px;">
                </div>
                  <form action="" method="POST" enctype="multipart/form-data">
                <div class="social-container">
                  <a href="#" class="social icon-facebook"><i class="fab fa-facebook-f"></i></a>
                  <a href="#" class="social icon-twitter"><i class="fab fa-google-plus-g"></i></a>
                  <a href="#" class="social icon-instagram"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <h4>Nombre:</h4>  <input type="text" name="nombre" value="<?=$usuario['nombre']?>">
                <br>
                <h4>Apellido:</h4><input type="text" name="apellido" value="<?=$usuario['apellido']?>">
                <br>
                <span><?=$errorNombre?></span>
                <h4>Email:</h4><input type="email" name="email" value="<?=$usuario['email']?>" value=<?=$email?> >
                <span><?=$errorEmail?></span>
                <br>
                  <h4>Foto de Perfil:</h4>
                <input type="file" name="avatar" accept="image/png, image/jpeg">
                <br>
                <span><?=$errorFoto?></span>
                <button type="submit" name="button">Guardar cambios</button>
            </form>

      </div>
    </main>



</body>
</html>
