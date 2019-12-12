<!DOCTYPE html>
<?php
session_start();
require_once '../funciones.php';
require_once '../Clases/DatabaseMYSQL.php';
require_once '../Clases/Usuario.php';

$bd = new DatabaseMYSQL;
$usuario = $bd->traerUsuario($_SESSION["id"]);


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
          <div class="avatar">
            <img src="../avatar/<?=$usuario["avatar"]?>" alt="Foto de perfil" style="width:200px;">
          </div>
          <h1>Nombre: <?=$usuario["nombre"]?></h1>
          <h1>Email: <?=$usuario["email"]?></h1>
          <form class="" id="editar-perfil" action="../perfil/editarperfil.php" method="get">
            <button type="submit" name="button">Editar Perfil</button>
          </form>
          <form class="" id="nuevo-posteo" action="../Perfil/eliminar.php" method="post">
            <button type="submit" name="button">Eliminar perfil</button>
          </form>
          <form class="logout" id="logout" action="../logout.php" method="post">
            <button type="submit" name="button">Cerrar Sesion</button>
          </form>
      </div>
    </main>



</body>
</html>
