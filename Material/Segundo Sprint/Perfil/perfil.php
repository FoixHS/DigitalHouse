<!DOCTYPE html>
<?php
session_start();
require_once '../funciones.php';

$arrayDeUsuarios = traerArrayDeUsuarios();

foreach ($arrayDeUsuarios as $usuario) {
  if($usuario["email"]==$_SESSION["usuario"]){
    $usuarioLogueado = $usuario;
    break;
  }else{
    header("Location:../login/login.php");
  }
}


 ?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="perfil.css">
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
          <h1>Nombre: <?=$usuarioLogueado["nombre"]?></h1>
          <h1>Email: <?=$usuarioLogueado["email"]?></h1>
          <form class="" id="logout" action="../logout.php" method="post">
          <button type="submit" name="button">Cerrar Sesion</button>

          </form>
      </div>
    </main>



</body>
</html>
