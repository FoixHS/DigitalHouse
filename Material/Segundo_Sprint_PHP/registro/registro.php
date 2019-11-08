<!DOCTYPE html>
<<?php

session_start();

$errorNombre = "";
$errorEmail = "";
$errorPass1 = "";
$errorPass2 = "";

if($_POST){
  $nombre = $_POST["nombre"];
  $email = $_POST["email"];
  $pass1 = $_POST["pass1"];
  $pass2 = $_POST["pass2"];
  $errores = false;

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
  }

  if($pass1 == ""){
    $errorPass1 = "*La contraseña es obligatoria";
    $errores = true;
  }else if(strlen($pass1) < 5){
    $errorPass1 = "*La contraseña debe tener más de 5 caracteres";
    $errores = true;
  }

  if($pass2 == ""){
    $errorPass2 = "*Repetir la contraseña es obligatorio";
    $errores = true;
  }else if($pass1 != $pass2){
    $errorPass1 = "*Las contraseñas deben ser iguales";
    $errorPass2 = "*Las contraseñas deben ser iguales";
    $errores = true;
  }

  if(!$errores){
    $datosEnJSON = file_get_contents("usuarios.json");
    $arrayDeUsuarios = json_decode($datosEnJSON, true);
    $nuevoUsuario = [
      "nombre" => $nombre,
      "email" => $email,
      "contrasenia" => password_hash($pass1, PASSWORD_DEFAULT),
      "repetirContrasenia" => password_hash($pass2, PASSWORD_DEFAULT)
    ];
    $arrayDeUsuarios[] = $nuevoUsuario;
    $datosEnJSON = json_encode($arrayDeUsuarios);
    file_put_contents("usuarios.json", $datosEnJSON);
    //header("Location:../Home/index.php");
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
          <a href="../home/index.html">
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
          <a href="../faq/faq.html">Preguntas Frecuentes</a>
        </div>
        </div>
    </header>


  <main>
      <div class="container" id="container" style="
    height: 65vh">
            <div class="form-container sign-in-container">
              <form action="registro.php" method="POST">
                  <h1>Registrate</h1>
                  <div class="social-container">
                    <a href="#" class="social icon-facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social icon-twitter"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social icon-instagram"><i class="fab fa-linkedin-in"></i></a>
                  </div>
                  <input type="text" name="nombre" placeholder="Nombre" />
                  <br>
                  <span><?=$errorNombre?></span>
                  <input type="email" name="email" placeholder="Email" />
                  <br>
                  <span><?=$errorEmail?></span>
                  <input type="password" name="pass1" placeholder="Contraseña" />
                  <br>
                  <span><?=$errorPass1?></span>
                  <input type="password" name="pass2" placeholder="Repita contraseña">
                  <br>
                  <span><?=$errorPass2?></span>
                  <button type="submit">Registrate</button>
              </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                      <div class="overlay-panel overlay-right">
                          <h1>Bienvenido!</h1>
                          <p>Para seguir conectado, por favor inicia sesión con tus datos</p>
                          <a href="../login2.0/login2-0.html"><button class="ghost" id="signUp">Inicia Sesión </button></a>
                      </div>
                </div>
            </div>
      </div>
    </main>
</body>
</html>
