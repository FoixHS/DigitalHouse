<!DOCTYPE html>
<?php
session_start();
require_once '../funciones.php';
require_once '../Clases/DatabaseMYSQL.php';
require_once '../Clases/Usuario.php';
require_once '../Clases/DatabaseJSON.php';

soloSiEstaLogueado();

$errorLogin = "";
$arrayDeUsuarios = traerArrayDeUsuarios('usuarios.json');
$errorEmail = "";

if($_POST){
$email = $_POST["email"];
$pass1 = password_hash($_POST["password"], PASSWORD_DEFAULT);
$bd = new DatabaseMYSQL;
$usuario = $bd->chequearUsuario($email, $pass1);

/* foreach ($arrayDeUsuarios as $usuario) {
   if($usuario["email"] == $email && password_verify($pass, $usuario["contrasenia"])){
      $_SESSION["usuario_logueado"] = $email;

      header("Location:../Home/index.php");

   } else{
     $errorLogin = "*El email o la contraseña son incorrectas";
   }
} */
}


 ?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="estilos.css">
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
    <div class="container" id="container" style="
  height: 55vh">
        <div class="form-container sign-up-container">
          <form action="#">
            <h1>Create Account</h1>
            <div class="social-container">
              <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
              <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
              <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <span>or use your email for registration</span>
            <input type="text" placeholder="Name" />
            <input type="email" placeholder="Email" />
            <input type="password" placeholder="Password" />
            <button>Sign Up</button>
          </form>
        </div>
        <div class="form-container sign-in-container">
          <form class="form-login" action="login.php" method="POST">
            <h1>Inicia Sesion</h1>
            <div class="social-container">
              <a href="#" class="social icon-facebook"><i class="fab fa-facebook-f"></i></a>
              <a href="#" class="social icon-twitter"><i class="fab fa-google-plus-g"></i></a>
              <a href="#" class="social icon-instagram"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <span style="color: red"><?=$errorLogin?></span>
            <input type="email" name="email" placeholder="Email" /> <span><?=$errorEmail?></span>
            <input type="password" name="password" placeholder="Contraseña" />
            <div class="Recordarme">
                        <input name="recordarUsuario" id="recordarUsuario" type="checkbox" value="recordarUsuario">
                        <label class="recordarme">Recordarme</label>
            </div>
            <a href="#">Olvidaste tu contraseña?</a>
            <button type="submit">Iniciar Sesión</button>
          </form>

        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                  <h1>Bienvenido!</h1>
                  <p>Para seguir conectado, por favor inicia sesión con tus datos</p>
                  <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                  <h1>Hola, Pet-amigo!</h1>
                  <p>Ingresa tus datos personales y comienza una aventura con nosotros</p>
                  <a href="../registro/registro.php"><button class="ghost" id="signUp">Registrate</button></a>
                </div>
            </div>
        </div>
    </div>
  </main>


</body>
</html>
